<?php
/*
  $Id$

  Yatego Export for Zen-Cart
  by www.pocketbit.net 05/2007. All rights reserved
  converted from OSC to ZenCart by 
    JeffClay 
    Hugo13 (http://edv.langheiter.com/zencart/ )

*/
chdir('../');
require('includes/application_top.php');

/**
 * init smarty environment
 */
$smarty = setSmarty ();

/**
 * header stuff
 */
$smarty->assign('path', '../');
$smarty -> display('header.tpl.html');

$msg = '';
$version = "100";
$salesmanager = "0";


function getfilestat ($file) {
    @$fp = fopen($file, "r");
    @$fstat = fstat($fp);
    return $fstat;
}

function search_cat($cat) {
    global $db;
    global $rcat;
    $sql = "SELECT parent_id FROM categories WHERE categories_id ='" . $cat . "'";
    $query = "SELECT parent_id FROM categories WHERE categories_id ='" . $cat . "'";
    $cat = $db->Execute($sql);
    $sql2 = "SELECT foreign_id_l, shop_catid FROM yategoowncats WHERE substring(foreign_id_l,4) = '" . $cat->fields['parent_id'] . "'";

    $query2 = $db->Execute($sql2);
    if ($query2->RecordCount() > 0) {
        $rcat = $db->Execute($sql2);
    } else {
        $i++;
        if ($i > 10)
            return;
        search_cat($cat->fields['parent_id']);
    }
    return;
}

function zen_get_products_special_price_os($product_id) {
    global $db;
    $product = $db->Execute("select specials_new_products_price from specials where products_id = '" . (int)$product_id . "'");
    $product_query = $db->Execute("select specials_new_products_price from specials where products_id = '" . (int)$product_id . "'");
    if ($salesmanager == '1') {
        $product_query = $db->Execute("select products_price, products_model from products where products_id = '" . $product_id . "'");
    }
    if ($product->RecordCount()) {
        $productp = $db->Execute($product_query);
        $product_price = $productp->fields['products_price'];
    } else {
        return false;
    }

    $product_to_categories = $db->Execute("select categories_id from products_to_categories where products_id = '" . $product_id . "'");
    $category = $product_to_categories->fields['categories_id'];
    $sale_query = $db->Execute("select sale_specials_condition, sale_deduction_value, sale_deduction_type from salemaker_sales where sale_categories_all like '%," . $category . ",%' and sale_status = '1' and (sale_date_start <= now() or sale_date_start = '0000-00-00') and (sale_date_end >= now() or sale_date_end = '0000-00-00') and (sale_pricerange_from <= '" . $product_price . "' or sale_pricerange_from = '0') and (sale_pricerange_to >= '" . $product_price . "' or sale_pricerange_to = '0')");
    if ($sale_query->RecordCount()) {
        $sale = $db->Execute("select sale_specials_condition, sale_deduction_value, sale_deduction_type from salemaker_sales where sale_categories_all like '%," . $category . ",%' and sale_status = '1' and (sale_date_start <= now() or sale_date_start = '0000-00-00') and (sale_date_end >= now() or sale_date_end = '0000-00-00') and (sale_pricerange_from <= '" . $product_price . "' or sale_pricerange_from = '0') and (sale_pricerange_to >= '" . $product_price . "' or sale_pricerange_to = '0')");
    } else {
        return $product['specials_new_products_price'];
    }

    if ($product['specials_new_products_price']) {
        $tmp_special_price = $product_price;
    } else {
        $tmp_special_price = $product->fields['specials_new_products_price'];
    }

    switch ($sale['sale_deduction_type']) {
        case 0:
            $sale_product_price = $product_price - $sale->fields['sale_deduction_value'];
            $sale_special_price = $tmp_special_price - $sale->fields['sale_deduction_value'];
            break;
        case 1:
            $sale_product_price = $product_price - (($product_price * $sale->fields['sale_deduction_value']) / 100);
            $sale_special_price = $tmp_special_price - (($tmp_special_price * $sale->fields['sale_deduction_value']) / 100);
            break;

        case 2:
            $sale_product_price = $sale->fields['sale_deduction_value'];
            $sale_special_price = $sale->fields['sale_deduction_value'];
            break;

        default:
            return $product_price;
    }

    if ($sale_product_price < 0) {
        $sale_product_price = 0;
    }

    if ($sale_special_price < 0) {
        $sale_special_price = 0;
    }

    if ($product['specials_new_products_price']) {
        return number_format($sale_product_price, 4, '.', '');
    } else {
        switch ($sale['sale_specials_condition']) {
            case 0:
                return number_format($sale_product_price, 4, '.', '');
                break;
            case 1:
                if ($product['specials_new_products_price'] > 0)
                    return number_format($product['specials_new_products_price'], 4, '.', '');
                else
                    return number_format($productp['products_price'], 4, '.', '');
                break;

            case 2:
                // return $sale_special_price;
                return number_format($sale_special_price, 4, '.', '');
                break;

            default:
                return number_format($product['specials_new_products_price'], 4, '.', '');
        }
    }
    // End Salesmanager
}

