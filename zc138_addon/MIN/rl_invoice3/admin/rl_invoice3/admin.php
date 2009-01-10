<?php
echo 
<<<BEG

<div id="adminbox2">
  <ul>
    <li><a class="rladmin {param: 'install'}"   href="#">install</a></li>
    <li><a class="rladmin {param: 'remove'}"    href="#">remove</a></li>
    <li><a class="rladmin {param: 'checkpath'}" href="#">check paths</a></li>
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