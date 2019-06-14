$(document).ready(function(){
	$.fn.basic_validate = function(){
		$('.error1').remove();

		var flag1 = 0;
		var name = $('#name').val();
		var gender = $("input[name='gender']:checked").val();
		var username = $('#username').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var confirm_password = $('#confirm_password').val();
		
		if (name == ""){
			$('#name').after('<span class="error1">name is required<span>');
			flag1 = 1;
		}
		if (username == ''){
			$('#username').after('<span class="error1">username is required<span>');
			flag1 = 1;
		}
		if (email == ""){
			$('#email').after('<span class="error1">email is required<span>');
			flag1 = 1;
		}
		else {
        var regEx = /^[A-Za-z0-9][A-Za-z0-9._%+-]{0,63}@(?:[A-Za-z0-9-]{1,63}\.){1,125}[A-Za-z]{2,63}$/;
        var validEmail = regEx.test(email);
	        if (!validEmail) {
	        	$('#email').after('<span class="error1">Enter a valid email</span>');
	        	flag1 = 1;
	        }
    	}
		if (password == ""){
			$('#password').after('<span class="error1">password is required<span>');
			flag1 = 1;
		}
		if (confirm_password == ""){
			$('#confirm_password').after('<span class="error1">confirm password is required<span>');
			flag1 = 1;
		}
		else if (password != confirm_password){
			$('#confirm_password').after('<span class="error1">passwords do not match<span>');
			flag1 = 1;
		}
		return flag1;
	}//basic detail validation function ends

	$.fn.contact_validate = function(){
		$('.error2').remove();

		var flag2 = 0;
		var number = $('#mobile_number').val();
		var state = $('#state option:selected').val();
		var city = $('#city option:selected').val();
		var address = $('#address').val();

		if(number == ''){
			$('#mobile_number').after('<span class="error2">number is required</span>');
			flag2 = 1;
		}
		if(state == ''){
			$('#state').after('<span class="error2">state is required</span>');
			flag2 = 1;
		}
		if(city == ''){
			$('#city').after('<span class="error2">city is required</span>');
			flag2 = 1;
		}
		if(address == ''){
			$('#address').after('<span class="error2">address is required</span>');
			flag2 = 1;
		}
		return flag2;
	}// contact detail validation ends

	$(".section").hide();
	$("#basic_sec").show();

	$("#basic_button").click(function(){
		var basicFlag = $.fn.basic_validate();
		if(basicFlag == 0){
			$("#contact_sec").slideDown("slow");
			$("#basic_sec").hide();
		}
  	});
	
	$('#basic').click(function(){
  		$("#basic_sec").show();
  		$('#contact_sec').hide();
  		$('#interest_sec').hide();
  	});

  	$("#contact_button").click(function(){	
  		var contactFlag = $.fn.contact_validate();
  		var basicFlag = $.fn.basic_validate();
		if (contactFlag == 0 && basicFlag == 0) {			
			$("#interest_sec").slideDown("slow");
			$("#contact_sec").hide();
		}
		else if (contactFlag == 0 && basicFlag == 1){
			alert('error in sec 1');
			$("#basic_sec").show();
		}
		else if (contactFlag == 1 && basicFlag == 1){
			alert('error in both');
			$("#basic_sec").show();
		}
  	});

  	$('#contact').click(function(){
  		$("#contact_sec").show();
  		$('#basic_sec').hide();
  		$('#interest_sec').hide();
  	});

  	$("#submit").click(function(){
		
  	});
});
