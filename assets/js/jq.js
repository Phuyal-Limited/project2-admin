$(document).ready(function(){

	//ajax login
	$("#submit-button").click(function () {
 		var user = $("#user").val();
		var pass = $("#pass").val();
		
		if(user==''){
			$("#msg").text('User Required!');
			return false;
		}
		if(pass==''){
			$("#msg").text('Password Required!');
			return false;
		}
		
		$.ajax({
			
			url:'login_entry',
			type:'POST',
			data: {
				name: user,
				pass: pass 
			},
			beforeSend: function(){
				$("#load").html('<img src="http://admin.nepalinn.com/assets/images/loading.gif" height="20px" width="20px">');
			},
			success: function(response){
				$("#load").hide('');
				$("#msg").html('');
				if(response==='successful'){
					window.location.replace("home");
				}else{
					$("#msg").text(response);
				}
			},
		});
		return false;
  	});


});


//for image preview
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$("#img_prev").show();
			$('#img_prev').attr('src', e.target.result).width(150).height(150);

		};

		reader.readAsDataURL(input.files[0]);
	}
}

function validate(){
	var newpass = $("#new").val();
	var repass = $("#renew").val();
	if(newpass.length<5){
		$("#validate-msg").html('Password must be of minimum length 5 (New Password)');
		return false;
	}

	if(repass.length<5){
		$("#validate-msg").html('Password must be of minimum length 5 (Confirm Password)');
		return false;
	}

	if(newpass!=repass){
		$("#validate-msg").html('Password Not Match');
		return false;
	}
}