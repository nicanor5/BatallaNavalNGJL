$( document ).ready(function(){
	iniPusher();
	$("#battlefield").on('click', '.battlefield', fire);
});

function fire(event){
	var field = event.target;

	$.ajax({
		url : "/Projects/BatallaNavalNGJL/batallanaval/play",
		type: "POST",
		data : field.name+'='+field.value,
		// data : 	{
		// 			field.name+'='+field.value,
		// 			playerID=1
		// 		}
		success: function(data)
		{
			$('body').append(data);
			if (data == 1){
				$('#'+field.id).replaceWith( '<img src="/Projects/BatallaNavalNGJL/img/ship_explotion.png" >' );
			}
			else {
				$('#'+field.id).replaceWith( '<img src="/Projects/BatallaNavalNGJL/img/water_explotion.png" >' );
			}
			
		}
	});
}

function iniPusher()
{
	var pusher = new Pusher('786abf7829cb6f47949d');
	var channel = pusher.subscribe('batallanaval1');
	channel.bind('fired', function(data) {
		// alert(data.celda);	
		$(data.celda).css({'background-color': data.estado});
	});

	// channel.bind('actualizar', function(data) {
	// 	// alert(data.celda);	
	// 	$(data.celda).css({'background-color': data.estado});
	// });

	// channel.bind('actualizar', function(data) {
	// 	// alert(data.celda);	
	// 	$(data.celda).css({'background-color': data.estado});
	// });
}