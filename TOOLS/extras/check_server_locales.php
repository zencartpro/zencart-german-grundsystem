<?php
//find_locales.php by torvista
// modified for Zen Cart German by webchills
$version = 'v1.1';
/** Dieses Dienstprogramm ist dafür gedacht, zu überprüfen, welche Sprachumgebungen (locales) auf diesem Server installiert sind und welche Sprachumgebungen (locales) Sie in die Haupt-Sprachkonstanten-Datei (die beiden Äquivalente zu german.php) eintragen können.
 *
 * GEBRAUCHSANWEISUNG:
 * 1. Öffnen Sie Ihren Browser
 * 2. Geben Sie die URL für Ihren Shop ein, gefolgt von /extras/show_locales.php
 * 3. ... und drücken Sie die Eingabetaste
 * 4. überprüfen Sie die gefundenen Gebietsschemata, die den Testnamen in den folgenden Feldern entsprechen. Die Ergebnisse sind von Server zu Server unterschiedlich, insbesondere unter Windows/Unix
 */

//add more testing names as required

//English
$english = [
    'en',
    'english_gbr',
    'english_britain',
    'english_england',
    'english_great britain',
    'english_uk',
    'english_united kingdom',
    'english_united-kingdom',
    'en_GB.utf8',
    'en_US',
    'en_US.utf8',
    'en_us_utf8',
    'en.UTF-8',
    'english_usa',
    'english_america',
    'english_united states',
    'english_united-states',
    'english_us'
];

//Dutch
$dutch = ['nl_NL.utf8', 'nl', 'nl-NL', 'nld_nld'];

//German
$german = ['de_DE.UTF-8', 'de_AT.UTF-8', 'de_CH.UTF-8', 'de', 'de_DE@euro', 'de_DE', 'deu_deu'];

//Spanish
$spanish = [
    'es_utf8',
    'es',
    'es-ES',
    'Spanish_Modern_Sort',
    'es_utf8',
    'es_ES@euro',
    'esp_esp',
    'esp_spain',
    'spanish_esp',
    'spanish_spain',
    'es_ES.utf8',
    'es-es'
];
//----------------------------------------------------------------------------------------------

/**
 * @param $code
 * @param $language
 */
function list_nix_locales($code, $language): void
{
    echo "<h3>$language: using <em>system('locale -a | grep -i $code')</em></h3>";
    echo "<p>Die verfügbaren 'locale' strings für '$code' auf diesem Server sind:</p>";
    echo "<pre>";
    system("locale -a | grep -i $code");
    echo "</pre>";
}

/**
 * @param $test_names
 * @param $language
 */
function check_locales($test_names, $language): void
{
    echo '<hr>';
    echo "<h3>$language</h3>";
    foreach ($test_names as $value) {
        echo '<hr style="margin-left:0;width:30%">';
        echo "<p>test locale: '<em>$value</em>'</p>";
        $locale_found = setlocale(LC_TIME, $value);

        if ($locale_found !== false) {
            echo "<p>locale '<em><strong>$locale_found</strong></em>' found for '<em>$value</em>'.</p>";
            $formatter = new IntlDateFormatter($value, IntlDateFormatter::FULL, IntlDateFormatter::FULL);
            echo '<p>Beispiel: ' . $formatter->format(time()) . '</p>';
        } else {
            echo "<p>Keine locale gefunden für '<em>$value</em>'</p>";
        }
    }
}

?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Test Locales - <?php echo(stripos(PHP_OS_FAMILY, "win") !== false ? ' WINDOWS' : ' UNIX'); ?></title>
    <style>body {
            padding: 1em;
            font-family: Verdana, Geneva, sans-serif;
            font-size: .8em
        }

        code, pre {
            font-size: 1.4em
        }

        h1 {
            font-size: 1.2em;
            text-decoration: underline;
        }

        h2 {
            font-size: 1.1em
        }

        h3 {
            font-size: 1em
        }
    </style>
</head>
<body>

<h1>Test Server Locales - <?php echo $version; ?></h1>
<p>Eingebettet in dieses Skript sind Listen/Aufstellungen möglicher Gebietsschemata für Windows- und Unix-basierte Server für einige Sprachen.<br>
    Dieses Skript probiert jede einzelne aus, um zu sehen, ob das Betriebssystem (Unix/Windows) sie akzeptiert bzw. ob sie auf diesem Server installiert ist, und um zu bestätigen, welches Gebietsschema Sie für LC_TIME in den beiden wichtigsten Zen Cart
    Sprachdateien (german.php und ihre zusätzlichen Sprachäquivalente) verwenden können.<br>
    Die eingebetteten Listen sind nicht vollständig, bitte recherchieren Sie und ergänzen Sie die Arrays entsprechend Ihrer gewünschten Sprache.</p>
