<?php

require_once(dirname(__FILE__) .  '/../lib/payment/sofortLibSofortueberweisung.inc.php');
require_once(dirname(__FILE__) .  '/../lib/core/sofortLibNotification.inc.php');
require_once(dirname(__FILE__) .  '/../lib/core/sofortLibTransactionData.inc.php');
require_once(dirname(__FILE__) .  '/../../../../../includes/sofort_states.php');

class Communication
{

    /**
     * Sofort sdk instance
     *
     * @var SofortLib_SofortueberweisungClassic
     */
    protected $_sofortSdk;

    /**
     * Sofort transaction id
     *
     * @var string
     */
    protected $_transactionId;

    protected $_payment;

    /**
     * Order comments
     * @var string
     */
    private $_commentMessages = array(
        'redirect' => 'Redirection to SOFORT Banking. Transaction not finished. Transaction ID: [[transaction_id]]. Time: [[date]]',
        'abort' => 'Payment aborted. Time: [[date]]',
        'pending_not_credited_yet' => 'SOFORT Banking has been completed successfully - Transaction ID: [[transaction_id]]. Time: [[date]]',
        'untraceable_sofort_bank_account_needed' => 'SOFORT Banking has been completed successfully - Transaction ID: [[transaction_id]]. Time: [[date]]',
        'loss_not_credited' => 'The payment has not been received on your Deutsche Handelsbank account. Please verify the payment. Time: [[date]]',
        'received_credited' => 'The payment has been received on your Deutsche Handelsbank account. Time: [[date]]',
        'received_partially_credited' => 'An amount differing from the order has been received on your Deutsche Handelsbank account. Please verify the payment. Time: [[date]]',
        'received_overpayment' => 'An amount differing from the order has been received on your Deutsche Handelsbank account. Please verify the payment. Time: [[date]]',
        'refunded_compensation' => 'Partial amount will be refunded - [[refunded_amount]]. Time: [[date]]',
        'refunded_refunded' => 'Amount will be refunded. Time: [[date]]',
        'amount_wrong' => 'Der Warenkorb wurde manipuliert/nicht vollständig bezahlt.  Es wurden nur [[amount]] [[currency]] zur Überweisung angewiesen. Überprüfen Sie die Transaktion [[transaction_id]] im SOFORT Überweisung Anbietermenü und kontaktieren Sie ggf. den Käufer'
    );

    /**
     * Initialize dependecys (sofort sdk)
     */
    public function __construct($payment)
    {
        $this->_payment = $payment;
        $this->_sofortSdk = new Sofortueberweisung($this->_payment->configuration_key);
    }

    /**
     * Get sofort transaction id
     *
     * @return string
     */
    public function getTransactionId()
    {
        if (is_null($this->_transactionId)) {
            $this->_transactionId = $this->_sofortSdk->getTransactionId();
        }

        return $this->_transactionId;
    }

    /**
     * Executes the pay request to sofort
     */
    public function paymentRequest(order $order, $total, $orderId)
    {
        $this->_sofortSdk->setVersion('zencart_5.0.1');
        $this->_sofortSdk->setAmount($total);
        $this->_sofortSdk->setCurrencyCode($order->info['currency']);
        $this->_sofortSdk->setCustomerprotection($this->_payment->customer_protection);

        $this->_sofortSdk->setReason(
            $this->_getReason($this->_payment->reason_one, $orderId),
            $this->_getReason($this->_payment->reason_two, $orderId)
        );

        $this->_sofortSdk->setSuccessUrl(
            zen_href_link(
                FILENAME_CHECKOUT_PROCESS,
                '',
                'SSL',
                true,
                false
            )
        );

        $abortUrl = zen_href_link(
            FILENAME_CHECKOUT_PAYMENT,
            '',
            'SSL',
            true,
            false
        ) . '&payment_error=' . $order->info['payment_module_code'] . '&error=payment_aborted';

        if (!empty($orderId)) {
            $abortUrl .= '&order_id=' . $orderId;
        }

        $this->_sofortSdk->setAbortUrl($abortUrl);

        $this->_sofortSdk->setNotificationUrl(
            zen_href_link(
                'sofort_notification',
                '',
                'SSL',
                true,
                false
            )
        );

        $this->_sofortSdk->setTimeout(ini_get("session.gc_maxlifetime") - 180);

        $this->_sofortSdk->setTimeoutUrl($abortUrl);

        $this->_sofortSdk->sendRequest();
    }

    /**
     * Return payment landingpage
     *
     * @return string
     */
    public function getPaymentRedirect()
    {
        return $this->_sofortSdk->getPaymentUrl();
    }

    /**
     * Is payment request successful
     *
     * @return boolean
     */
    public function isValid()
    {
        return !$this->_sofortSdk->isError();
    }

    /**
     * Return error message
     *
     * @return string
     */
    public function getErrors()
    {
        return $this->_sofortSdk->getErrors();
    }


    /**
     * Get reason one
     *
     * @retun string
     */
    private function _getReason($reason, $orderId)
    {
        return $this->_replaceReasonPlaceHolder($reason, $orderId);
    }

