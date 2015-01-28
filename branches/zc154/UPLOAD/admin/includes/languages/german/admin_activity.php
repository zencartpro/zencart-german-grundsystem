<?php
/**
 * @package admin
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin_activity.php 731 2015-01-22 09:49:16Z webchills $
 */

define('HEADING_TITLE', 'Admin Aktivitäten Log Manager');
define('HEADING_SUB1', 'Logeinträge anzeigen oder exportieren');
define('HEADING_SUB2', 'Log History leeren');
define('TEXT_ACTIVITY_EXPORT_FORMAT', 'Export als:');
define('TEXT_ACTIVITY_EXPORT_FILENAME', 'Export Dateiname:');
define('TEXT_ACTIVITY_EXPORT_SAVETOFILE','Datei auf dem Server speichern? (ansonsten erfolgt der Download der Datei direkt aus diesem Fenster)');
define('TEXT_ACTIVITY_EXPORT_DEST','Speicherort: ');
define('TEXT_PROCESSED', ' Verarbeitet.');
define('SUCCESS_EXPORT_ADMIN_ACTIVITY_LOG', 'Export abgeschlossen. ');
define('FAILURE_EXPORT_ADMIN_ACTIVITY_LOG', 'ACHTUNG: Export fehlgeschlagen. Es konnte nicht gespeichert werden in der Datei ');

define('TEXT_INSTRUCTIONS','<u>ANLEITUNG</u><br />Sie können diese Seite dazu benutzen, um die Aktivitäten Ihrer Zen Cart&reg; Admins in einer CSV Datei für Archivierungszwecke zu speichern.<br />Sie sollten die Admin Aktivitäten stets speichern, damit Sie in bei Untersuchungen von Betrugsfällen feststellen können, ob Ihr Shop kompromittiert (gehackt) wurde. Diese Daten sind Vorraussetzung, um die PCI Compliance zu erfüllen.<br />
<ol><li>Wählen Sie aus, ob Sie die Export Datei anzeigen lassen oder in einer Datei speichern wollen.<li>Geben Sie einen Dateinamen ein.<li>Klicken Sie auf GO.<li>Wählen Sie aus, ob Sie die Exportdatei speichern oder öffnen wollen, je nachdem was Ihnen Ihr Browser anbietet.</ol>');

define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Admin Aktivität Log Tabelle in der Datenbank leeren<br />WARNUNG: Erstellen Sie ein Datenbankbackup bevor Sie die Tabelle leeren!</strong><br />Das Admin Aktivität Log zeichnet alle Aktivitäten in Ihrem Adminbereich auf, um diese bei Bedarf nachverfolgen zu können. <br />Aufgrund dessen kann die Tabelle sehr schnell sehr groß werden und sollte daher von Zeit zu Zeit geleert werden.<br />Eine Warnung über eine zu große Tabelle wird automatisch angezeigt, wenn die Tabelle über 50.000 Einträge enthält oder Einträge enthält die älter sind als 60 Tage, je nachdem was zuerst erreicht wird.<br /><span class="alert">HINWEIS: PCI Compliance setzt zwingend voraus, dass Sie die Admin Aktivitäts Logs für 12 Monate aufbewahren.<br />Daher ist es am Besten Ihre Logs zu archivieren, indem Sie oben EXPORT TO CSV auswählen und auf GO klicken, BEVOR Sie die Logeinträge löschen.</span>');
define('TEXT_ADMIN_LOG_PLEASE_CONFIRM_ERASE', '<strong><span class="alert">WARNUNG!: Sie sind dabei *wichtige* Log Aufzeichnungen aus Ihrer Datenbank zu löschen.</span></strong><br />Sie sollten sich VORHER versichern, dass Sie ein Backup Ihrer Datenbank haben, bevor Sie fortfahren.<br />Mit der Fortsetzung (Löschung der Daten) bestätigen Sie, dass Sie die Wichtigkeit der Daten und Ihre rechtliche Verantwortung für diese Daten verstanden haben.<br /><br />Ich bin mir meiner Verantwortung bezüglich der Daten bewußt und will diese bewußt löschen:<br />');
define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>Vollständige</strong> Leerung des Admin Aktivitäts Logs erfolgreich abgeschlossen');
define('TEXT_NO_RECORDS_FOUND', 'No Records Found using the filter you selected.');

define('TEXT_EXPORTFORMAT0', 'Export as HTML (ideal for on-screen viewing)');
define('TEXT_EXPORTFORMAT1', 'Export to CSV (ideal for importing to spreadsheets)');
define('TEXT_EXPORTFORMAT2', 'Export to TXT');
define('TEXT_EXPORTFORMAT3', 'Export to XML');

define('TEXT_ACTIVITY_EXPORT_FILTER', 'Which log data do you want to see?');
define('TEXT_EXPORTFILTER0', 'All logged data, regardless of severity level.');
define('TEXT_EXPORTFILTER1', 'INFO - General logged information');
define('TEXT_EXPORTFILTER2', 'NOTICE - Notable info, which should be reviewed periodically');
define('TEXT_EXPORTFILTER3', 'WARNING - Activity which should be reviewed daily');
define('TEXT_EXPORTFILTER4', 'Both NOTICE and WARNING (common combination for review).');

define('TEXT_INTERPRETING_LOG_DATA', '<p><strong>Interpretation of the log data</strong><ul>
<li><strong>Severity</strong> - The standards for logging generally describe severities as follows:<ul>
<li><strong>INFO</strong> refers to general activity. This may or may not contain remarkable details.</li>
<li><strong>NOTICE</strong> refers to activity which indicates higher privilege was used, and may include things like creating new admin users or adding new payment modules. It also highlights when any data submitted on the web page includes potentially risky content such as script tags or embedded iframes, where malicious content is being added to your products/categories/pages by unhappy employees or an intruder on your site. These should be reviewed regularly for any anomalies such as unauthorized activity.</li>
<li><strong>WARNING</strong> is assigned to CRITICAL things such as removal of payment modules or deletion of admin users. These are activities which might suggest pending trouble if not caught quickly. These should be reviewed very frequently; recommended daily.</li>
</ul>
<li><strong>admin_user</strong> - This will show the admin user ID number followed by their admin username. If not logged in, it will show 0.</li>
<li><strong>page_accessed</strong> - This will indicate the name of the page visited, thus giving hints to the kind of activity taking place.</li>
<li><strong>parameters</strong> - This is the rest of the URI of the page visited, and gives further indication of the kind of activity being attempted by the visitor.</li>
<li><strong>flagged</strong> - If this is set to 1, that indicates that you should inspect the content recorded in the "postdata" field for unauthorized entry of script or iframe or other potentially dangerous content. An explanation of suspicious content will be listed in the "attention" field.</li>
<li><strong>attention</strong> - This will contain suggestions related to the kind of suspicious activity which should be reviewed in the "postdata" field if flagged. </li>
<li><strong>logmessage</strong> - This contains any messages recorded by the system about the activity taking place, such as installation of a certain module.</li>
<li><strong>postdata</strong> - This contains the raw POST data (with some sensitive information scrubbed) for easy review in case malicious activity is suspected.</li>
</ul></p>');