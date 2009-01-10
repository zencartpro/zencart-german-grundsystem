// JavaScript Document
// $Id$

    
$(document).ready(function() {
        $("#admin").click(function(event) { 
            event.preventDefault();
            $.ajax({
              url: "admin.php",
              cache: false,
              success: function(html){
                $("#content").html(html);
                $('#donationbox').show();
              }
            });   
//            return false;          
            
        });
        $("#about").click(function() { 
            $.ajax({
              url: "about.php",
              cache: false,
              success: function(html){
                $("#content").html(html);
                $('#donationbox').show();
              }
            });            
            
        });
        
        $("#template").click(function() { 
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
            $.ajax({
              url: "./rl_invoice3_fonttest.php",
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
            $.ajax({
              url: "../rl_invoice3.php?test=PDF&oID=1",
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
       $("#loading").html('<img src="../../ajax/img/spinner_balken.gif">loading...');
       
    });
    $("#loading").ajaxStop(function(r,s){
       $(this).hide(); 
    }); 
        
        
    });