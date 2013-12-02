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


	
	//to disable date pick before today
  	$('#datepicker-from').datepicker({ minDate: 0 });
  	//check out date must be atleast a day after the checkin date
  	$('#datepicker-to').datepicker({ minDate: 1 });
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


//ajax add room
function add_room(i){
	var pre = $("#previous").val();
	
	//hiding the previous template error message
	if(pre==''){
		//do nothing
	}else if(pre==i){
		//do nothing
	}else{
		$("#error-msg"+pre).html('');
	}
	var template_id = $("#template"+i).val();
	var room_no = $("#room_no"+i).val();
	var floor_no = $("#floor_no").val();
	
	$.ajax({
		url: 'add_room',
		type: 'post',
		dataType: 'json',
		data: {
			template_id: template_id,
			room_no: room_no,
			floor_no: floor_no
		},
		success: function(response){
			
			if(response.msg=='Room already added.'){
				$("#error-msg"+i).html(response.msg);
			}else{
				$("#display_room"+i).html('');

				var size = response.length;
				for(var x=0;x<size;x++){
					$("#display_room"+i).append('<div class="col-md-3 col-xs-3 col-sm-2 room-box">'+ 
												'<div class="room-no available">'+response[x].room_no+'</div>'+
											'</div>');
				}
				$("#room_no"+i).val('');
				$("#previous").val(i);
			}
			
		}
	});
	return false;
}


//ajax availabe rooms search
function search_room(){
	var template_id = $("#template").val();
	var from = $("#datepicker-from").val();
	var to = $("#datepicker-to").val();
	
	if(from==''){
		$("#date-error-message").html('From Date Field Empty.');
		return false;
	}
	if(to==''){
		$("#date-error-message").html('To Date Field Empty.');
		return false;
	}
	$.ajax({
		url: 'available_room',
		type: 'post',
		dataType: 'json',
		data: {
			template_id: template_id,
			from: from,
			to: to
		},
		success: function(response){
			$("#date-error-message").html('');
			var size = response.length;
			$("#available-rooms-show").html('');
			if(size==0){
				$("#available-rooms-show").html('No Rooms available.');
			}else{
				for(var i=0; i<size;i++){
					$("#available-rooms-show").append('<div class="col-md-2 col-xs-3 col-sm-2 room-box"  rel="tooltip" title="normal">'+
															'<div class="room-no available ">'+response[i].room_no+'</div>'+
													   '</div>');
				}
			}

			$("#check_show").click();
		}
	});
	return false();
}