    /**
     * Replace the placeholders and get reason
     *
     * @param string $reason
     * @return string
     */
    private function _replaceReasonPlaceHolder($reason, $orderId)
    {
        global $order;

        $replaceData = array(
            '{{order_id}}' => $orderId,
            '{{customer_name}}' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
            '{{order_date}}' => date("Y-m-d"),
            '{{customer_email}}' => $order->customer['email_address'],
            '{{customer_company}}' => $order->customer['company'],
            '{{customer_id}}' => $_SESSION['customer_id'],
            '{{transaction}}' => '-TRANSACTION-'

        );

        $reason = str_replace('{{order_id}}', $replaceData['{{order_id}}'], $reason);
        $reason = str_replace('{{customer_name}}', $replaceData['{{customer_name}}'], $reason);
        $reason = str_replace('{{order_date}}', $replaceData['{{order_date}}'], $reason);
        $reason = str_replace('{{customer_email}}', $replaceData['{{customer_email}}'], $reason);
        $reason = str_replace('{{customer_company}}', $replaceData['{{customer_company}}'], $reason);
        $reason = str_replace('{{customer_id}}', $replaceData['{{customer_id}}'], $reason);
        $reason = str_replace('{{transaction}}', $replaceData['{{transaction}}'], $reason);

        return $reason;
    }

    /**
     * Get sofort status with reason
     *
     * @return array
     */
    public function getStatusData($rawBody)
    {
        $transactionData = array('status' => 'undefined', 'reason' => 'undefined');

        $notificationSdk = new SofortLibNotification();
        $transactionId = $notificationSdk->getNotification($rawBody);
        if ($transactionId) {
            $transactionData = $this->getTransactionDataById($transactionId);
        }

        return $transactionData;
    }

    /**
     * @param string $transactionId
     * @return array
     */
    public function getTransactionDataById($transactionId)
    {
        $transactionDataSdk = new SofortLibTransactionData(
            $this->_payment->configuration_key
        );

        $transactionDataSdk->addTransaction($transactionId)->sendRequest();

        $transactionData['status'] = !is_null($transactionDataSdk->getStatus()) ? $transactionDataSdk->getStatus() : '';
        $transactionData['reason'] = !is_null($transactionDataSdk->getStatusReason()) ? $transactionDataSdk->getStatusReason(): '';
        $transactionData['amount_refunded'] = $transactionDataSdk->getAmountRefunded();
        $transactionData['amount'] = $transactionDataSdk->getAmount();
        $transactionData['currency'] = $transactionDataSdk->getCurrency();
        $transactionData['transaction_id'] = $transactionId;

        return $transactionData;
    }

    /**
     * Update order status
     *
     * @param array $statusData
     */
    public function handleSofortStatusUpdate(array $statusData)
    {
        global $db;

        $allowedStates = array(
            'loss' => array('not_credited'),
            'pending' => array('not_credited_yet'),
            'received' => array('credited'),
            'refunded' => array('refunded', 'compensation'),
            'untraceable' => array('sofort_bank_account_needed')
        );

        if (array_key_exists($statusData['status'], $allowedStates)
            && in_array($statusData['reason'], $allowedStates[$statusData['status']])) {

            $status = $statusData['status'];
            $reason = $statusData['reason'];

            if ($status === 'untraceable' && $reason === 'sofort_bank_account_needed') {
                $status = 'pending';
                $reason = 'not_credited_yet';
            }

            $payment = $this->_payment;

            $property = $status . '_' . $reason;

            if (!empty($payment->$property)) {

                $query = $db->Execute("SELECT * FROM `". DB_PREFIX . "pi_sofort_transaction` WHERE transaction_id = '" . $statusData['transaction_id'] . "' LIMIT 1");
                $query = $db->Execute("SELECT * FROM `" . TABLE_ORDERS . "` WHERE orders_id = " . (int) $query->fields['order_id']);

               

                    if ($query->fields['orders_status'] !== $payment->$property) {

                        $sql_data_array = array(
                            'orders_id' => $query->fields['orders_id'],
                            'orders_status_id' => $payment->$property,
                            'date_added' => 'now()',
                            'customer_notified' => 0,
                            'comments' => $this->_getComment($property, $statusData)
                        );

                        $check_query = $db->Execute("SELECT orders_status_id FROM " . TABLE_ORDERS_STATUS . " WHERE orders_status_name = '" . $db->prepareInput(MODULE_PAYMENT_SOFORT_UNCHANGED_ENGLISH) . "' LIMIT 1");
                        if ($check_query->fields['orders_status_id'] !== $payment->$property) {
                            $db->Execute("UPDATE `" . TABLE_ORDERS . "` SET orders_status = " . (int) $payment->$property . " WHERE orders_id = " . (int) $query->fields['orders_id']);
                            zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
                        }
                    }
                
            }
        }
    }

    /**
     * Replace placeholders in comment text
     *
     * @param string $property
     * @param array $statusData
     * @return string
     */
    private function _getComment($property, array $statusData)
    {
        $comment = '';
        if (array_key_exists($property, $this->_commentMessages)) {
            $comment = $this->_commentMessages[$property];
            $comment = str_replace('[[date]]', date("Y/m/d H:i:s"), $comment);
            $comment = str_replace('[[transaction_id]]', $statusData['transaction_id'], $comment);
            $comment = str_replace('[[refunded_amount]]', $statusData['refunded_amount'], $comment);
            $comment = str_replace('[[amount]]', $statusData['amount'], $comment);
            $comment = str_replace('[[currency]]', $statusData['currency'], $comment);
        }

        return $comment;
    }

}
