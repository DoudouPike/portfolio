$(document).ready(function()
{
	$('#panel_icone').click(function()
	{
		if($('#panel_links').css('display') == 'none')
			$('#panel_links').css('display', 'inline-block');
		else
			$('#panel_links').css('display', 'none');		
	});
	// $('#panel').mouseleave(function(){
	// 	$('#panel_links').delay(1000).animate({
	// 		height: 'toggle',
	// 	})
	// });

    $('#datepicker').datepicker($.datepicker.regional['fr']);
});