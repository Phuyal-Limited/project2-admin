$(document).ready(function(){

	done(1);
});

function done(x){
	if(x){
		pickup();
	}
	setInterval(function(){
		pickup();
	},60000);
}

function pickup(){
	$("#pickup_show").html('');
	$.ajax({
		url: 'pickup',
		dataType: 'json',
		success: function(response){
			alert(response);
			var size = response.length;
			for(var i=0;i<size;i++){
				$("#pickup_show").append('<div class="guest-row"> <!-- starts:guest-row -->'+
												'<div class="row">'+ 
													'<div class="col-xs-12 col-sm-12 col-md-12 data-block-guest-name">'+response[i].name+'</div>'+
													'<div class="col-xs-12 col-sm-12 col-md-12">From:<em>'+response[i].pickup_place+'</em></div>'+
													'<div class="col-xs-12 col-sm-12 col-md-12 pickup-time"><span>'+response[i].pickup_time+'</span><!--<em> 30 mins left</em>--></div>'+
												'</div>'+
											'</div> <!-- ends:guest-row -->');
			}
		}
	});
}