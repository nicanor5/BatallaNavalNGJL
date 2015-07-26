//RTC 2015-1
$( document ).ready(inicializar);

function inicializar()
{
	alert("With great power comes great responsibility");
	$( "#tabla" ).on('click','.Enable',enable);
	$( "#tabla" ).on('click','.Disable',disable);

}

function enable(event)
{
	
	// Obtener id del boton presionado
	var id=event.target.id;
	
	// Solo necesito el numero de id
	var num=id.substring(1);

	$.ajax(
		{
			url:'/BatallaNavalNGJL/admin/habilitar',
			method:'post',
			data:"id="+num,
			dataType:'json'
		}
	)
	.done(function(data)
			{
				event.target.innerHTML = "Disable";
				event.target.className = "Disable";
			}
	);
	
}

function disable(event)
{
	
	// Obtener id del boton presionado
	var id=event.target.id;
	
	// Solo necesito el numero de id
	var num=id.substring(1);

	$.ajax(
		{
			url:'/BatallaNavalNGJL/admin/desactivar',
			method:'post',
			data:"id="+num,
			dataType:'json'
		}
	)
	.done(function(data)
			{
				event.target.innerHTML = "Enable";
				event.target.className = "Enable";
			}
	);
	
}
