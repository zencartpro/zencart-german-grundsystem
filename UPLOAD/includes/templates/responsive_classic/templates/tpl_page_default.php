<?php
/**
 * Page Template
 *
 * This is the template used for EZ-Pages content display.  It is named "tpl_page_default" instead of ezpage for friendlier appearance
 *
* Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_page_default.php 2023-10-28 16:46:58Z webchills $
 */
?>
<div class="centerColumn" id="ezPageDefault">
<h1 id="ezPagesHeading"><?php echo $var_pageDetails->fields['pages_title']; ?></h1>

  <?php if (EZPAGES_SHOW_PREV_NEXT_BUTTONS == '2' && $counter > 1) { ?>

<?php if ( $_SESSION['layoutType'] == 'mobile' ) { ?>
<div id="navEZPageNextPrev">
   <a href="<?php echo $prev_link; ?>"><i class="fa-solid fa-circle-chevron-left" title="<?php echo BUTTON_PREVIOUS_ALT; ?>"></i></a>
   <?php echo zen_back_link(); ?><i class="fa-solid fa-list" title="<?php echo BUTTON_VIEW_ALL_ALT; ?>"></i></a>
   <a href="<?php echo $next_link; ?>"><i class="fa-solid fa-circle-chevron-right" title="<?php echo BUTTON_NEXT_ALT; ?>"></i></a>
</div>

<?php } else { ?>

<div id="navEZPageNextPrev">
   <a href="<?php echo $prev_link; ?>"><?php echo $previous_button; ?></a>
   <?php echo zen_back_link() . $home_button; ?></a>
   <a href="<?php echo $next_link; ?>"><?php echo $next_item_button; ?></a>
</div>
<?php } ?>


<?php } elseif (EZPAGES_SHOW_PREV_NEXT_BUTTONS=='1') { ?>
    <div id="navEZPageNextPrev"><?php echo zen_back_link() . $home_button . '</a>'; ?></div>
<?php } ?>

  <?php
// vertical TOC listing
// create a table of contents for chapter when more than 1 page in the TOC
  if (count($toc_links) > 1 && EZPAGES_SHOW_TABLE_CONTENTS == '1') {
    ?>
    <div id="navEZPagesTOCWrapper">
      <h2 id="ezPagesTOCHeading"><?php echo TEXT_EZ_PAGES_TABLE_CONTEXT; ?></h2>
      <div id="navEZPagesTOC">
        <ul class="list">
          <?php
          foreach ($toc_links as $link) {
// could be used to change classes on current link and toc (table of contents) links
            if ($link['pages_id'] == $_GET['id']) {
              ?>
              <li><?php echo CURRENT_PAGE_INDICATOR; ?><a href="<?php echo zen_ez_pages_link($link['pages_id']); ?>"><?php echo $link['pages_title']; ?></a></li>
            <?php } else { ?>
              <li><?php echo NOT_CURRENT_PAGE_INDICATOR; ?><a href="<?php echo zen_ez_pages_link($link['pages_id']); ?>"><?php echo $link['pages_title']; ?></a></li>
              <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>
    <?php } ?>
    <div><?php echo $var_pageDetails->fields['pages_html_text']; ?></div>
</div>