<hr>
<?php
if (stripos(PHP_OS_FAMILY, "win") === false) { ?>
    <h2>Dies ist ein UNIX Server</h2>
    <?php
    //English en
    list_nix_locales('en', 'Englisch');

    //Dutch en
    list_nix_locales('nl', 'Holländisch');

    //German de
    list_nix_locales('de', 'Deutsch');

    //Spanish es
    list_nix_locales('es', 'Spanisch');
    
} else { ?>
    
    <h2>Dies ist ein WINDOWS Server</h2>
    <p>Es ist möglich, eine Liste aller in Windows installierten Gebietsschemata mit der Windows Powershell zu erhalten (erfordert
        .net).</p>
    <div style="margin-left: 50px">
        <p>Open Windows Powershell console, eg: <code>PS C:\Users\Steve></code></p>
        <p><code>E</code>nter the command as shown to get the listing:</p>
        <p><code>[System.Globalization.Cultureinfo]::GetCultures('AllCultures')</code></p>
        <p>To be clever and get a csv file of this full listing (change the destination as required), use this set of
            commands on one line (the semicolons concatenate the commnds):</p>
        <code>Function global:GET-CULTURE {
            [System.Globalization.Cultureinfo]::GetCultures('AllCultures') }; $locales=GET-CULTURE; $locales | EXPORT-CSV
            D:locales.csv</code>
    </div>
    <p>Siehe die Referenzen am Ende dieser Seite, um Sie davon zu überzeugen, Ihr Windows-basiertes Hosting aufgrund seinern mangelnder Unterstützung für utf-8 aufzugeben.</p>
    <p>Hinweis von Microsoft:</p>
    <blockquote>"Das Locale-Argument kann einen Locale-Namen, eine Sprachzeichenkette, eine Sprachzeichenkette und Land/Region
        Code, eine Code
        Seite oder eine Sprachzeichenkette, einen Länder-/Regionencode und eine Codeseite enthalten. Die Menge der verfügbaren Gebietsschema-Namen, Sprachen,
        Länder-/Regionencodes und Codepages umfasst alle von der Windows-NLS-API unterstützten mit Ausnahme von Codepages, die
        Codepages, die mehr als zwei Bytes pro Zeichen benötigen, wie UTF-7 und UTF-8.<br>
        <strong>Wenn Sie einen Codepage-Wert von UTF-7 oder UTF-8 angeben, schlägt setlocale fehl und gibt NULL zurück</strong>."
    </blockquote>
    <?php
}

//English
check_locales($english, 'Englisch');

//Dutch
check_locales($dutch, 'Holländisch');

//German
check_locales($german, 'Deutsch');

//Spanish
check_locales($spanish, 'Spanisch');

?>
<hr>
<h1>Diverse Infoseiten zum Thema</h1>
<p>Guide to getting PHP, utf-8 and mysql to play together: <a
        href="https://www.toptal.com/php/a-utf-8-primer-for-php-and-mysql" target="_blank">www.toptal.com/php/a-utf-8-primer-for-php-and-mysql</a>
</p>
<p>PHP setlocale: <a href="https://www.php.net/manual/en/function.setlocale.php" target="_blank">php.net/manual/en/function.setlocale.php</a>
</p>
<p>Table of locales/codepages: <a href="https://docs.moodle.org/dev/Table_of_locales" target="_blank">docs.moodle.org/dev/Table_of_locales</a>
</p>
<h2>The Wacky World of Windows</h2>
<p><a href="https://stackoverflow.com/questions/10995953/php-setlocale-in-windows-7" target="_blank">stackoverflow.com/questions/10995953/php-setlocale-in-windows-7</a>
</p>
<p>Table of Locales: <a href="https://www.science.co.il/language/Locale-codes.php#definitions" target="_blank">www.science.co.il/Language/Locale-codes.asp#definitions</a>
</p>
<p>Globalization: <a href="https://docs.microsoft.com/en-us/dotnet/standard/globalization-localization/globalization" target="_blank">docs.microsoft.com/en-us/dotnet/standard/globalization-localization/globalization</a>
</p>
<p>Windows Country/Region Strings: <a href="https://docs.microsoft.com/en-us/cpp/c-runtime-library/country-region-strings?view=vs-2019"
                                      target="_blank">docs.microsoft.com/en-us/cpp/c-runtime-library/country-region-strings?view=vs-2019</a>
</p>
<p>Windows Language Strings: <a href="https://docs.microsoft.com/en-us/cpp/c-runtime-library/language-strings?view=vs-2019" target="_blank">docs.microsoft.com/en-us/cpp/c-runtime-library/language-strings?view=vs-2019</a>
</p>
<p>Windows Language Code Identifiers (LCID): <a href="https://docs.microsoft.com/en-us/openspecs/windows_protocols/ms-lcid/70feba9f-294e-491e-b6eb-56532684c37f"
                                                target="_blank">https://docs.microsoft.com/en-us/openspecs/windows_protocols/ms-lcid/70feba9f-294e-491e-b6eb-56532684c37f</a>
</p>
<p>Locales and Languages (Windows): <a
        href="https://docs.microsoft.com/en-us/windows/desktop/intl/locales-and-languages" target="_blank">docs.microsoft.com/en-us/windows/desktop/intl/locales-and-languages</a>x
</p>
</body>
</html>
