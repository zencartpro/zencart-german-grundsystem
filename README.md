# zencart-german
Zen Cart ist eine kostenlose unter der GPL-Lizenz veröffentlichte Open-Source Shopsoftware. Das System wird in den USA entwickelt, die amerikanische Website dazu ist www.zen-cart.com Die deutsche Zen Cart Version ist eine Anpassung der amerikanischen Version an die Bedürfnisse von Onlineshopbetreibern im deutschsprachigen Raum.

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

Google Analytics integriert
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
