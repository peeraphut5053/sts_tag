function gotolink(link) {		
	window.location.href = link;
}

// close layer when click-out
//document.onclick = mclose; 
var myArray = new Array();
var clkColor;
var newColor;
function mOvr(src,clrOver) {
	src.bgColor = clrOver;
	src.style.cursor = 'hand';
	newColor = clrOver;
}
function mOut(src,clrOut) {	
	if (myArray[src.id] == undefined)
	{
		src.bgColor = clrOut;
		src.style.cursor = 'hand';
	} else {
		src.bgColor = clkColor;
	}
}
function mClk(src,clrOver,clrOut) {
	if (myArray[src.id] == undefined)
	{
		myArray[src.id] = "Click";
		src.bgColor = clrOver;
		clkColor = clrOver;
	} else {
		myArray[src.id] = undefined;
		src.bgColor = newColor;
	}
}
//***********************************

function popupgoto(msg,url) {
	$('<div></div>').dialog({
			modal: true,
			autoOpen: true,
			/*show: 'fade',
			hide: 'fade',*/
			title: 'STS',
			width: 600,
			height: 300,
			open: function() {
				$('.ui-dialog-buttonpane').find('button:contains(" OK ")')
					.css({
					"background-image": "url(./template/image/icon/tick.png)", "background-repeat":"no-repeat",
					"background-position":"left",
					"width":"80px"
					}
				);				
			 },
			buttons: {
				" OK ": function() { 
					$(this).empty();
					$(this).dialog("close"); 					
				}
			},
			close: function() { 
				location = url;
			 }
		})
		.html(msg)		
}

function popup(msg) {
	$('<div></div>').dialog({
			modal: true,
			autoOpen: true,
			/*show: 'fade',
			hide: 'fade',*/
			title: 'STS',
			width: 600,
			height: 300,
			open: function() {
				$('.ui-dialog-buttonpane').find('button:contains(" OK ")')
					.css({
					"background-image": "url(./template/image/icon/tick.png)", "background-repeat":"no-repeat",
					"background-position":"left",
					"width":"80px"
					}
				);				
			 },
			buttons: {
				" OK ": function() { 
					$(this).empty();
					$(this).dialog("close"); 
				}
			}
		})
		.html(msg)
}

function confirmgoto(msg,url) {
	$('<div></div>').dialog({
			modal: true,
			autoOpen: true,
			/*show: 'fade',
			hide: 'fade',*/
			title: 'STS',
			width: 600,
			height: 300,
			open: function() {
				$('.ui-dialog-buttonpane').find('button:contains(" OK ")')
					.css({
					"background-image": "url(./template/image/icon/tick.png)", "background-repeat":"no-repeat",
					"background-position":"left",
					"width":"80px"
					}
				);
				$('.ui-dialog-buttonpane').find('button:contains(" Cancel ")')
					.css({
					"background-image": "url(./template/image/icon/cancel.png)", "background-repeat":"no-repeat",
					"background-position":"left",
					"width":"80px"
					}
				);
			 },
			buttons: {
				" OK ": function() { 
					location = url;				
				},
				" Cancel ": function() { 
					$(this).empty();
					$(this).dialog("close"); 					
				}
			}
		})
		.html(msg)		
}

function showProcessing(){
	//$("#ShowProcessing").css('zIndex',9999);
	
	$("#ShowProcessing").dialog({
			modal: false,
			resizable: false,
			autoOpen: true,
			show: "fade",			
			width: 250,
			height: 110,
			create: function (event, ui) {
       			// $(".ui-widget-header").hide();
				 $('#ShowProcessing').prev('.ui-dialog-titlebar').hide();
				
   			 }
	})
		.html('<div style="padding-top:20px; padding-left:50px; "><img  src="./image/ajax-loader.gif" align="absbottom"/> Processing...</div>');
}

function closeProcessing(){
	$("#ShowProcessing").dialog("close");
	$("#ShowProcessing").empty();
}

