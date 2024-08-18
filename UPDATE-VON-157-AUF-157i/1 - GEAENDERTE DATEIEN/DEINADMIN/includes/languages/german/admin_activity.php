<?php
/** 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: admin_activity.php 2023-10-24 20:00:16Z webchills $
 */

define('HEADING_TITLE', 'Admin Aktivitäten Log Manager');
define('HEADING_SUB1', 'Logeinträge anzeigen oder exportieren');
define('HEADING_SUB2', 'Log History leeren');
define('TEXT_ACTIVITY_EXPORT_FORMAT', 'Export als:');
define('TEXT_ACTIVITY_EXPORT_FILENAME', 'Export Dateiname:');
define('TEXT_ACTIVITY_EXPORT_SAVETOFILE','Datei auf dem Server speichern? (ansonsten erfolgt der Download der Datei direkt aus diesem Fenster)');
define('TEXT_ACTIVITY_EXPORT_DEST','Speicherort: ');

define('SUCCESS_EXPORT_ADMIN_ACTIVITY_LOG', 'Export abgeschlossen. ');
define('FAILURE_EXPORT_ADMIN_ACTIVITY_LOG', 'ACHTUNG: Export fehlgeschlagen. Es konnte nicht gespeichert werden in der Datei ');

define('TEXT_INSTRUCTIONS','<u>ANLEITUNG</u><br>
Auf dieser Seite können Sie Ihre Zen Cart Admin User Aktivitäten Logs zur Archivierung in eine CSV-Datei exportieren.<br>
Sie sollten diese Daten für die Verwendung bei Betrugsermittlungen speichern, falls Ihre Website kompromittiert wird. Dies ist eine Voraussetzung für die PCI-Compliance.<br>
<ol>
<li>Wählen Sie aus, ob Sie die Daten anzeigen oder in eine Datei exportieren möchten.</li>
<li>Geben Sie einen Dateinamen ein. (muss mit einer der folgenden Endungen enden: .csv .txt .htm .html .xml)</li>
<li>Klicken Sie zum Fortfahren auf Speichern.</li>
<li>Wählen Sie, ob die Datei gespeichert oder geöffnet werden soll, je nachdem, was Ihr Browser anbietet.</li></ol>
');

define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Admin Aktivität Log Tabelle in der Datenbank leeren<br>WARNUNG: Erstellen Sie ein Datenbankbackup bevor Sie die Tabelle leeren!</strong><br>Das Admin Aktivität Log zeichnet alle Aktivitäten in Ihrem Adminbereich auf, um diese bei Bedarf nachverfolgen zu können. <br>Aufgrund dessen kann die Tabelle sehr schnell sehr groß werden und sollte daher von Zeit zu Zeit geleert werden.<br>Eine Warnung über eine zu große Tabelle wird automatisch angezeigt, wenn die Tabelle über 50.000 Einträge enthält oder Einträge enthält die älter sind als 60 Tage, je nachdem was zuerst erreicht wird.<br><span class="alert">HINWEIS: PCI Compliance setzt zwingend voraus, dass Sie die Admin Aktivitäts Logs für 12 Monate aufbewahren.<br>Daher ist es am Besten Ihre Logs zu archivieren, indem Sie oben EXPORT TO CSV auswählen und auf GO klicken, BEVOR Sie die Logeinträge löschen.</span>');
define('TEXT_ADMIN_LOG_PLEASE_CONFIRM_ERASE', '<strong><span class="alert">WARNUNG!: Sie sind dabei *wichtige* Log Aufzeichnungen aus Ihrer Datenbank zu löschen.</span></strong><br>Sie sollten sich VORHER versichern, dass Sie ein Backup Ihrer Datenbank haben, bevor Sie fortfahren.<br>Mit der Fortsetzung (Löschung der Daten) bestätigen Sie, dass Sie die Wichtigkeit der Daten und Ihre rechtliche Verantwortung für diese Daten verstanden haben.<br><br>Ich bin mir meiner Verantwortung bezüglich der Daten bewußt und will diese bewußt löschen:<br>');
define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>Vollständige</strong> Leerung des Admin Aktivitäts Logs erfolgreich abgeschlossen');
define('TEXT_NO_RECORDS_FOUND', 'keine Einträge gemäß der gewählten Filtereinstellungen gefunden.');

define('TEXT_EXPORTFORMAT0', 'Als HTML exportieren (ideal für Bildschirmausgabe)');
define('TEXT_EXPORTFORMAT1', 'Als CSV exportieren (ideal zum Bearbeiten in Open Office oder Excel)');
define('TEXT_EXPORTFORMAT2', 'Als TXT Datei exportieren');
define('TEXT_EXPORTFORMAT3', 'Als XML Datei exportieren');

define('TEXT_ACTIVITY_EXPORT_FILTER', 'Welche Logdaten möchten Sie ansehen?');
define('TEXT_EXPORTFILTER0', 'Alle ganz unbhängig vom Wichtigkeitsgrad');
define('TEXT_EXPORTFILTER1', 'INFO - Allgemeine Info über Zugriffe');
define('TEXT_EXPORTFILTER2', 'NOTICE - Wichtige Infos über Aktivitäten, die regelmäßig geprüft werden sollte');
define('TEXT_EXPORTFILTER3', 'WARNING - Aktivität, die täglich überprüft werden sollte');
define('TEXT_EXPORTFILTER4', 'Sowohl NOTICE als auch WARNING (übliche Kombination für eine Analyse).');
define('TEXT_ACTIVITY_EXPORT_FILTER_USER','Filtern nach Admin User:');
define('TEXT_EXPORTFILTER_USER','Alle Admin User');
define('TEXT_INTERPRETING_LOG_DATA', '<p><strong>Interpretation der Log Daten</strong></p><ul>
<li><strong>Schweregrad</strong>  - Die Standards für die Protokollierung beschreiben im Allgemeinen folgende Schweregrade:<ul>
<li><strong>INFO</strong> bezieht sich auf die allgemeine Aktivität. Diese kann bemerkenswerte Details enthalten oder auch nicht.</li>
<li><strong>NOTICE/HINWEIS</strong> bezieht sich auf eine Aktivität, die anzeigt, dass höhere Privilegien verwendet wurden, und kann Dinge wie das Anlegen neuer Admin-Benutzer oder das Hinzufügen neuer Zahlungsmodule beinhalten. Er weist auch darauf hin, wenn auf der Webseite eingereichte Daten potenziell riskante Inhalte wie Skript-Tags oder eingebettete Iframes enthalten, bei denen böswilliger Inhalt von unzufriedenen Mitarbeitern oder einem Eindringling auf Ihrer Website zu Ihren Produkten/Kategorien/Seiten hinzugefügt wird. Diese sollten regelmäßig auf Anomalien wie z.B. unbefugte Aktivitäten überprüft werden.</li>
<li><strong>WARNING</strong> wird für KRITISCHE Dinge wie die Entfernung von Zahlungsmodulen oder die Löschung von Admin-Benutzern vergeben. Dies sind Aktivitäten, die auf Probleme hindeuten könnten, wenn sie nicht schnell erkannt werden. Diese sollten sehr häufig überprüft werden; tägliche Prüfung ist empfohlen.</li>
</ul>
</li>
<li><strong>admin_user</strong> - Hier wird die ID-Nummer des Admin-Benutzers angezeigt, gefolgt von seinem Admin-Benutzernamen. Wenn nicht angemeldet, wird 0 angezeigt.</li>
<li><strong>page_accessed</strong> - Hier wird der Name der besuchten Seite angezeigt, was Hinweise auf die Art der stattfindenden Aktivität gibt.</li>
<li><strong>parameters</strong> - Dies ist der Rest der URI der besuchten Seite und gibt weitere Hinweise auf die Art der Aktivität, die der Besucher versucht hat.</li>
<li><strong>flagged</strong> - Wenn dieser Wert auf 1 gesetzt ist, bedeutet dies, dass Sie den im Feld "postdata" aufgezeichneten Inhalt auf unbefugte Eingabe von Skript oder Iframe oder anderen potenziell gefährlichen Inhalten untersuchen sollten. Eine Erklärung des verdächtigen Inhalts wird im Feld "attention" aufgeführt.</li>
<li><strong>attention</strong> - Diese enthält Vorschläge bezüglich der Art der verdächtigen Aktivität, die im Feld "Postdaten" überprüft werden sollte, wenn sie markiert ist.</li>
<li><strong>logmessage</strong> - Dies enthält alle vom System aufgezeichneten Meldungen über die stattfindende Aktivität, wie z.B. die Installation eines bestimmten Moduls.</li>
<li><strong>postdata</strong> - Dies enthält die rohen POST-Daten (von einigen sensiblen Informationen bereinigt) zur einfachen Überprüfung, falls eine böswillige Aktivität vermutet wird.</li>
</ul>');
