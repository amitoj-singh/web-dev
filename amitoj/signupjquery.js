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
		var img_file = $('#my_file_field').val();
		
		if (name == ""){
			$('#name').after('<span class="error1">name is required<span>');
			flag1 = 1;
		}
		if (gender == ""){
			$('#err_gender').after('<span class="error1">gender is required<span>');
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
		if (password.length < 8){
			$('#password').after('<span class="error1">password is required, minimum 8 chars<span>');
			flag1 = 1;
		}
		if (confirm_password.length < 8){
			$('#confirm_password').after('<span class="error1">confirm password is required, minimum 8 chars<span>');
			flag1 = 1;
		}
		else if (password != confirm_password){
			$('#confirm_password').after('<span class="error1">passwords do not match<span>');
			flag1 = 1;
		}
		if (!img_file){
			$('#my_file_field').after('<span class="error1">Upload image file<span>');
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

	$.fn.submit_validate = function(){
		$('.error3').remove();

		var flag3 = 0;
		var course = $('#course option:selected').val();
		
		var hobby = $('input[name="hobby[]"]:checked').map(function(){
			return $(this).val();
		}) // map function is used to get the checked values in an array it returns array of objects
		.get() // It gets the basic array from object array
		.join(", "); // joins the array elements in a string, separated by a comma and a space 

		if(course == ''){
			$('#course').after('<span class="error3">course is required</span>');
			flag3 = 1;
		}
		if(hobby == ''){
			$('#hobby_error').after('<span class="error3">hobby is required</span>');
			flag3 = 1;
		}			
		return flag3;
	}

	$(".section").hide();
	$("#basic_sec").show();
	$('#err_div').hide();

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
  		var basicFlag = $.fn.basic_validate();
  		var contactFlag = $.fn.contact_validate();
  		
		if (contactFlag == 0 && basicFlag == 0) {			
			$("#interest_sec").slideDown("slow");
			$("#contact_sec").hide();
		}
		else if (contactFlag == 0 && basicFlag == 1){
			$("#basic_sec").show();
		}
		else if (contactFlag == 1 && basicFlag == 1){
			$("#basic_sec").show();
		}
  	});

  	$('#contact').click(function(){
  		$("#contact_sec").show();
  		$('#basic_sec').hide();
  		$('#interest_sec').hide();
  	});

  	$("#form1").submit(function(e){
  		e.preventDefault();

  		var basicFlag = $.fn.basic_validate();
		var contactFlag = $.fn.contact_validate();
  		var interestFlag = $.fn.submit_validate();

  		if(basicFlag == 1){
  			$('#basic_sec').show();
  			if(contactFlag == 1){
  				$("#contact_sec").show();
  			}
  		}
  		if (contactFlag == 1){
  			$('#contact_sec').s
  		}

  		if (basicFlag == 0 && contactFlag == 0 && interestFlag == 0){
  			alert("all good");

			var formData = new FormData(this);

  			$.ajax({
  				data: formData,
  				type: 'POST',
  				cache:false,
                contentType: false,
                processData: false,
  				url: 'signup_ajax.php',
  				success: function(result){
  					$('#err_div').empty();
  					console.log(result);
  					
  					var ret_data = JSON.parse(result);

  					if (ret_data.status == "error") {
  						$('#err_div').slideDown(function(){
  							$.each(ret_data.message, function(key, value){
		  						$('#err_div').append(value+"<br>");
		  					});
  						});
	  				}
	  				else if(ret_data.status == "success"){
	  					window.location.replace("success.php");
	  				}
  				},
  				error: function(xhr, status, error){
					console.log("XHR: "+xhr+" Status: "+status+" Error: "+error);
				}
  			});
  		}
  	});

  	$('#interest').click(function(){
  		$("#contact_sec").hide();
  		$('#basic_sec').hide();
  		$('#interest_sec').show();
  	});
});