function zen_get_yatego_nummer($cID) {
    global $db;
    $sql_query = "select yategocategories_id from categories_to_yatego where categories_id= '" . $cID . "'";
    $yatego = $db->Execute($sql_query);
    return $yatego->fields['yategocategories_id'];
}
// #################################################
if (!existTable('yategoexport')) {
    $sql = "CREATE TABLE yategoexport (
               id int(11) NOT NULL auto_increment,
               article_id VARCHAR(100) NOT NULL,
               article_name varchar(150) default NULL,
               article_model varchar(150) default NULL,
               tax DECIMAL(10,2) default '19.00',
               price_brutto DECIMAL(10,2) default NULL,
               price_uvp DECIMAL(10,2) default NULL,
               units int default '1',
               basesprice INT default '0',
               add_shipping DECIMAL(10,2) default '0',
               add_shipping_type INT default '0',
               short_desc VARCHAR(150) default NULL,
               description TEXT default NULL,
               url VARCHAR(200) default NULL,
               image1 VARCHAR(255) default NULL,
               image2 VARCHAR(255) default NULL,
               image3 VARCHAR(255) default NULL,
               image4 VARCHAR(255) default NULL,
               image5 VARCHAR(255) default NULL,
               catid TEXT default NULL,
               varid VARCHAR(255) default NULL,
               rabattid VARCHAR(255) default NULL,
               lager INT default '-1',
               delivery DATE default NULL,
               crossselling INT default NULL,
               deleteproduct INT default '0',
               active INT default '1',
               top INT default '0',
               lastupdate DATETIME default NULL,
               PRIMARY KEY  (id)
                )";
    $yatego_query = $db->Execute($sql);
}
if (!existTable('yategoowncats')) {
    $sql = "CREATE TABLE yategoowncats (
                id int(11) NOT NULL auto_increment,
                shop_catid int(11) DEFAULT NULL,
                foreign_id_h VARCHAR(100) DEFAULT NULL,
                foreign_id_m VARCHAR(100) DEFAULT NULL,
                foreign_id_l VARCHAR(100) DEFAULT NULL,
                title_h VARCHAR(100) DEFAULT NULL,
                title_m VARCHAR(100) DEFAULT NULL,
                title_l VARCHAR(100) DEFAULT NULL,
                sorting INT DEFAULT NULL,
                PRIMARY KEY  (id)
                );";
    $yatego_query = $db->Execute($sql);
}

if (!existTable('yategoexportlager')) {
    $sql = "CREATE TABLE yategoexportlager (
                id int(11) NOT NULL auto_increment,
                product_id VARCHAR(255) DEFAULT NULL,
                varianten_ids VARCHAR(255) DEFAULT NULL,
                menge INT DEFAULT '-1',
                delivery VARCHAR(255) DEFAULT NULL,
                active CHAR(5),
                article_id int DEFAULT NULL,
                aufpreis DECIMAL (10,2),
                info_varianten_titel VARCHAR(255) DEFAULT NULL,
                info_varianten_id VARCHAR(255) DEFAULT NULL,
                info_article_titel VARCHAR(255) DEFAULT NULL,
                deletevar INT DEFAULT '0',
                PRIMARY KEY  (id)
                );";
    $yatego_query = $db->Execute($sql);
}

if (!existTable('yategoexportvarianten')) {
    $sql = "CREATE TABLE yategoexportvarianten (
                id int(11) NOT NULL auto_increment,
                variantensatz_id VARCHAR(255) DEFAULT NULL,
                varianten_name VARCHAR(255) DEFAULT NULL,
                deletevar INT DEFAULT '0',
                PRIMARY KEY  (id)
                );";
    $yatego_query = $db->Execute($sql);
}

