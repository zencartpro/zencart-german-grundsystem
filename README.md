# zencart-german-grundsystem
Zen Cart ist eine kostenlose unter der GPL-Lizenz veröffentlichte Open-Source Shopsoftware. Das System wird in den USA entwickelt, die amerikanische Website dazu ist www.zen-cart.com Die deutsche Zen Cart Version von www.zen-cart-pro.at ist eine Anpassung der amerikanischen Version an die Bedürfnisse von Onlineshopbetreibern im deutschsprachigen Raum.
Die deutsche Zen Cart Version wird von einem Team von Entwicklern in Österreich und Deutschland betreut, weiterentwickelt und supportet und steht kostenlos zur Verfügung. Support findet ausschließlich im Supportforum statt.

**Willkommen bei der deutschen Zen Cart Version 1.5.5**

Version 1.5.5e vom 20.05.2017
Die deutsche Zen Cart Version steht Ihnen kostenfrei im Rahmen der GNU General Public License zur Verfügung.
Sie können diese Software kostenfrei benutzen, Änderungen vornehmen, etc.

Eine ausführliche Dokumentation und Installationsanleitung befindet sich im Ordner ANLEITUNG

Dieses Programm wird in der Hoffnung vertrieben, dass es nützlich ist, allerdings OHNE IRGENDWELCHE GARANTIEN; ohne die Garantie der MARKTGÄNGIGKEIT oder der EIGNUNG ZU EINEM BESTIMMTEN ZWECK und wird vertrieben unter der GNU General Public License

**Hauptunterschiede zwischen der deutschen und amerikanischen Version:**

* Die amerikanische Version ist im Administrationsbereich immer monolingual englisch. Daran ändert auch die etwaige Installation eines deutschen Sprachpakets nichts. Die meisten Konfigurationseinstellungen werden immer auf englisch sein, da sie in der Datenbank hinterlegt sind. Die deutsche Zen Cart Version bietet einen multilingualen Adminbereich. Dadurch sind auch die in der Datenbank hinterlegten Konfigurationseinstellungen und -beschreibungen auf deutsch. Sie könnten auch in jeder anderen Sprache genutzt werden. Diese Funktionalität steht natürlich auch für später installierte Erweiterungen zur Verfügung. Die im Downloadbereich von zen-cart-pro.at angebotenen Module berücksichtigen diese Multilanguagefähigkeit und sind alle für die deutsche Zen Cart Version ausgelegt.
* Die amerikanische Zen Cart Version berücksichtigt viele rechtliche Erfordernisse nicht, denen ein Onlineshop im deutschsprachigen Raum unterworfen ist. Daher wurde die deutsche Zen Cart Version auf die Anforderungen, die an Onlineshops in Deutschland, Österreich und der Schweiz gestellt werden, angepasst. Die Anforderungen der sogenannten "Buttonlösung" und viele andere Vorgaben werden erfüllt.
* Die Installation ist schlanker und enthält keine unnötigen Dateien mehr, da die Bilder und Medien der Demodaten nicht mehr automatisch mitinstalliert werden, sondern nur bei Bedarf hochgeladen werden können
* Die amerikanische Version enthält keinerlei HTML Editor mehr, in der deutschen Version ist der CKEditor bereits integriert und löst das veraltete HTML Area ab. Alternativ ist auch der Tiny MCE Editor integriert.
* Weitere Bugfixes und Verbesserungen, die von den Amerikanern nicht übernommen wurden
* Zahlreiche häufig genutze Erweiterungen sind in der deutschen Zen Cart Version bereits vorinstalliert. Details dazu im Tab Erweiterungen in der Doku.
* Weitere für die deutsche Zen Cart Version angepasste Erweiterungen stehen in unserem Downloadbereich auf www.zen-cart-pro.at zur Verfügung.

**SYSTEMVORAUSSETZUNGEN**

Minimale Anforderungen:

* PHP 5.3.7 oder höher, Apache 2.0 oder höher und MySQL 5.1 oder höher
* Apache muss konfiguriert sein mit AllowOverride auf entweder 'All' oder mit zumindestens 'Limit' und 'Indexes' Parameter, vorzugsweise mit ebenfalls 'Options' Parameter.
* PHP muss CURL mit OpenSSL unterstützen (erforderlich z.B. für PayPal Express)

Empfohlene Serverkonfiguration:

* PHP 5.6 oder höher
* Apache 2.2.x oder 2.4.x
* MySQL 5.1 bis 5.7
* und die oben erwähnten Apache/PHP Settings

PHP 7 wird mit dieser Version vollständig unterstützt!
Bevor Sie Zen Cart mit PHP 7 einsetzen, prüfen Sie aber, ob Zusatzmodule, die Sie verwenden, ebenfalls bereits für PHP 7 angepasst wurden.
Wenn Sie viele Erweiterungen einsetzen, dann betreiben Sie den Shop zunächst mit PHP 5.6.

Zen Cart 1.5.5 deutsch funktioniert zwar auch auf einem Windows/IIS server, wir raten aber dringend zu einem Linux/Apache Server.

**Neue Funktionen gegenüber 1.5.4**

Zen Cart 1.5.5 deutsch ermöglicht den Einsatz von Zen Cart unter PHP 7 und bringt neben zahlreichen Bugfixes viele neue Funktionalitäten mit, unter anderem:

* Unterstützung von PHP 7
* Verbesserte Unterstützung von MySQL 5.7
* Neues responsives HTML 5 Standardtemplate (responsive_classic)
* vereinfachte Installation
* Passwörter der Kunden via Admin änderbar
* Übersichtlichere Menüs in der Administration / Admin auf Tablets leichter bedienbar
* CSS Buttons in der Administration (optional)
* Erweiterte Google Analytics Funktionen (Opt-Out-Cookie integriert)
* Erweiterte Facebook Open Graph und schema.org Mikrodaten Unterstützung
* Erweiterter Lagerbestandsbericht
* Detaillierteres Errorlogging (myDebug Backtrace integriert)
* Zentrales Styling für die verschiedenen HTML Email Templates
* HTML Email Templates für responsive Darstellung verbessert
* Unterstützung der neuesten Paypal Checkout Funktionalitäten (API NVP 124.0)
* Tiny MCE und CKEditor in den neuesten Versionen
* Mobile Detect in neuester Version, bei Bestellungen im Admin ist ersichtlich, ob die Bestellung per Desktop, Smartphone oder Tablet getätigt wurde
* Details der Bestellung erscheinen auf der checkout success Seite
* Automatisches Update der Wechselkurse für Währungen via cron
* Zen Colorbox ur Vergrößerung der Artikelbilder integriert
* Zahlungsart Bar bei Abholung integriert
* Report für Deaktivierte Artikel integriert
* Mehrsprachige Ländernamen integriert
* MailBeez integriert
* IT Recht Kanzlei Schnittstelle zur automatischen Aktualisierung der Rechtstexte integriert
* pdf Rechnung integriert
* Bei Bestellungen können die Adressdaten korrigiert werden

Alle Neuerungen und Bugfixes aus der amerikanischen 1.5.5e Version wurden ebenfalls übernommen
