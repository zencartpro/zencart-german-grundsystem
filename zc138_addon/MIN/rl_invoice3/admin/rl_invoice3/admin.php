<?php
echo 
<<<BEG

<div class="adminbox" style="clear:both">
  <ul style="background-color:#F5F5F5; border: solid #CCCCCC; border-width: 1px 0px;">
    <li class="makemenu1"><a class="rladmin {param: 'install'}"   href="#">install</a></li>
    <li class="makemenu1"><a class="rladmin {param: 'remove'}"    href="#">remove</a></li>
    <li class="makemenu1"><a class="rladmin {param: 'checkpath'}" href="#">check paths</a></li>
  </ul>
</div>
<div id="results">RESULTS</div>

<script type="text/javascript">
$(document).ready(function() {
      $(".rladmin").each(function (i, e) {
        $(e).click(function() { 
            //alert('klick + ' + $(e).metadata().param );
            
            $.ajax({
              url: "rl_invoice3_ajax.php?p="+ $(e).metadata().param,
              cache: false,
              success: function(html){
                $("#results").html(html);
              }
            });            
                        
            
            
            
            
        });  
      });
        
    });
</script>        
BEG;
#sleep(1); 