$(document).ready(function()
{
	//Clique login
	var loginIcone = $('#panel_icone');
	var loginPanel = $('#panel_links');
	loginIcone.click(function()
	{
		loginPanel.fadeToggle();
		loginPanel.css('display', 'inline-block');
	});
	$(document.body).click(function(e)
	{
		if(!$(e.target).is(loginIcone) && !$.contains(loginIcone[0],e.target))
		{
	  		loginPanel.fadeOut();
		}
	});
	
	if($('#skillBox').is(':visible'))
	{
		$('#outline').delay("500").fadeIn();
		$('.html').delay("500").fadeIn();
		$('.css').delay("1000").fadeIn();
		$('.php').delay("1500").fadeIn();
		$('.mysql').delay("2000").fadeIn();
		$('.js').delay("2500").fadeIn();
	}
	
    $('#datepicker').datepicker($.datepicker.regional['fr']);
});