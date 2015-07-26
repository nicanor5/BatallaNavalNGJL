$( document ).ready(function(){
	$("#battlefield").on('click', '.battlefield', fire);
});

function fire(event){
	var field = event.target;
	alert(field.name+' = '+field.value);
	$('#'+field.id).replaceWith( '<img src="/Projects/BatallaNavalNGJL/img/water_explotion.png" >' );

	$.ajax({
		url : "/Projects/BatallaNavalNGJL/batallanaval/play",
		type: "POST",
		data : field.name+'='+field.value,
		success: function(data)
		{
			// alert(data);
			$('body').append(data);
			// $('#'+field.id).replaceWith( '<img src="/Projects/BatallaNavalNGJL/img/water_explotion.png" >' );
		}
	});
}