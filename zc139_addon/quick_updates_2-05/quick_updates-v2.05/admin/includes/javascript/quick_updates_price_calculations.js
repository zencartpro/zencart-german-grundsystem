
function display_ttc(action, prix, taxe, up){
  if(action == 'display'){
          if(up != 1)
          valeur = Math.round((prix + (taxe / 100) * prix) * 100) / 100;
  } else {
          if(action == 'keyup'){
                valeur = Math.round((parseFloat(prix) + (taxe / 100) * parseFloat(prix)) * 100) / 100;
        } else {
         valeur = '0';
        }
  }
  switch (browser_family){
    case 'dom2':
          document.getElementById('descDiv').innerHTML = '<?php echo TOTAL_COST; ?> : '+valeur;
      break;
    case 'ie4':
      document.all.descDiv.innerHTML = '<?php echo TOTAL_COST; ?> : '+valeur;
      break;
    case 'ns4':
      document.descDiv.document.descDiv_sub.document.write(valeur);
      document.descDiv.document.descDiv_sub.document.close();
      break;
    case 'other':
      break;
  }
}
function updateGross(product) {
  var taxRate = getTaxRate(product);
  var inname = "quick_updates_new[products_price][" + product + "]";
  var outname = "quick_updates_new[products_taxprice][" + product + "]";
  var grossValue = document.forms["quick_updates"].elements[inname].value;

  if (taxRate > 0) {
    grossValue = grossValue * ((taxRate / 100) + 1);
  }

  document.forms["quick_updates"].elements[outname].value = doRound(grossValue, 2);
}

function updateNet(product) {
  var taxRate = getTaxRate(product);
  var inname = "quick_updates_new[products_taxprice][" + product + "]";
  var outname = "quick_updates_new[products_price][" + product + "]";
  var netValue = document.forms["quick_updates"].elements[inname].value;

  if (taxRate > 0) {
    netValue = netValue / ((taxRate / 100) + 1);
  }

  document.forms["quick_updates"].elements[outname].value = doRound(netValue, 6);
}
function updateMargin(product) {

  var innamePrice = "quick_updates_new[products_price][" + product + "]";
  var innameCost = "quick_updates_new[products_purchase_price][" + product + "]";
  var outname = "quick_updates_new[products_margin][" + product + "]";

  var netPrice = document.forms["quick_updates"].elements[innamePrice].value;
  var netCost = document.forms["quick_updates"].elements[innameCost].value;

  if ((netPrice != 0) && (netCost !=0)) {
    var netMargin = ((netPrice - netCost) / (netCost / 100 ));
  } else {
    var netMargin = 0;
  }

  document.forms["quick_updates"].elements[outname].value = doRound(netMargin, 2);
}

function doRound(x, places) {
  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
  return x;
}

function getTaxRate(product) {
  var taxname = "quick_updates_old[products_tax_value][" + product + "]";
  var taxValue = document.forms["quick_updates"].elements[taxname].value;

  return(taxValue);
// return 19;
  }
