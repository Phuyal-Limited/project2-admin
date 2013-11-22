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