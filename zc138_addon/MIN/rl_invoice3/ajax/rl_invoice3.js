// JavaScript Document
// $Id$


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
//displayPos();


$("#writing").resizable({ 
    handles: "all", 
	transparent: true,
	grid: [2, 2] ,
	minWidth: 100, 
    minHeight: 100, 
    //maxWidth: 410, 
    //maxHeight: 580 ,
	containment: "parent",
	knobHandles: true,
    start: function(e, ui) { 
        /* $(".write").append("Start!") */
    }, 
    stop: function(e, ui) { 
        displayPos();                             
    }, 
    resize: function(e, ui) { 
		displayPos();
        /*$(this).append("Resize!");*/ 
    } 
});


$("#form1").draggable({ 
    //axis: "x",
	grid: [2, 2] ,
	//containment: "parent",
	cursor: "move",
    start: function(e, ui) { 
        //$(this).append("Start!") 
    }, 
    stop: function(e, ui) { 
		displayPos();
    }, 
    drag: function(e, ui) { 
		displayPos();
    }  
});

$("#invoice").draggable({ 
    axis: "y",
	grid: [2, 2] ,
	containment: "parent",
	cursor: "move",
    start: function(e, ui) { 
        //$(this).append("Start!") 
    }, 
    stop: function(e, ui) { 
		displayPos();
    }, 
    drag: function(e, ui) { 
		displayPos();
    }  
});
$(".adr").draggable({ 
    //axis: "y",
	grid: [2, 2] ,
	containment: "parent",
	cursor: "move",
    start: function(e, ui) { 
        //$(this).append("Start!") 
    }, 
    stop: function(e, ui) { 
		displayPos();
    }, 
    drag: function(e, ui) { 
		displayPos();
    }  
	 
});
$(".adr2").draggable({ 
    //axis: "y",
	grid: [2, 2] ,
	containment: "parent",
	cursor: "move",
    start: function(e, ui) { 
        //$(this).append("Start!") 
    }, 
    stop: function(e, ui) { 
		displayPos();
    }, 
    drag: function(e, ui) { 
		displayPos();
    }  
	 
});

$(".detail").draggable({ 
    axis: "y",
	cursor: "move",
	containment: "parent",
	grid: [2, 2] ,
    start: function(e, ui) { 
        //$(this).append("Start!") 
    }, 
    stop: function(e, ui) { 
		displayPos();
    }, 
    drag: function(e, ui) { 
		displayPos();
    }  
});
$(".page2").draggable({ 
    axis: "y",
	containment: "parent",
	grid: [2, 2] ,
	cursor: "move",
    start: function(e, ui) { 
        //$(this).append("Start!") 
    }, 
    stop: function(e, ui) { 
		displayPos();
    }, 
    drag: function(e, ui) { 
		displayPos();
    }  
});        
function displayPos(){
	t = $(".paper").offset();
	w = $(".writing").offset();
	x = w.left;
	y = w.top;
	writingX = w.left - t.left;
	writingY = w.top - t.top;
	writingH = $(".writing").height();
	writingW = $(".writing").width();
	//alert(writingW)
	tmp = writingY + '|' + (ps[0] - writingW - writingX) + '|' + (ps[1] - writingY - writingH) + '|' + (writingX);
	$("#RL_INVOICE3_MARGIN").val(tmp);
	
	adrPos = $(".adr").offset();
	adrPosX = adrPos.left - x;
	adrPosY = adrPos.top - y;
	adrPosH = $(".adr").height();
	
	adr2Pos = $(".adr2").offset();
	adr2PosX = adr2Pos.left - x;
	adr2PosY = adr2Pos.top - y;
	adr2PosH = $(".adr2").height();
	
	invoicePos = $(".invoice").offset();
	invoicePosX = invoicePos.left - x;
	invoicePosY = invoicePos.top - y;
	invoicePosH = $(".invoice").height();
	
	detailPos = $(".detail").offset();
	detailPosX = detailPos.left - x;
	detailPosY = detailPos.top - y;
	detailPosH = $(".detail").height();

	page2Pos = $(".page2").offset();
	page2PosX = page2Pos.left - x;
	page2PosY = page2Pos.top - y;
	
	
	h = $("#writing").height();
	x = $(".adr2").height();
	$("#RL_INVOICE3_ADDRESS2_POS").val(adr2PosX + '|' + adr2PosY);
	delta1 = invoicePosY - adr2PosY - adr2PosH;
	delta2 = detailPosY - invoicePosY - invoicePosH;
	if(delta1 < 0) {
		delta1 = 0;
		$(".invoice").css('top', adr2PosY+adr2PosH);	
	}

	h = $("#writing").height();
	x = $(".adr").height();
	$("#RL_INVOICE3_ADDRESS1_POS").val(adrPosX + '|' + adrPosY);
	delta1 = invoicePosY - adrPosY - adrPosH;
	delta2 = detailPosY - invoicePosY - invoicePosH;
	if(delta1 < 0) {
		delta1 = 0;
		$(".invoice").css('top', adrPosY+adrPosH);	
	}
	if(delta2 < 0) {
		delta2 = 0;
		$(".detail").css('top', invoicePosY + invoicePosH);	
	}
	$("#RL_INVOICE3_DELTA").val(delta1 + '|' + delta2);

	$("#RL_INVOICE3_DELTA_2PAGE").val(page2PosY);
	
	$("#RL_INVOICE3_PAPER").val(papersizeS[aktPaperSize] + '|mm|' + oriantation[aktOriantation]);
		
	s = "<span id='res'>height:" + h + "    adrPos:" + adrPosY + '::' + adrPosX + "    DetailPos:" + detailPosY + '<br />'
	$("#result").html(s + "    Page2Pos:" + page2PosY +  "    invoicePos:" + invoicePosY + '</span>'); 
	
	
	
}

