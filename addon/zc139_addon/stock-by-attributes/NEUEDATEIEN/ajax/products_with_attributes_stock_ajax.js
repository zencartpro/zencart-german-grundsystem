// $Id: products_with_attributes_stock_ajax.js 389 2008-11-14 16:02:14Z hugo13 $

$(document).ready(function() { 
    // bind form using ajaxForm 
    $('#pwas-search').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#pwa-table',
        url: 'products_with_attributes_stock_ajax.php', 
        success:  addEvent
 
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
    });
});

$(document).ready(function() { 
    // bind form using ajaxForm 
    $('#store').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#hugo1', 
        success: saved
 
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
    }); 
});


function processJasonFree(data) { 
    //processLocations(data);

    //var paragraphCount = document.evaluate( 'count(/html/body/div[2]/div[3]/div/div[2]/div/div/iframe)', document, null, XPathResult.ANY_TYPE, null );
    //alert( 'This document contains ' + paragraphCount.numberValue + ' paragraph elements' );    
}

$(document).ready(function(){
    $("#btnrandom").click(function(e){
        e.preventDefault(); // Normales Submit unterdrücken

        $.ajax({ // AJAX Request auslösen
            type: "POST",
            url: '/data/random/5a0bc3836e07a7be06a2fc3109b9d9daaffeafda/1',
            dataType: 'json',
            global: 'false',
            success: processJason
        });
    });
    $("#loading").hide();    // Das Loding Element verstecken
    $(".stockAttributesCellQuantity").click(function(event){
        var $tgt = $(event.target);
        var $id = this.id;
        var $inner = this.innerHTML;
        if (!$tgt.is('input')) {
            if(!this.hasEventHander){
            var $newLi = '<input type="text" name="' + $id + '" id="' + $id + '" value="' + $inner + '" size="8"/>';
            this.innerHTML = $newLi;
                this.hasEventHander = true;
        }
        }        
    })
    $("#loading")
        .ajaxStart(function(){   // Wird ausgeführt sobald AJAX startet
            $(this).show(00);
        })    
        .ajaxError(function(){   // Wird ausgeführt bei AJAX ERROR
            $(this).show(500);
        })    
        .ajaxSuccess(function(){      // Wird ausgeführt sobald AJAX fertig ist
            $(this).hide(500);
        });
});

function addEvent() {
 $('.stockAttributesCellQuantity').each(
            function(){
                if(!this.hasEventHander)
                    $(this).click(function(event){    
                    /*/ Our Eventhanderl /*/    
                    var $tgt = $(event.target);
                    var $id = this.id;
                    var $inner = this.innerHTML;
                    if (!$tgt.is('input')) {
                        var $newLi = '<input type="text" name="' + $id + '" id="' + $id + '" value="' + $inner + '" size="8"/>';
                        this.innerHTML = $newLi;
                        //this.unbind("click");
                    }        
                });
                this.hasEventHander = true;
            }
        );
}
function saved(responseText, statusText)  { 
    alert('status: ' + statusText + '\n\nresponseText: \n' + responseText ); 
}