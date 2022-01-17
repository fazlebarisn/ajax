jQuery(function ($) {
    'use strict';
    $(document).ready(function () {
        $(document.body).on('change','input.message_2',function(){
            var text = $(this).val();
            $(this).closest('tr').attr('additional_json', text);
        });

        $(document.body).on('change','.wpt_product_table_wrapper table tr td .wpt_varition_section select[data-attribute_name="attribute_pa_color"]',function(){
            var current_val = $(this).val();

            $(this).closest('tr').find('div.wpt_new_message').hide();
            $(this).closest('tr').find('div.wpt_message').hide();

            if(current_val == '1-paint-color'){
                $(this).closest('tr').find('div.wpt_message').fadeIn();
            }else if(current_val == '2-paint-color'){
                $(this).closest('tr').find('div.wpt_new_message').fadeIn();
                $(this).closest('tr').find('div.wpt_message').fadeIn();
            }

        });
        
        $(document.body).on('change','.wpt_product_table_wrapper table tr td .wpt_varition_section select[data-attribute_name="attribute_pa_finish"]',function(){
            var current_val = $(this).val();

            $(this).closest('tr').find('div.wpt_new_message').hide();
            $(this).closest('tr').find('div.wpt_message').hide();

            if(current_val == 'painted'){
                $(this).closest('tr').find('div.wpt_message').fadeIn();
            }
        });
		
		$('tr .td_or_cell.wpt_action').each(function( in_dex ){
            $(this).prepend("<div class='inactive-fake-button'>Add to cart</div>");
        });
		
		$(document.body).on('click','.inactive-fake-button',function(){
			alert("Not Allowed");
		});
		$(document.body).on('change','.wpt_varition_section select',function(){
// 			$(".table-inputbox,.table-inputbox2").val('0000');
			var actionSelector = $(this).closest('tr').find('.td_or_cell.wpt_action');
			var thisRow = $(this).closest('tr');
            var rowID = thisRow.attr( 'id' );

			var selectedColor = $(this).children("option:selected").val();
			if( selectedColor === '1-paint-color'){
				actionSelector.removeClass("wpt-ok");
				$(".table-inputbox,.table-inputbox2").keyup(function(e){
            var rowID = thisRow.attr( 'id' );
					updateFirstPaint(e);
				});
			}else if( selectedColor === '2-paint-color' ){
				actionSelector.removeClass("wpt-ok");
				$(".table-inputbox,.table-inputbox2").keyup(function(e){
					updateSecondPaint(e);
				});		
			}else{
				$(".table-inputbox,.table-inputbox2").val('');
				$(".table-inputbox,.table-inputbox2").trigger('change');
				updateWithoutPaint();
			}
			
			function updateWithoutPaint(){
				actionSelector.addClass("wpt-ok");
				$('#' + rowID + ' .display-temp-error').remove();
				$('#' + rowID + ' .display-temp-error2').remove();
				
				$("#" + rowID + " .table-inputbox").val('');
				$("#" + rowID + " .table-inputbox2").val('');
			}
			function updateSecondPaint(e){
				$('#' + rowID + ' .display-temp-error').remove();
				$('#' + rowID + ' .display-temp-error2').remove();
				
				let inputVal = $("#" + rowID + " .table-inputbox").val();
				let inputVal2 = $("#" + rowID + " .table-inputbox2").val();
				
				var countN = inputVal.toString().length;
				var countN2 = inputVal2.toString().length;
				if( countN == 4 && countN2 == 4 ){
					actionSelector.addClass("wpt-ok");
					$('#' + rowID + ' .display-temp-error').remove();
					$('#' + rowID + ' .display-temp-error2').remove();
				}else if( inputVal =="" || countN < 4 ){
					actionSelector.removeClass("wpt-ok");
					e.preventDefault();
					$("#" + rowID + " .table-inputbox").after('<span class="display-temp-error">Need 4 Digit Number</span>');
				}else if( inputVal2 =="" || countN2 < 4 ){
					actionSelector.removeClass("wpt-ok");
					e.preventDefault();
					$("#" + rowID + " .table-inputbox2").after('<span class="display-temp-error2">Need 4 Digit Number</span>');
				}
			}
			function updateFirstPaint(e){
				$('#' + rowID + ' .display-temp-error').remove();
				let inputVal = $("#" + rowID + " .table-inputbox").val();
				var countN = inputVal.toString().length;
				if( inputVal =="" || countN < 4 ){
					actionSelector.removeClass("wpt-ok");
					e.preventDefault();
					$("#" + rowID + " .table-inputbox").after('<span class="display-temp-error">Need 4 Digit Number</span>');
				}else{
					$('#' + rowID + ' .display-temp-error').remove();
					actionSelector.addClass("wpt-ok");
				}
			}
		});
		
    });
	
});
