jQuery(document).ready(function() {
  // LICENSE
  // hide documentation unless license terms are agreed
  jQuery('#licenseAgreed').hide();
  // show the documentation if the page loads with agreement radio checked
  if (jQuery('input[name="license"]:checked').val() == 1) {
    jQuery('#licenseAgreed').fadeIn();
  }
  // bind click event to license agreement and show/hide documentation based on selection
  jQuery('input[name="license"]').live('click', function() {
    if (jQuery('input[name="license"]:checked').val() == 1) {
      jQuery('#licenseAgreed').fadeIn(); 
    } else {
      jQuery('#licenseAgreed').fadeOut();
    } 
  });
  
  // CODE BOXES
  // highlight
  sh_highlightDocument();
  // select all functionality
  jQuery('.select').live('click', function() {
    selectCode(jQuery(this).parent('div').next('pre').children('code')[0]);
  });
});

function selectCode(a)
{
  // Get ID of code block
  var e = a.parentNode.parentNode.getElementsByTagName('CODE')[0];

  // Not IE
  if (window.getSelection)
  {
    var s = window.getSelection();
    // Safari
    if (s.setBaseAndExtent)
    {
      s.setBaseAndExtent(e, 0, e, e.innerText.length - 1);
    }
    // Firefox and Opera
    else
    {
      // workaround for bug # 42885
      if (window.opera && e.innerHTML.substring(e.innerHTML.length - 4) == '<BR>')
      {
        e.innerHTML = e.innerHTML + '&nbsp;';
      }

      var r = document.createRange();
      r.selectNodeContents(e);
      s.removeAllRanges();
      s.addRange(r);
    }
  }
  // Some older browsers
  else if (document.getSelection)
  {
    var s = document.getSelection();
    var r = document.createRange();
    r.selectNodeContents(e);
    s.removeAllRanges();
    s.addRange(r);
  }
  // IE
  else if (document.selection)
  {
    var r = document.body.createTextRange();
    r.moveToElementText(e);
    r.select();
  }
}