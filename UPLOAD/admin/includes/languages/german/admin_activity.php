<?php
/**
 * @package admin
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin_activity.php 729 2011-08-09 15:49:16Z hugo13 $
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

