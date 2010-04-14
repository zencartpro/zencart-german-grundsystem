// JavaScript Document
// $Id: rl_invoice3_template.js 83 2010-03-09 10:14:25Z rainer langheiter $

$(document).ready(function() {   
    
    //$('#content').css('background-color', '#CCC');
    var aktPaperSize = 0;
    var aktOriantation = 0;
    var papersizeS = ['A4', 'Legal', 'Letter'];
    var papersize = ['a4', 'legal', 'letter'];
    var oriantation = ['P', 'L'];

    papersize[0] = [420, 594];
    papersize[1] = [432, 711];
    papersize[2] = [432, 559];

    var ps;
    ps = [420, 594];    
    
    getDBValues();
    

    var p = $("#writing").offset();
    var t = convertPX($("#writing").css('top'));
    var l = convertPX($("#writing").css('left'));
    var w = convertPX($("#writing").css('width'));
    var r = ps[0] - l - w;
    var b = ps[1] - convertPX($("#writing").css('height'));
    
    $("#writing").resizable({
        containment: 'parent',
        grid: [2,2],        
        knobHandles: true,
        autoHide: true,    
        transparent: false, 
        handles: "all",
        minWidth: 100,
        minHeight: 100,
        start: function(e, ui) { 
            //$(this).append("Start!") 
        }, 
        stop: function(e, ui) {
            disp();  
            //displayPos();
        }, 
        drag: function(e, ui) { 
            //displayPos();
        }        
    });

    $("#adr1").resizable({
        containment: 'parent',
        grid: [2,2],   
        knobHandles: false,
        autoHide: true,    
        transparent: true, 
        handles: "e",
        minWidth: 100,
        minHeight: 60,
        start: function(e, ui) { 
            //$(this).append("Start!") 
        }, 
        stop: function(e, ui) {
            disp();  
            //displayPos();
        }, 
        drag: function(e, ui) { 
            //displayPos();
        }        
    });

    $("#adr2").resizable({
        containment: 'parent',
        grid: [2,2],   
        knobHandles: false,
        autoHide: true,    
        transparent: true, 
        handles: "e",
        minWidth: 100,
        minHeight: 60,
        start: function(e, ui) { 
            //$(this).append("Start!") 
        }, 
        stop: function(e, ui) {
            disp();  
            //displayPos();
        }, 
        drag: function(e, ui) { 
            //displayPos();
        }        
    });

    $("#adr1").draggable({
        containment: '#writing',
        axis: 'x,y',
        grid: [2,2],
       
        start: function(e, ui) { 
            //$(this).append("Start!") 
        }, 
        stop: function(e, ui) {
            disp();  
            //displayPos();
        }, 
        drag: function(e, ui) { 
            //displayPos();
        }         
    });

    $("#adr2").draggable({
        containment: 'parent',
        axis: 'x,y',
        grid: [2,2],
       
        start: function(e, ui) { 
            //$(this).append("Start!") 
        }, 
        stop: function(e, ui) {
            disp();  
        }, 
        drag: function(e, ui) { 
            //displayPos();
        }
    });

    $("#page2").draggable({
        containment: 'parent',
        axis: 'x,y',
        grid: [2,2],
       
        start: function(e, ui) { 
            //$(this).append("Start!") 
        }, 
        stop: function(e, ui) { 
            var w = $("#page2").offset();
            x = w.left;
            y = w.top;
            tw = $("#writing").css('top');    
            t = $("#page2").css('top');    
            $('#result').html('page2:  X:' + x + '  Y:'+y + '  T:'+t + '  TW:'+tw);
            disp();
            //$('#result').html('xxx');
            //displayPos();
        }, 
        drag: function(e, ui) { 
            //displayPos();
        }         
    });

    $("#invoice").draggable({
        containment: 'parent',
        axis: 'y',
        grid: [2,2],
       
        start: function(e, ui) { 
            //$(this).append("Start!") 
        }, 
        stop: function(e, ui) {
            disp();  
            //displayPos();
        }, 
        drag: function(e, ui) { 
            //displayPos();
        }
    });

    $("#detail").draggable({
        containment: 'parent',
        axis: 'y',
        grid: [2,2],
       
        start: function(e, ui) { 
            //$(this).append("Start!") 
        }, 
        stop: function(e, ui) {
            disp();  
            //displayPos();
        }, 
        drag: function(e, ui) { 
            //displayPos();
        }
    });

    $("#form2").draggable({
        grid: [1,1],
        //containment: '#content',  
        axis: 'x,y'
    });


    function disp(){
        setPos();
        
        var p = $("#content").offset();
        $('#result').append( "CONTENT: left: " + p.left + ": top: " + p.top + $("#content").css('top')  +'<br />' );
        
        var p = $("#papercontainer").offset();
        $('#result').append( "papercontainer: left: " + p.left + ": top: " + ': TOP:' + $("#papercontainer").css('top')  +'<br />' );
        
        var p = $("#paper").offset();
        $('#result').append( "paper: left: " + p.left + ": top: " + p.top + ': TOP:' + $("#paper").css('top')  +'<br />' );
        
        var p = $("#writing").offset();
        $('#result').append( "writing: left: " + p.left + ": top: " + p.top + ': TOP:' + $("#writing").css('top')  +'<br />' );
        /*
        var t = convertPX($("#writing").css('top'));
        var l = convertPX($("#writing").css('left'));
        var r = ps[0] - l - convertPX($("#writing").css('width'));
        var b = ps[1] - convertPX($("#writing").css('height'));
        */
        $('#RL_INVOICE3_MARGIN_TOP').val(t);  
        $('#RL_INVOICE3_MARGIN_RIGHT').val(r);  
        $('#RL_INVOICE3_MARGIN_BOTTOM').val(b);
        $('#RL_INVOICE3_MARGIN_LEFT').val(l); 
        
        var p = $("#adr1").offset();
        $('#result').append( "adr1: left: " + p.left + ": top: " + p.top + ': TOP:' + $("#adr1").css('top') + ': LEFT:' + $("#adr1").css('left')+ ': WIDTH:' + $("#adr1").css('width')  +'<br />' );
        $('#RL_INVOICE3_ADDRESS1_POS_Y').val( convertPX($("#adr1").css('top')));
        $('#RL_INVOICE3_ADDRESS1_POS_X').val( convertPX($("#adr1").css('left')));
        $('#RL_INVOICE3_ADDRESS_WIDTH_1').val( convertPX($("#adr1").css('width')));
        
        var p = $("#adr2").offset();
        $('#result').append( "adr2: left: " + p.left + ": top: " + p.top + ': TOP:' + $("#adr2").css('top') + ': LEFT:' + $("#adr2").css('left')  +'<br />' );
        $('#RL_INVOICE3_ADDRESS2_POS_Y').val( convertPX($("#adr2").css('top')));
        $('#RL_INVOICE3_ADDRESS2_POS_X').val( convertPX($("#adr2").css('left')));
        $('#RL_INVOICE3_ADDRESS_WIDTH_2').val( convertPX($("#adr2").css('width')));
        
        var p = $("#page2").offset();
        $('#result').append( "page2: left: " + p.left + ": top: " + p.top + ': TOP:' + $("#page2").css('top')  +'<br />' );
        $('#RL_INVOICE3_DELTA_2PAGE').val( convertPX($("#page2").css('top')));                                               
        
        var p = $("#invoice").offset();
        $('#result').append( "invoice: left: " + p.left + ": top: " + p.top + ': TOP:' + $("#invoice").css('top')  + ': LEFT:' + $("#invoice").css('left')  +'<br />' );
        $('#RL_INVOICE3_DELTA_1').val( convertPX($("#invoice").css('top')));

        var x = Math.max($('#RL_INVOICE3_ADDRESS1_POS_Y').val(), $('#RL_INVOICE3_ADDRESS2_POS_Y').val());
        var x2 = convertPX($("#invoice").css('top')) - x - convertPX($("#adr1").css('height'));
        $('#RL_INVOICE3_DELTA_1').val(x2);
        
        var p = $("#detail").offset();
        $('#result').append( "detail: left: " + p.left + ": top: " + p.top + ': TOP:' + $("#detail").css('top')  +'<br />' );
        $('#RL_INVOICE3_DELTA_2').val( convertPX($("#detail").css('top')));
        var x2 = convertPX($("#detail").css('top')) - convertPX($("#invoice").css('top')) - convertPX($("#invoice").css('height'));
        $('#RL_INVOICE3_DELTA_2').val(x2);
    }    

    $(".y, .x, .w, .m").spin({max:500,min:0, interval:2, timeInterval: 150, imageBasePath:'../../ajax/img/8/'});       
    
    $("input[@type='text']").change( function(e) {
        writeDisplay(this);
    }); 
    
    function writeDisplay(e){
        var y = new Number(($(e).val()));
        var x = Math.max($('#RL_INVOICE3_ADDRESS1_POS_Y').val(), $('#RL_INVOICE3_ADDRESS2_POS_Y').val());
        
        if ( $(e).hasClass("y") && $(e).hasClass("adr1")) $('#adr1').css('top', y);
        if ( $(e).hasClass("y") && $(e).hasClass("adr2")) $('#adr2').css('top', y);
        if ( $(e).hasClass("y") && $(e).hasClass("delta1")) {
            var d11 = 0 + (x*1) + (convertPX($("#adr1").css('height'))*1);
            var d11 = 0 + (x*1) + (convertPX($("#adr1").css('height')));
            $('#result').html( "d11: " + d11 +'<br />' );
            $('#invoice').css('top', y + d11);
        }
        if ( $(e).hasClass("y") && $(e).hasClass("delta2")) {
            var d11 = (convertPX($("#invoice").css('top'))*1) + (convertPX($("#invoice").css('height'))*1);
            $('#result').html( "d11: " + d11 +'<br />' );
            $('#detail').css('top', y + d11);
        }
        if ( $(e).hasClass("y") && $(e).hasClass("page2") ) $('#page2').css('top', y);
        if ( $(e).hasClass("x") && $(e).hasClass("adr1") ) $('#adr1').css('left', y);
        if ( $(e).hasClass("x") && $(e).hasClass("adr2") ) $('#adr2').css('left', y);

        if ( $(e).hasClass("w") && $(e).hasClass("adr1") ) $('#adr1').css('width', y);
        if ( $(e).hasClass("w") && $(e).hasClass("adr2") ) $('#adr2').css('width', y);
        
        if ( $(e).hasClass("m") && $(e).hasClass("RL_INVOICE3_MARGIN_LEFT") ) {
            setPos();
            m = (l*1 - y*1)*1;
            ww = (m*1 + w*1) * 1;
            $('#result').html(m + ' : ' + l  + ' : ' +  y + ' : ' +  w + ' : ' + ww);
            $('#writing').css('left', y);  
            $('#writing').css('width', ww);
        }
        if ( $(e).hasClass("m") && $(e).hasClass("RL_INVOICE3_MARGIN_RIGHT") ) {
            setPos();
            m = (r*1 - y*1)*1;
            ww = (m*1 + w*1) * 1;
            $('#result').html(m + ' : ' + l  + ' : ' +  y + ' : ' +  w + ' : ' + ww);
            $('#writing').css('width', ww);
        }
        if ( $(e).hasClass("m") && $(e).hasClass("RL_INVOICE3_MARGIN_TOP") ) {
            setPos();
            m = (y*1 - t*1)*1;
            ww = (m*1 + t*1) * 1;
            $('#result').html(m + ' : ' + t  + ' : ' +  y + ' : ' +  w + ' : ' + ww + ' : ' + h);
            $('#writing').css('top', ww);
            $('#writing').css('height', (h*1+m*-1));
        }
        if ( $(e).hasClass("m") && $(e).hasClass("RL_INVOICE3_MARGIN_BOTTOM") ) {
            setPos();
            m = (y*1 - b*1)*1;
            ww = (m*1 - t*1) * 1;
            h2 = ps[1] - $('#RL_INVOICE3_MARGIN_TOP').val() - $('#RL_INVOICE3_MARGIN_BOTTOM').val();
            $('#result').html(m + ' : ' + t  + ' : ' +  y + ' : ' +  w + ' : ' + b + ' : ' + h2);
            //$('#writing').css('top', ww);
            $('#writing').css('height', (h*1+m*-1-t));
            $('#writing').css('height', (h2));
        }
        //disp(); 
    }
    
    function convertPX(str){
        var tmp = str.replace('px', '');
        var tmp = str.replace('px', '');
        var t = new Number(tmp.replace('pt', ''));
        return t;
    }
    function setPos(){
        p = $("#writing").offset();
        t = convertPX($("#writing").css('top'));
        l = convertPX($("#writing").css('left'));
        w = convertPX($("#writing").css('width'));
        h = convertPX($("#writing").css('height'));
        h2 = ps[1] - $('#RL_INVOICE3_MARGIN_TOP').val() - $('#RL_INVOICE3_MARGIN_BOTTOM').val();   
        r = ps[0] - l - w;
        b = ps[1] - h - t;
        $('#result').html('t:'+t+'  l:'+l+'  w:'+w+'   h:'+h+'  r:'+r+'   b:'+b+'  ps[1]:'+ps[1]+'  h2:' + h2 + '<br />');
    }
    
    function getDBValues(){
        $.getJSON("rl_invoice3_ajax.php?p=Defaultvalues", function(json){
            var xxx = json;
            var out = '<h3 style="color:#FF0000; background-color: #DDEE22;">Database values</h3>';
            jQuery.each(json, function(i, val) {
                out = out + i + '::' + val + '<br />';
                $('#'+i).val(val);
                $('#'+i).change();
            });
            $('#result').html(out);
        });
    }
    
    var options = { 
        target:        '#result',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
    }; 
    // bind form using 'ajaxForm' 
    $('#form2').ajaxForm(options);     

    function showRequest(formData, jqForm, options) { 
        return true; 
    } 
     
    // post-submit callback 
    function showResponse(responseText, statusText)  { 
    }     
    
    
});
                     
                     
