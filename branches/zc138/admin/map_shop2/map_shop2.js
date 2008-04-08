// @package map_shop
// @desc map_shop generates google_map entries at http://shops.zen-cart.at
// @copyright Copyright 2006-2007 rainer langheiter
// @author rainer langheiter <zen-cart@langheiter.com http://edv.langheiter.com/zencart/>
// @license http://www.gnu.org/copyleft/gpl.html     
// @version $Id$

$.ajaxSetup({
  type: "POST"
});

$(document).ready(function() { 
    $("#getLL").click(function(e){
        e.preventDefault(); // Normales Submit unterdrücken

        $.ajax({ // AJAX Request auslösen
            type: "POST",
            url: 'map_shop2_func.php',
            dataType: 'json',
            global: 'false',
            data: "ac=a&a=" + $('#MAP_SHOP2_COUNTRY').val() + ',' + $('#MAP_SHOP2_ZIP').val() + ',' + $('#MAP_SHOP2_STREET').val() + '&f=' + $('#MAP_SHOP2_GETCOORD').val(),
            //data: "a=" + $('#MAP_SHOP2_COUNTRY').val() + ',' + $('#MAP_SHOP2_ZIP').val() + ',' + $('#MAP_SHOP2_STREET').val(),
            success: showResponse
        });
    });
    $("#GOOGLEMAP").click(function(e){
        e.preventDefault(); // Normales Submit unterdrücken

        $.ajax({ // AJAX Request auslösen
            type: "POST",
            url: 'map_shop2_func.php',
            dataType: 'html',
            global: 'false',
            data: "ac=m&a=" + $('#MAP_SHOP2_COUNTRY').val() + ',' + $('#MAP_SHOP2_ZIP').val() + ',' + $('#MAP_SHOP2_STREET').val() + '&f=' + $('#MAP_SHOP2_GOOGLEMAP').val(),
            //data: "a=" + $('#MAP_SHOP2_COUNTRY').val() + ',' + $('#MAP_SHOP2_ZIP').val() + ',' + $('#MAP_SHOP2_STREET').val(),
            success: showMap
        });
    });
    var options = { 
        success:       showResponse,  // post-submit callback 
        url: 'map_shop2_func.php?ac=d', 
        type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
    
    $('#f1').submit(function() { 
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 

});
                                           
function showResponse(responseText, statusText){
    $('#MAP_SHOP2_LAT').val(responseText.lat);
    $('#MAP_SHOP2_LNG').val(responseText.lng);
    $('#MAP_SHOP2_DESCRIPTION').val(responseText.post);
    //alert(responseText.lat);
}
function showMap(responseText, statusText){
    //alert(responseText);
    $('#map').html(responseText);
}