$('document').ready(function(){

	$('#form1').submit(function(){
		return false;
	});

	$('#login').click(function(){

		jQuery('#form1').validate({
			rules: {
				username: 'required',
				password: 'required',
			},
			messages: {
				username: 'This field is required',
				password: 'This field is required',
			}
		});

		var form_data = $('#form1').serialize();

		$.ajax({
			data: form_data,
			type: 'POST',
			url: 'login_ajax.php',
			success: function(result){
				console.log(result);
				if (result == 'true') {
					window.location.href = 'profile_page.php';
				}
				else{
					$('#div1').html("login failed");
				}
			},
			error: function(xhr, status, error){
				console.log("XHR: "+xhr+" Status: "+status+" Error: "+error);
			}
		});
	});
});