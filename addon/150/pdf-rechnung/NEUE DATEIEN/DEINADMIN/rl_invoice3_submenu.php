<?php
echo 
<<<BEG

<div id="adminbox2">
  <ul>
    <li class="makemenu1"><a class="rladmin {param: 'install'}"   href="#">Installieren</a></li>
    <li class="makemenu1"><a class="rladmin {param: 'remove'}"    href="#">Entfernen</a></li>
    <li class="makemenu1"><a class="rladmin {param: 'checkpath'}" href="#">Pfadangaben prüfen</a></li>
  </ul>
</div>
<div id="results"> </div>

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