function formatCurrencyEs(num,tsn) {
	if (tsn == undefined) tsn = 2;
    num = isNaN(num) || num === '' || num === null ? 0.00 : num;
    return parseFloat(num).toFixed(tsn);
}


//============= start calQtyStsNo ========== 

    function calQtyStsNo() {
        if ($('.qty_sts_no').val()) {
        } else {
            $('.qty_sts_no').val(0);
        }
        var sum = $('#qty_sts_sum').val();
        var perpack = $("#perpack").val();
        var qty_sts_no = parseFloat($('#qty_sts_no').val());
        var qty_sts_no2 = parseFloat($('#qty_sts_no2').val());
        var qty_sts_no3 = parseFloat($('#qty_sts_no3').val());
        if (sum <= perpack) {
            $('#qty_sts_no2').val(perpack - qty_sts_no)
            qty_sts_no2 = parseFloat($('#qty_sts_no2').val());
            if (qty_sts_no2 < 0) {
                $('#qty_sts_no2').val(0);
                qty_sts_no2 = parseFloat($('#qty_sts_no2').val());
            }
        } else {
            $('#qty_sts_no2').val(0)
        }
        sum = qty_sts_no + qty_sts_no2 + qty_sts_no3;
        $('#qty_sts_sum').val(sum);
        CalQtyWarning(sum, perpack)
    }



    function calQtyStsNo2() {
        if ($('#qty_sts_no2').val()) {
        } else {
            $('#qty_sts_no2').val(0);
        }
        var sum = $('#qty_sts_sum').val();
        var perpack = $("#perpack").val();
        var qty_sts_no = parseFloat($('#qty_sts_no').val());
        var qty_sts_no2 = parseFloat($('#qty_sts_no2').val());
        var qty_sts_no3 = parseFloat($('#qty_sts_no3').val());
        if (sum <= perpack) {
            $('#qty_sts_no3').val(perpack - qty_sts_no - qty_sts_no2)
            qty_sts_no3 = parseFloat($('#qty_sts_no3').val());
            if (qty_sts_no3 < 0) {
                $('#qty_sts_no3').val(0);
                qty_sts_no3 = parseFloat($('#qty_sts_no3').val());
            }
        } else {
            $('#qty_sts_no2').val(0)
        }
        sum = qty_sts_no + qty_sts_no2 + qty_sts_no3;
        $('#qty_sts_sum').val(sum);
        CalQtyWarning(sum, perpack)
    }


    function calQtyStsNo3() {
        if ($('#qty_sts_no3').val()) {
        } else {
            $('#qty_sts_no3').val(0);
        }
        var sum = $('#qty_sts_sum').val();
        var perpack = $("#perpack").val();
        var qty_sts_no = parseFloat($('#qty_sts_no').val());
        var qty_sts_no2 = parseFloat($('#qty_sts_no2').val());
        var qty_sts_no3 = parseFloat($('#qty_sts_no3').val());

        sum = qty_sts_no + qty_sts_no2 + qty_sts_no3;
        $('#qty_sts_sum').val(sum);
        CalQtyWarning(sum, perpack)
    }

    function CalQtyWarning(sum, perpack) {
        if (sum != perpack) {
            $("#warning-word").html("<font color='red'>จำนวนรวมไม่เท่ากับจำนวนมัดใน Tag</font>");
            $('#perpack').css({"border": '#FF0000 3px solid'});
        } else {
            $("#warning-word").html("")
            $('#perpack').css({"border": '#000000 0px solid'});
        }

    }

    function calSTDWeight() {
        var unit_weight = $("#unit_weight").val();
        var perpack = $("#perpack").val();
        $("#unit_weight_b").val(unit_weight * perpack);
        $("#qty_sts_no").val(perpack);
        $("#qty_sts_sum").val(perpack);
        
    }
//=========== end calQtyStsNo============