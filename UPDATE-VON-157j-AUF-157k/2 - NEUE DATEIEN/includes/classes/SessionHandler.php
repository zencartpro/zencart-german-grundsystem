<?php
/**
 * Zen Cart German Specific (210 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2026 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: SessionHandler.php 2026-04-02 16:25:24Z webchills $
 */

namespace Zencart;

class SessionHandler implements \SessionHandlerInterface
{

    /**
     * @inheritDoc
     */
    public function close(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy(string $id): bool
    {
        global $db;
        $sql = "DELETE FROM " . TABLE_SESSIONS . " WHERE sesskey = '" . zen_db_input($id) . "'";
        $db->Execute($sql);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function gc(int $max_lifetime): int|false
    {
        global $db;
        $sql = "DELETE FROM " . TABLE_SESSIONS . " WHERE expiry < " . time();
        $db->Execute($sql);

        return $db->affectedRows() ?? false;
    }

    /**
     * @inheritDoc
     */
    public function open(string $path, string $name): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read(string $id): string|false
    {
        global $db;
        $qid = "SELECT value
                FROM " . TABLE_SESSIONS . "
                WHERE sesskey = '" . zen_db_input($id) . "'
                AND expiry > '" . time() . "'";

        $value = $db->Execute($qid);

        if (!empty($value->fields['value'])) {
            $value->fields['value'] = base64_decode($value->fields['value']);
            return $value->fields['value'];
        }

        return '';
    }

    /**
     * @inheritDoc
     */
    public function write(string $id, string $data): bool
    {
        global $db;
        if (!is_object($db)) {
            return false;
        }
        $data = base64_encode($data);

        global $SESS_LIFE;
        $expiry = time() + $SESS_LIFE;

        $sql = "INSERT INTO " . TABLE_SESSIONS . " (sesskey, expiry, `value`)
                VALUES (:zkey, :zexpiry, :zvalue)
                ON DUPLICATE KEY UPDATE `value`=:zvalue, expiry=:zexpiry";

        $sql = $db->bindVars($sql, ':zkey', $id, 'string');
        $sql = $db->bindVars($sql, ':zexpiry', $expiry, 'integer');
        $sql = $db->bindVars($sql, ':zvalue', $data, 'string');
        $result = $db->Execute($sql);

        return !empty($result->resource);
    }
}
