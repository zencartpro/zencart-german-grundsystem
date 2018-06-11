# zencart-german-grundsystem
Zen Cart ist eine kostenlose unter der GPL-Lizenz veröffentlichte Open-Source Shopsoftware. Das System wird in den USA entwickelt, die amerikanische Website dazu ist www.zen-cart.com Die deutsche Zen Cart Version von www.zen-cart-pro.at ist eine Anpassung der amerikanischen Version an die Bedürfnisse von Onlineshopbetreibern im deutschsprachigen Raum.
Die deutsche Zen Cart Version wird von einem Team von Entwicklern in Österreich und Deutschland betreut, weiterentwickelt und supportet und steht kostenlos zur Verfügung. Support findet ausschließlich im Supportforum statt.

**Willkommen bei der deutschen Zen Cart Version 1.5.5f**

Version 1.5.5f vom 15.06.2018
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

* PHP 5.6.x oder höher (maximal 7.1.x), Apache 2.0 oder höher und MySQL 5.1 oder höher
* Apache muss konfiguriert sein mit AllowOverride auf entweder 'All' oder mit zumindestens 'Limit' und 'Indexes' Parameter, vorzugsweise mit ebenfalls 'Options' Parameter.
* PHP muss CURL mit OpenSSL unterstützen (erforderlich z.B. für PayPal Express)

Empfohlene Serverkonfiguration:

* PHP 7.0.x oder 7.1.x
* Apache 2.2.x oder 2.4.x
* MySQL 5.5 bis 5.7
* und die oben erwähnten Apache/PHP Settings

PHP 7.1 wird mit dieser Version vollständig unterstützt!
Bevor Sie Zen Cart mit PHP 7 oder 7.1. einsetzen, prüfen Sie aber, ob Zusatzmodule, die Sie verwenden, ebenfalls bereits für PHP 7 oder 7.1 angepasst wurden.

Zen Cart 1.5.5f deutsch funktioniert zwar auch auf einem Windows/IIS server, wir raten aber dringend zu einem Linux/Apache Server.

