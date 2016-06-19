// JavaScript Document
// $Id: rl_invoice3.js 484 2012-07-12 17:19:17Z webchills $

    
$(document).ready(function() {
        $("#admin").click(function(event) { 
            event.preventDefault();
            $.ajax({
              url: "rl_invoice3_submenu.php",
              cache: false,
              success: function(html){
                $("#content").html(html);
                $('#donationbox').show();
              }
            });   
//            return false;          
            
        });
        
        
        $("#template").click(function() { 
            $('#donationbox').css('display', 'none');
            $.ajax({
              url: "rl_invoice3_visuell.php",
              cache: false,
              success: function(html){
                $("#content").html(html);
                $('#donationbox').hide();
              }
            });   
        });
                    
        $("#fonttest").click(function() { 
            $('#donationbox').css('display', 'none');
            $.ajax({
              url: "rl_invoice3_fonttest.php",
              cache: true,
              success: function(html){
                $("#content").html(html);
                //$("#content").append('<a id="fonttest" href="../../includes/pdf/rl_invoice3_fontest.pdf">   FontTest !!!</a>');
                //$("#fonttest").media( { width: '100%', height: 800} ); 
                $(".fonttest").media( { width: '100%', height: 800, src: '../../pdf/rl_invoice3_fontest.pdf'} ); 
              }
            });            
        });

        $("#testinvoice").click(function() { 
            $('#donationbox').css('display', 'none');
            $.ajax({
              url: "rl_invoice3.php?test=PDF&oID=1",
              cache: true,
              success: function(html){
                $("#content").html(html);
                //$("#content").html('<a class="fonttest" href="../../includes/pdf/rl_invoice3_fontest.pdf">FontTest</a>');
                $('.fonttest').media( { width: '100%', height: 800} ); 
              }
            });            
        });
        
    $("#loading").ajaxStart(function(r,s){
        //$("#loading").append('<img src="../images/ajax-loader.gif">loading...');
       $(this).show();
       $("#loading").html('<img src="rl_invoice3/ajax/img/spinner_balken.gif">loading...');
       
    });
    $("#loading").ajaxStop(function(r,s){
       $(this).hide(); 
    }); 
        
        
    });