if (!existTable('yategoexportvarianten2')) {
    $sql = "CREATE TABLE yategoexportvarianten2 (
                id int(11) NOT NULL auto_increment,
                foreign_id VARCHAR(255) DEFAULT NULL,
                variantensatz_id VARCHAR(255) DEFAULT NULL,
                description TEXT DEFAULT NULL,
                aufpreis DECIMAL (10,2),
                deletevar INT DEFAULT '0',
                PRIMARY KEY  (id)
                );";
    $yatego_query = $db->Execute($sql);
}

if (!existTable('yategooptions')) {
    $sql = "CREATE TABLE yategooptions (
                version INT ,
                deleteproducts INT DEFAULT '1',
                outputdir VARCHAR(255) DEFAULT 'backups',
                language_id INT DEFAULT '1',
                maxprod VARCHAR(30) DEFAULT '999999',
                pricemin INT DEFAULT '0',
                pricemax INT DEFAULT '9999999',
                footer TEXT
                );";
    $yatego_query = $db->Execute($sql);
    $sql = "INSERT INTO yategooptions (version) VALUES ('.$version.')";
    $yatego_query = $db->Execute($sql);
}

if (!existTable('categories_to_yatego')) {
    $sql = "CREATE TABLE categories_to_yatego(
                id int(11) NOT NULL auto_increment,
                categories_id int DEFAULT NULL,
                yategocategories_id TEXT DEFAULT NULL,
                PRIMARY KEY  (id)
                );";
    $yatego_query = $db->Execute($sql);
}
// updates
// Version prüfen
// Optionen
$options = $db->Execute("select deleteproducts, footer, language_id, outputdir from yategooptions");
$backup = $options->fields['outputdir'];

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
// Create
if ($_GET['i'] == '1') {
    $del_query = "DELETE FROM yategoowncats";
    $query = $db->Execute($del_query);

    if ($options->fields['deleteproducts'] == '0') {
        $del_query = "DELETE FROM yategoexport";
        $query = $db->Execute($del_query);
    } else {
        $upd_query = "UPDATE yategoexport SET deleteproduct = '1'";
        $query = $db->Execute($upd_query);
    }

    $del_query = "DELETE FROM yategoexportvarianten";
    $query = $db->Execute($del_query);

    $del_query = "DELETE FROM yategoexportvarianten2";
    $query = $db->Execute($del_query);

    $del_query = "DELETE FROM yategoexportlager";
    $query = $db->Execute($del_query);
    // Kategorien erzeugen
    $cat_query = "select c.categories_id, c.parent_id, cd.categories_name from categories c INNER JOIN categories_description cd ON c.categories_id=cd.categories_id WHERE cd.language_id='" . $options->fields['language_id'] . "' AND c.parent_id = '0'";
    $cats = $db->Execute($cat_query);

    while (!$cats->EOF) {
        // Main categories
        $sql = "INSERT INTO yategoowncats (shop_catid, foreign_id_h,title_h) VALUES ('" . $cats->fields['categories_id'] . "','YAT" . $cats->fields['categories_id'] . "','" . zen_db_prepare_input(strip_tags($cats->fields['categories_name'])) . "')";
        $sql_data_array = array('shop_catid' => $cats->fields['categories_id'],
            'foreign_id_h' => 'YAT' . $cats->fields['categories_id'],
            'title_h' => zen_db_prepare_input(strip_tags($cats->fields['categories_name'])));
        zen_db_perform('yategoowncats', $sql_data_array);
        $cats->MoveNext();
    }
    // 2. Level
    $cat_query = "select shop_catid, title_h, foreign_id_h from yategoowncats WHERE foreign_id_m IS NULL";
    $cats = $db->Execute($cat_query);
    while (!$cats->EOF) {
        // 3 Level
        $cat_query2 = "select c.categories_id, c.parent_id, cd.categories_name from categories c INNER JOIN categories_description cd ON c.categories_id=cd.categories_id WHERE cd.language_id='" . $options->fields['language_id'] . "' AND c.parent_id = '" . $cats->fields['shop_catid'] . "'";
        $cats2 = $db->Execute($cat_query2);
        while (!$cats2->EOF) {
            $sql_data_array = array('shop_catid' => $cats2->fields['categories_id'],
                'foreign_id_h' => $cats->fields['foreign_id_h'],
                'foreign_id_m' => 'YAT' . $cats2->fields['categories_id'],
                'title_h' => $cats->fields[title_h],
                'title_m' => zen_db_prepare_input(strip_tags($cats2->fields['categories_name'])));
            zen_db_perform('yategoowncats', $sql_data_array);
            $cats2->MoveNext();
        }
        $cats->MoveNext();
    }

    $cat_query = "select shop_catid, title_h, foreign_id_h, title_m, foreign_id_m from yategoowncats WHERE foreign_id_l IS NULL AND foreign_id_m IS NOT NULL";
    $cats = $db->Execute($cat_query);
    while (!$cats->EOF) {
        // Select cat
        $cat_query2 = "select c.categories_id, c.parent_id, cd.categories_name from categories c INNER JOIN categories_description cd ON c.categories_id=cd.categories_id WHERE cd.language_id='" . $options->fields['language_id'] . "' AND c.parent_id = '" . $cats->fields['shop_catid'] . "'";
        $cats2 = $db->Execute($cat_query2);
        while (!$cats2->EOF) {
            $sql = "INSERT INTO yategoowncats (shop_catid, foreign_id_h,foreign_id_m, foreign_id_l, title_h, title_m, title_l) VALUES ('" . $cats2->fields['categories_id'] . "','" . $cats->fields['foreign_id_h'] . "','" . $cats->fields['foreign_id_m'] . "','YAT" . $cats2->fields['categories_id'] . "','" . $cats->fields['title_h'] . "','" . $cats->fields['title_m'] . "','" . $cats2->fields['categories_name'] . "')";
            $sql_data_array = array('shop_catid' => $cats2->fields['categories_id'],
                'foreign_id_h' => $cats->fields['foreign_id_h'],
                'foreign_id_m' => $cats->fields['foreign_id_m'],
                'foreign_id_l' => 'YAT' . $cats2->fields['categories_id'],
                'title_h' => $cats->fields['title_h'],
                'title_m' => $cats->fields['title_m'],
                'title_l' => zen_db_prepare_input($cats2->fields['categories_name']));
            zen_db_perform('yategoowncats', $sql_data_array);
            $cats2->MoveNext();
        }
        $cats->MoveNext();
    }
    // Varianten
    $var_query = $db->Execute("select products_options_id, products_options_name from products_options WHERE language_id = '" . (int)$options->fields['language_id'] . "'");

    if ($var_query->RecordCount() > 0) {
        while (!$var_query->EOF) { // {
            $ov = '';
            $ov .= "YAT_" . $var_query->fields['products_options_id'] . ",";
            $ov = substr($ov, 0, strlen($ov)-1);
            $sql = "INSERT INTO yategoexportvarianten (variantensatz_id, varianten_name) VALUES ('" . $ov . "','" . $var_query->fields['products_options_name'] . "')";
            $db->Execute($sql);
            $var_query->MoveNext();
        }
        $var_set = $db->Execute("SELECT pov.products_options_values_id, pov.products_options_values_name, povtp.products_options_id FROM products_options_values pov INNER JOIN products_options_values_to_products_options povtp ON  pov.products_options_values_id=povtp.products_options_values_id where pov.language_id = '" . (int)$languages_id . "'");

        while (!$var_set->EOF) {
            $sql = "INSERT INTO yategoexportvarianten2 (foreign_id, variantensatz_id, description) VALUES ('YAT_" . $var_set->fields['products_options_id'] . "','YATVS_" . $var_set->fields['products_options_values_id'] . "','" . $var_set->fields['products_options_values_name'] . "')";

            $db->Execute($sql);
            $var_set->MoveNext();
        }
    }
    // products
    $product = $db->Execute ("select p.products_id, p.products_model, pd.products_name, pd.products_description, p.products_model, p.products_image, p.products_status, p.products_price, p.products_tax_class_id from products p, products_description pd, products_to_categories ptc , categories c where p.products_id=ptc.products_id and c.categories_id=ptc.categories_id and p.products_id = pd.products_id and pd.language_id = '" . $options->fields['language_id'] . "' AND p.products_price > 0");

    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);

    while (!$product->EOF) {
        // Lager
        
        $var_set = $db->Execute ("select pov.products_options_values_id, pov.products_options_values_name, pa.products_attributes_id, pa.options_values_price, pa.price_prefix from products_attributes pa, products_options_values pov where pa.products_id = '" . $product->fields['products_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . $options->fields['language_id'] . "'");

        if ($var_set->RecordCount() > 0) {
            while (!$var_set->EOF) {
                if ($var_set->fields['price_prefix'] == '-') {
                    $p = $var_set->fields['price_prefix'] . $var_set->fields['options_values_price'];
                } else {
                    $p = $var_set->fields['options_values_price'];
                }
                $sql = "INSERT INTO yategoexportlager (product_id, varianten_ids, menge, aufpreis) VALUES ('YATP_" . $product->fields['products_id'] . "','YATVS_" . $var_set->fields['products_options_values_id'] . "','-1','" . $p . "')";
                $db->Execute($sql);
                $var_set->MoveNext();
            }
        }
        $products_description = $product->fields['products_description'];
        $products_description .= "";

        $products_description = strtr($products_description, $trans);
        $products_description = str_replace("\r\n", "\\n", $products_description);
        $products_description = str_replace("\n\r", "\\n", $products_description);
        $products_description = str_replace("\n", "\\n", $products_description);
        $products_description = str_replace("\r", "\\n", $products_description);
        $products_description = str_replace(";", "", $products_description);
        $products_description = str_replace("'", "", $products_description);

        $products_name = $product->fields['products_name'];
        $products_name = strtr($products_name, $trans);
        $products_name = str_replace("\r\n", "\\n", $products_name);
        $products_name = str_replace("\n\r", "\\n", $products_name);
        $products_name = str_replace("\n", "\\n", $products_name);
        $products_name = str_replace("\r", "\\n", $products_name);
        $products_name = str_replace(";", "", $products_name);
        $products_name = str_replace("'", "", $products_name);

        if (strlen($options->fields['footer']) > 0) {
            $products_description .= "<br/>" . $options->fields['footer'];
        }

        if (zen_not_null($product->fields['products_model'])) {
            $products_model = $product->fields['products_model'];
        } else {
            $products_model = '';
        }

        $products_description_short = substr(strip_tags($products_description), 0, 127) . "...";
        $products_image = HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $product->fields['products_image'];

        if ($sonderpr = zen_get_products_special_price($product->fields['products_id'], $salesmanager)) {
            $pr = $sonderpr;
            $pruvp = $product->fields['products_price'];
        } else {
            $pr = $product->fields['products_price'];
        }

        if ($pr < 1) {
            // print_r($product);
            die;
        }
        $tax = 1 + (zen_get_tax_rate($product->fields['products_tax_class_id']) / 100);

        if ($tax > 0) {
            $pr = $pr * $tax;
            $pruvp = $pruvp * $tax;
        }

        $tax = number_format(zen_get_tax_rate($product->fields['products_tax_class_id']), 2, '.', '');
        // cats
        $sql = "SELECT categories_id FROM products_to_categories WHERE products_id = '" . $product->fields['products_id'] . "'";

        $catid = $db->Execute ($sql);
        // $catid = tep_db_fetch_array($query);
        // get own cat
        unset($c);

        $sql = "SELECT foreign_id_h,foreign_id_m,foreign_id_l FROM yategoowncats WHERE shop_catid = '" . $catid->fields['categories_id'] . "'";
        $yatcatid = $db->Execute ($sql);
        // $yatcatid = tep_db_fetch_array($query);
        if (isset($yatcatid->fields['foreign_id_l'])) {
            $c = $yatcatid->fields['foreign_id_l'];
        } else if (isset($yatcatid->fields['foreign_id_m'])) {
            $c = $yatcatid->fields['foreign_id_m'];
        } else if (isset($yatcatid->fields['foreign_id_h'])) {
            $c = $yatcatid->fields['foreign_id_h'];
        }

        if (!isset($c)) {
            search_cat($catid['categories_id']);
            $c = $rcat->fields['foreign_id_l'];
        }

        $r = zen_get_yatego_nummer($catid->fields['categories_id']);

        if (is_array($r)) {
            foreach($r as $r1) {
                $c .= "," . $r1;
            }
        }

        $sql_raw = "INSERT INTO yategoexport (article_model, price_uvp, price_brutto, tax, article_id, article_name, short_desc, image1, description, active, deleteproduct, catid, lastupdate) VALUES ('" . $product->fields['products_model'] . "','" . $pruvp . "','" . $pr . "','" . $tax . "','YATP_" . $product->fields['products_id'] . "','" . $products_name . "','" . $products_description_short . "','" . $products_image . "','" . $products_description . "','" . $product->fields['products_status'] . "','0','" . $c . "', now())";

        if ($options->fields['delete_products'] == '0') {
            $sql = $sql_raw;
        } else {
            $lsql = "SELECT article_id FROM yategoexport WHERE substring(article_id,6) = '" . $product->fields['products_id'] . "'";
            $query = $db->Execute($lsql);
            if ($query->RecordCount() > 0) {
                $sql = "UPDATE yategoexport SET
                           article_model = '" . $product->fields['products_model'] . "',
                           price_brutto= '" . $pr . "',
                           tax = '" . $tax . "',
                           article_name= '" . $products_name . "',
                           short_desc= '" . $products_description_short . "',
                           image1= '" . $products_image . "',
                           description= '" . $products_description . "',
                           deleteproduct = '0',
                           active= '" . $product->fields['products_status'] . "',
                           catid= '" . $c . "',
                           lastupdate=now() WHERE substring(article_id,6) = '" . $product->fields['products_id'] . "'";
            } else
                $sql = $sql_raw;
        }

        $query = $db->Execute($sql);
        $msg = "Yatego Exportdaten wurden vorbereitet";
        $product->MoveNext();
    }
    // end i=1
} else if ($_GET[i] == '2') {
    $yatego_file = $backup . '/exp_yatego.txt';
    if ($fp = fopen($yatego_file, 'w')) {
        $csv_trenner = ';';
        $schema = '';
        $var = '1';
        $fields = array('foreign_id', 'article_nr', 'title', 'tax', 'price', 'price_uvp', 'basic_price', 'units', 'delivery_surcharge', 'delivery_calc_once', 'short_desc', 'long_desc', 'url', 'auto_linefeed', 'picture', 'picture2', 'picture3', 'picture4', 'picture5', 'categories', 'variants', 'discount_set_id', 'stock', 'delivery_date', 'cross_selling', 'delitem', 'status', 'top_offer');

        foreach ($fields as $f) {
            $schema .= $f . $csv_trenner;
        }
        $schema .= "\n";
        $trans = get_html_translation_table(HTML_ENTITIES);
        $trans = array_flip($trans);

        $schema = addslashes($schema);
        $schema = ereg_replace("\n#", "\n" . '\#', $schema);
        fputs($fp, $schema);
        $p = $db->Execute ("SELECT * from yategoexport");

        while (!$p->EOF) {
            $products_description = strtr($p->fields['description'], $trans);
            $products_description = str_replace("\r\n", "\\n", $products_description);
            $products_description = str_replace("\n\r", "\\n", $products_description);
            $products_description = str_replace("\n", "\\n", $products_description);
            $products_description = str_replace("\r", "\\n", $products_description);
            $products_description = str_replace(";", "", $products_description);

            $short_desc = strtr($p->fields['short_desc'], $trans);
            $short_desc = str_replace("\r\n", "\\n", $short_desc);
            $short_desc = str_replace("\n\r", "\\n", $short_desc);
            $short_desc = str_replace("\n", "\\n", $short_desc);
            $short_desc = str_replace("\r", "\\n", $short_desc);
            $short_desc = str_replace(";", "", $short_desc);
            // . number_format($p['price_uvp'],2,'.',',')
            $schema = $p->fields['article_id']
             . $csv_trenner
             . $p->fields['article_model']
             . $csv_trenner
             . $p->fields['article_name']
             . $csv_trenner
             . $p->fields['tax']
             . $csv_trenner
             . number_format($p->fields['price_brutto'], 2, '.', ',')
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $short_desc
             . $csv_trenner
             . $products_description
             . $csv_trenner
             . $p->fields['url']
             . $csv_trenner
             . $csv_trenner
             . $p->fields['image1']
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $p->fields['catid']
             . $csv_trenner . $ov
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $p->fields['deleteproduct']
             . $csv_trenner
             . $csv_trenner
             . $p->fields['top'] . $csv_trenner . "\n";
            fputs($fp, $schema);
            $p->MoveNext();
        }
        fclose($fp);
    }
    // Varianten
    $yatego_file = $backup . '/exp_yatego_varianten.txt';
    if ($fp = fopen($yatego_file, 'w')) {
        $schema = '';
        $fields = array('foreign_id', 'vs_title', 'variant_set_name', 'delitem');

        foreach ($fields as $f) {
            $schema .= $f . $csv_trenner;
        }
        $schema .= "\n";
        $schema = addslashes($schema);
        $schema = ereg_replace("\n#", "\n" . '\#', $schema);
        fputs($fp, $schema);
        $p = $db->Execute ("SELECT * from yategoexportvarianten");
        while (!$p->EOF) {
            $schema = $p->fields['variantensatz_id'] . $csv_trenner
             . $p->fields['varianten_name'] . $csv_trenner
             . $p->fields['varianten_name'] . $csv_trenner . $csv_trenner
             . $csv_trenner . "\n";
            fputs($fp, $schema);
            $p->MoveNext();
        }
        $schema = '';
        $fields = array('variant_set_id', 'foreign_id', 'title', 'small_desc', 'long_desc', 'picture', 'price', 'delitem');
        foreach ($fields as $f) {
            $schema .= $f . $csv_trenner;
        }
        $schema .= "\n";
        $schema = addslashes($schema);
        $schema = ereg_replace("\n#", "\n" . '\#', $schema);
        fputs($fp, $schema);
        $yexport = $db->Execute ("SELECT * from yategoexportvarianten2");
        while (!$yexport->EOF) {
            $schema = $p->fields['foreign_id'] . $csv_trenner
             . $p->fields['variantensatz_id'] . $csv_trenner
             . $p->fields['description'] . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $p->fields['aufpreis'] . $csv_trenner
             . $csv_trenner . "\n";
            fputs($fp, $schema);
            $yexport->MoveNext();
        }
    }
    // Lager
    $yatego_file = $backup . '/exp_yatego_lager.txt';
    if ($fp = fopen($yatego_file, 'w')) {
        $schema = '';
        $fields = array('foreign_id', 'article_id', 'variant_ids', 'stock_value', 'delivery_date', 'active', 'article_nr', 'price', 'info_p_title', 'info_v_title', 'info_vs_id', 'delitem');
        foreach ($fields as $f) {
            $schema .= $f . $csv_trenner;
        }
        $schema .= "\n";
        $schema = addslashes($schema);
        $schema = ereg_replace("\n#", "\n" . '\#', $schema);
        fputs($fp, $schema);
        $p = $db->Execute ("SELECT * from yategoexportlager");
        while (!$p->EOF) {
            $schema = $p->fields['foreign_id'] . $csv_trenner
             . $p->fields['product_id'] . $csv_trenner
             . $p->fields['varianten_ids'] . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $p->fields['aufpreis'] . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner
             . $csv_trenner . "\n";
            fputs($fp, $schema);
            $p->MoveNext();
        }
    }

    $yatego_file = $backup . '/exp_yatego_shopcats.txt';
    if ($fp = fopen($yatego_file, 'w')) {
        $schema = '';
        $fields = array('foreign_id_h', 'foreign_id_m', 'foreign_id_l', 'title_h', 'title_m', 'title_l', 'sorting');
        foreach ($fields as $f) {
            $schema .= $f . $csv_trenner;
        }
        $schema .= "\n";
        $schema = addslashes($schema);
        $schema = ereg_replace("\n#", "\n" . '\#', $schema);
        fputs($fp, $schema);
        $p = $db->Execute ("SELECT * from yategoowncats");
        while (!$p->EOF) {
            $schema = $p->fields['foreign_id_h'] . $csv_trenner
             . $p->fields['foreign_id_m'] . $csv_trenner
             . $p->fields['foreign_id_l'] . $csv_trenner
             . $p->fields['title_h'] . $csv_trenner
             . $p->fields['title_m'] . $csv_trenner
             . $p->fields['title_l'] . $csv_trenner
             . $csv_trenner . "\n";
            fputs($fp, $schema);
            $p->MoveNext();
        }
    }

    $msg = "Yatego Exportdaten wurden erstellt";
    // end i=2
} else if ($_GET[i] == '3') {
    echo "Nix";
}

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS;

?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;

?>">
<title><?php echo TITLE;

?></title>
<link rel="stylesheet" type="text/css" href="../includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php');

$smarty->assign('msg', $msg);
$smarty->assign('yatego_outputdir', $options->fields['outputdir']);
$smarty->assign('hint1', $hint1);
$smarty->assign('yatego_outputdir', '../' . $options->fields['outputdir']);
$r = (getfilestat($options->fields['outputdir'] . "/exp_yatego.txt"));
if ($r[atime] > 0) {
    $smarty->assign('yatego_exporttime', " (" . date("j. F Y, g:i", $r[atime]) . ") ");
}

$smarty -> display('yatego_main.tpl.html');

