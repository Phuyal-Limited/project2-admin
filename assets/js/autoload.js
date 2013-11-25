$(document).ready(function(){

	done(1);
});


//function to maintain autoload
function done(x){
	if(x){
		pickup();
		scheduled();
		recent();
	}
	setInterval(function(){
		pickup();
		scheduled();
		recent();
	},60000);
}


//ajax to get pickup details
function pickup(){
	$("#pickup_show").html('');
	$.ajax({
		url: 'pickup',
		dataType: 'json',
		success: function(response){
			
			var size = response.length;
			if(size==0){
				$("#pickup_show").html('<br />No Pickup\'s Today');
			}else{
				for(var i=0;i<size;i++){
					$("#pickup_show").append('<div class="guest-row"> <!-- starts:guest-row -->'+
													'<div class="row">'+ 
														'<div class="col-xs-12 col-sm-12 col-md-12 data-block-guest-name">'+response[i].name+'</div>'+
														'<div class="col-xs-12 col-sm-12 col-md-12">Pickup Place: <em>'+response[i].pickup_place+'</em></div>'+
														'<div class="col-xs-12 col-sm-12 col-md-12 pickup-time"><span>'+response[i].pickup_time+'</span><!--<em> 30 mins left</em>--></div>'+
													'</div>'+
												'</div> <!-- ends:guest-row -->');
				}
			}
		}
	});
}


//ajax to get scheduled arrivals of guest
function scheduled(){
	$("#scheduled_show").html('');
	$.ajax({
		url: 'scheduled_arrival',
		dataType: 'json',
		success: function(response){
			
			var size = response.length;
			if(size==0){
				$("#scheduled_show").html('<br />No Scheduled Arrival');
			}else{
				var scheduled = '';
				for(var i=0;i<size;i++){
					scheduled += '<div class="guest-row"> <!-- starts:guest-row -->'+
												'<div class="row">'+
												'<div class="col-xs-12 col-sm-12 col-md-12 data-block-guest-name">'+response[i].name+'</div>'+
												'<div class="col-xs-12 col-sm-12 col-md-12 pickup-time">'+
													'<em>Rooms: </em>';
												for(var j=0;j<response[i].room_numbers.length;j++){
													scheduled += '<span>'+response[i].room_numbers[j]+'</span>';
												}

												scheduled += '</div>'+
												'<div class="col-xs-6 col-sm-6 col-md-6">'+
													'From:<br /> <em>'+response[i].checkin_date+'</em>'+
												'</div>'+
												'<div class="col-xs-6 col-sm-6 col-md-6">'+
													'To:<br /> <em>'+response[i].checkout_date+'</em>'+
												'</div>'+
											'</div>'+ 
											'</div> <!-- ends:guest-row -->';
				}
				$("#scheduled_show").html(scheduled);
			}
		}
	});
}


//ajax to get the recent booking of rooms
function recent(){
	$("#recent_show").html('');
	$.ajax({
		url: 'recent_booking',
		dataType: 'json',
		success: function(response){
			
			var size = response.length;
			if(size==0){
				$("#recent_show").html('<br />No Bookings');
			}else{
				var recent = '';
				for(var i=0;i<size;i++){
					recent += '<div class="guest-row"> <!-- starts:guest-row -->'+
												'<div class="row">'+
												'<div class="col-xs-12 col-sm-12 col-md-12 data-block-guest-name">'+response[i].name+'</div>'+
												'<div class="col-xs-12 col-sm-12 col-md-12 pickup-time">'+
													'<em>Rooms: </em>';
												for(var j=0;j<response[i].room_numbers.length;j++){
													recent += '<span>'+response[i].room_numbers[j]+'</span>';
												}

												recent += '</div>'+
												'<div class="col-xs-6 col-sm-6 col-md-6">'+
													'From:<br /> <em>'+response[i].checkin_date+'</em>'+
												'</div>'+
												'<div class="col-xs-6 col-sm-6 col-md-6">'+
													'To:<br /> <em>'+response[i].checkout_date+'</em>'+
												'</div>'+
											'</div>'+ 
											'</div> <!-- ends:guest-row -->';
				}
				$("#recent_show").html(recent);
			}
		}
	});
}