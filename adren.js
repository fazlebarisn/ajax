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
		
		
		$(document.body).on('change','.wpt_varition_section select',function(){
			console.log(55);
			var selectedColor = $(this).children("option:selected").val();
			if( selectedColor === '1-paint-color' ){
				$('body table').on("click",".wpt_woo_add_cart_button", function(e){
					updateFirstPaint(e);  		
				});
// 				$('.wpt_woo_add_cart_button').click(function(e){
// 					updateFirstPaint(e);  
// 				});
				$(".table-inputbox,.table-inputbox2").keyup(function(e){
					updateFirstPaint(e);
				});
			}else if( selectedColor === '2-paint-color' ){
				
// 				$(document.body).on("click",".wpt_woo_add_cart_button", function(e){
// 					updateSecondPaint(e);  		
// 				});
				
				$(".table-inputbox,.table-inputbox2").keyup(function(e){
					updateSecondPaint(e);
				});		
			}else{
				updateWithoutPaint();
				
			}
			
			function updateWithoutPaint(){
				$('.display-temp-error').remove();
				$('.display-temp-error2').remove();
				
				$(".table-inputbox").val('');
				$(".table-inputbox2").val('');
				$(".wpt_woo_add_cart_button").addClass("enabled");
			}
			function updateSecondPaint(e){
				$('.display-temp-error').remove();
				$('.display-temp-error2').remove();
				
				let inputVal = $(".table-inputbox").val();
				let inputVal2 = $(".table-inputbox2").val();
				
				var countN = inputVal.toString().length;
				var countN2 = inputVal2.toString().length;
				if( countN == 4 && countN2 == 4 ){
					$('.display-temp-error').remove();
					$('.display-temp-error2').remove();
					$(".wpt_woo_add_cart_button").addClass("enabled");
				}else if( inputVal =="" || countN < 4 ){
					$(".wpt_woo_add_cart_button").removeClass("enabled");
					e.preventDefault();
					$(".table-inputbox").after('<span class="display-temp-error">Need 4 Digit Number</span>');
				}else if( inputVal2 =="" || countN2 < 4 ){
					$(".wpt_woo_add_cart_button").removeClass("enabled");
					e.preventDefault();
					$(".table-inputbox2").after('<span class="display-temp-error2">Need 4 Digit Number</span>');
				}
			}
			function updateFirstPaint(e){
				$('.display-temp-error').remove();
				let inputVal = $(".table-inputbox").val();
				var countN = inputVal.toString().length;
				if( inputVal =="" || countN < 4 ){
					$(".wpt_woo_add_cart_button").removeClass("enabled");
					e.preventDefault();
					$(".table-inputbox").after('<span class="display-temp-error">Need 4 Digit Number</span>');
				}else{
					$('.display-temp-error').remove();
					$(".wpt_woo_add_cart_button").addClass("enabled");
				}
			}
		});
		
// 		$('.col_inside_tag.action a').addClass('hello-world');
// 		$('.col_inside_tag.action a').removeClass('enabled');
// 		$(document.body).on('click','.hello-world',function(e){
// 			alert("slsdldl");
// 			e.preventDefault();
// 			return false;
// 		});

    });
	
});
