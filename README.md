# zencart-german-grundsystem
Zen Cart ist eine kostenlose unter der GPL-Lizenz veröffentlichte Open-Source Shopsoftware. Das System wird in den USA entwickelt, die amerikanische Website dazu ist www.zen-cart.com Die deutsche Zen Cart Version von www.zen-cart-pro.at ist eine Anpassung der amerikanischen Version an die Bedürfnisse von Onlineshopbetreibern im deutschsprachigen Raum.
Die deutsche Zen Cart Version wird von einem Team von Entwicklern in Österreich und Deutschland betreut, weiterentwickelt und supportet und steht kostenlos zur Verfügung. Support findet ausschließlich im Supportforum statt.
Aktuelle Version ist 1.5.4, die Version 1.5.5 ist derzeit im Betatest.

Hauptunterschiede zwischen der deutschen und amerikanischen Version:

Die amerikanische Version ist im Administrationsbereich immer monolingual englisch. Daran ändert auch die etwaige Installation eines deutschen Sprachpakets nichts. Viele Konfigurationseinstellungen werden weiterhin nur auf englisch verfügbar sein, da diese in der Datenbank hinterlegt sind. Die deutsche Zen-Cart Version bietet einen multilingualen Adminbereich. Dadurch sind auch die in der Datenbank hinterlegten Konfigurationseinstellungen und -beschreibungen auf deutsch. Sie könnten auch in jeder anderen Sprache genutzt werden. Diese Funktionalität steht natürlich auch für später installierte Erweiterungen zur Verfügung. Die im Downloadbereich von zen-cart-pro.at angebotenen Module berücksichtigen diese Multilanguagefähigkeit und sind alle für die deutsche Zen-Cart Version ausgelegt.

Die amerikanische Zen-Cart Version berücksichtigt viele rechtliche Erfordernisse nicht, denen ein Onlineshop im deutschsprachigen Raum unterworfen ist. Daher wurde die deutsche Zen-Cart Version auf die Anforderungen, die an Onlineshops in Deutschland, Österreich und der Schweiz gestellt werden, angepasst.

Die amerikanische Version enthält keinerlei HTML Editor mehr, in der deutschen Version sind aktuelle Versionen von CKEditor und Tiny MCE Editor bereits integriert.

Die deutsche Zen Cart Version hat seit Version 1.5.3 zahlreiche häufig genutzte Erweiterungen bereits vorintegriert, unter anderem 

Minify (CSS/JS Loader)
Minify komprimiert Javascripts und Stylesheets und fügt verschiedene Stylesheets zusammen. Javascripts und Stylesheets werden gecached, was den Seitenaufbau beschleunigt.
Das Verzeichnis für den Minify Cache wurde in den Ordner cache integriert und befindet sich nun unter cache/minify Der Ordner cache/minify muss vom Webserver beschreibbar sein.
Einstellungen dazu unter Konfiguration > Minify
Falls amerikanische Module die Erweiterung CSS/JS Loader mitbringen, dann ist die Installation dieses CSS/JS Loaders in der deutschen Zen Cart Version NICHT erforderlich oder sinnvoll, da sie eben bereits integriert ist!

Google Analytics
Seit Zen Cart 1.5.3 deutsch ist bereits das Modul Google Analytics enthalten, so dass bei Bedarf einfach nur die Google Analytics Account Nummer via Zen Cart Administration eingetragen werden muss, um Google Analytics zu verwenden.
Es wird der der neue Google Universal Tracking Code unterstützt.
Einstellungen dazu unter Konfiguration > Google Analytics

Facebook Funktionen
Seit Zen Cart 1.5.3 deutsch wird eine Unterstützung von Facebook Open Graph und Facebook Like Funktionen mitgeliefert.
Einstellungen dazu unter Konfiguration > Facebook Funktionen

RSS Feeds
Seit Zen Cart 1.5.3 deutsch generiert Zen Cart nun out of the box RSS Feeds
Einstellungen dazu unter Konfiguration > RSS Feed

Logfiles im Admin anzeigen
Errorlogs können nun direkt in der Administration angesehen und gelöscht werden (Tools > Logfiles ansehen)

Email Archiv Manager
Falls die Email Archivierung unter Konfiguration > Email Optionen aktiviert ist können vom Shop versandte Mails in der Administration angesehen, gelöscht oder erneut versendet werden.

Datenbanksicherung
Unter Tools Datenbanksicherung kann nun - falls vom Hostingprovider unterstützt - die Datenbank gesichert oder wiederhergestellt werden.

Verkaufsbericht
Das Modul "Sales Report" ist seit Zen Cart 1.5.3 deutsch integriert und ermöglicht unter Statistiken > Verkaufsbericht detaillierte Auswertungen zu den Bestellungen

Emailadresse Kontrollfeld
Da sich viele Kunden bei der Eingabe ihrerr Emailadresse vertippen, wird nun bei Registrierung oder Kundendatenänderung wie beim Passwort auch dei Emailadresse in einem zweiten Feld überprüft.

Spaltenlayout in den Artikellisten
Die Artikel in den Artikellisten können nun wahlweise in Spalten oder Reihen angezeigt werden (Modul Spaltenlayout integriert)

Willkommen bei der deutschen Zen-Cart Version
Version 1.5.5 BETA

BETA vom 20.08.2016
NUR ZUM TESTEN IN EINEM TESTSYSTEM - NOCH NICHT FÜR LIVESHOPS GEEIGNET

Um Zen Cart 1.5.5 Beta zu installieren nur die Ordner/Dateien im Ordner UPLOAD hochladen!

Um eine schlankere Installation und ein einfacheres Update zu ermöglichen, wurden die Demodaten ausgelagert.
Sie befinden sich im Ordner DEMODATEN

Ebenso ausgelagert wurden die Überprüfungstools im Ordner extras.
Sie befinden sich im Ordner TOOLS.

Feedback bitte im Betatest Forum posten:

https://www.zen-cart-pro.at/forum/forums/101-BETA-Test-Zen-Cart-1-5-5-deutsch

Neue Funktionen gegenüber 1.5.4

Generell:
Unterstützung von PHP 7 
Verbesserte Unterstützung von MySQL 5.7
Neues responsives HTML 5 Standardtemplate (classic_responsive)
vereinfachte Installation

Neue Funktionen (Auszug):
Passwörter der Kunden via Admin änderbar
Übersichtlichere Menüs in der Administration
CSS Buttons in der Administration (optional)
Erweiterte Google Analytics Funktionen (Opt-Out-Cookie integriert)
Erweiterte Facebook Open Graph und schema.org Mikrodaten Unterstützung
Erweiterter Lagerbestandsbericht
Detaillierteres Errorlogging (myDebug Backtrace integriert)
Zentrales Styling für die verschiedenen HTML Email Templates
HTML Email Templates für responsive Darstellung verbessert
Unterstützung der neuesten Paypal Checkout Funktionalitäten (API NVP 124.0)
Tiny MCE und CKEditor in den neuesten Versionen
Details der Bestellung erscheinen auf der checkout success Seite
Automatisches Update der Wechselkurse für Währungen via cron
Zen Colorbox integriert
Zahlungsart Bar bei Abholung integriert
Mehrsprachige Ländernamen integriert
MailBeez integriert
IT Recht Kanzlei Schnittstelle zur automatischen Aktualisierung der Rechtstexte integriert
pdf Rechnung integriert
Adresskorrektur bie Bestellungen möglich