$("input[@name='paperformat']").click(function(){
    aktPaperSize = $("input[@name='paperformat']:checked").val();
    setPaper();
});    
    
$("input[@name='oriantation']").click(function(){
	aktOriantation = $("input[@name='oriantation']:checked").val();
	setPaper();
	displayPos();
});	
	
function setPaper(){
	paper = papersize[aktPaperSize]
	if(aktOriantation==0){
		$(".paper").css('width', paper[0]+'px');
		$(".paper").css('height', paper[1]+'px');
		ps[0] = paper[0];
		ps[1] = paper[1];

		var margins = $("#RL_INVOICE3_MARGIN").val().split('|'); 
		$('.writing').css('width', (ps[0]-margins[1]-margins[3] )+ 'px');
		$('.writing').css('height', (ps[1]-margins[0]-margins[2] )+ 'px');
		$('.paper').css('background-image', 'url(images/rl_invoice3_bg420.jpg)');
	} else {
		aktOriantation = 1;
		$(".paper").css('width', paper[1]+'px');
		$(".paper").css('height', paper[0]+'px');
		ps[0] = paper[1];
		ps[1] = paper[0];

		var margins = $("#RL_INVOICE3_MARGIN").val().split('|'); 
		$('.writing').css('width', (ps[0]-margins[1]-margins[3] )+ 'px');
		$('.writing').css('height', (ps[1]-margins[0]-margins[2] )+ 'px');
		$('.paper').css('background-image', 'url(images/rl_invoice3_bgL420.jpg)');
		
	}
	displayPos();
}
 
    
$(document).ready(function() {
        $("#admin").click(function(event) { 
            event.preventDefault();
            $.ajax({
              url: "admin.php",
              cache: false,
              success: function(html){
                $("#content").html(html);
                $('.donationbox').show();
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
                $('.donationbox').show();
              }
            });            
            
        });
        
        $("#template").click(function() { 
            $.ajax({
              url: "rl_invoice3_visuell.php",
              cache: false,
              success: function(html){
                $("#content").html(html);
                $('.donationbox').hide();
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
       $("#loading").html('<img src="../images/ajax-loader.gif">loading...');
       
    });
    $("#loading").ajaxStop(function(r,s){
       $(this).hide(); 
    }); 
        
        
    });