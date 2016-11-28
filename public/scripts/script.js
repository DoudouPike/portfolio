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

	// Chart
	if($('#skillBox').is(':visible'))
	{
		$('#outline').delay("500").fadeIn();
		$('.html').delay("500").fadeIn();
		$('.css').delay("1000").fadeIn();
		$('.php').delay("1500").fadeIn();
		$('.mysql').delay("2000").fadeIn();
		$('.js').delay("2500").fadeIn();
		$('.other').delay("3300").fadeIn();
	}
	
	$('.html').mouseover(function()
	{
		$('.chartElement:not(".html")').fadeTo(0, 0.3);
	})
	$('.html').mouseleave(function()
	{
		$('.chartElement:not(".html")').fadeTo(0, 1);
	});

	$('.css').mouseover(function()
	{
		$('.chartElement:not(".css")').fadeTo(0, 0.3);
	})
	$('.css').mouseleave(function()
	{
		$('.chartElement:not(".css")').fadeTo(0, 1);
	});

	$('.php').mouseover(function()
	{
		$('.chartElement:not(".php")').fadeTo(0, 0.3);
	})
	$('.php').mouseleave(function()
	{
		$('.chartElement:not(".php")').fadeTo(0, 1);
	});

	$('.mysql').mouseover(function()
	{
		$('.chartElement:not(".mysql")').fadeTo(0, 0.3);
	})
	$('.mysql').mouseleave(function()
	{
		$('.chartElement:not(".mysql")').fadeTo(0, 1);
	});

	$('.js').mouseover(function()
	{
		$('.chartElement:not(".js")').fadeTo(0, 0.3);
	})
	$('.js').mouseleave(function()
	{
		$('.chartElement:not(".js")').fadeTo(0, 1);
	});

	//Parcours

	if($('#schema').is(':visible'))
	{
		$('.old').delay("500").fadeIn();
		$('#old1').delay("555.5").fadeIn();
		$('#old2').delay("611").fadeIn();
		$('#old3').delay("666.5").fadeIn();
		$('#old4').delay("722").fadeIn();
		$('#old5').delay("777.5").fadeIn();
		$('#old6').delay("833").fadeIn();
		$('#old7').delay("888.5").fadeIn();
		$('#old8').delay("944").fadeIn();
		$('#old9').delay("999.5").fadeIn();

		$('.formation').delay("1000").fadeIn();
		$('#form1').delay("1055.5").fadeIn();
		$('#form2').delay("1111").fadeIn();
		$('#form3').delay("1166.5").fadeIn();
		$('#form4').delay("1222").fadeIn();
		$('#form5').delay("1277.5").fadeIn();
		$('#form6').delay("1333").fadeIn();
		$('#form7').delay("1388.5").fadeIn();
		$('#form8').delay("1444").fadeIn();
		$('#form9').delay("1499.5").fadeIn();
		$('#form10').delay("1499.8").fadeIn();

		$('.perso').delay("1500").fadeIn();
		$('#perso1').delay("1555.5").fadeIn();
		$('#perso2').delay("1611").fadeIn();
		$('#perso3').delay("1666.5").fadeIn();
		$('#perso4').delay("1722").fadeIn();
		$('#perso5').delay("1777.5").fadeIn();
		$('#perso6').delay("1833").fadeIn();
		$('#perso7').delay("1888.5").fadeIn();
		$('#perso8').delay("1944").fadeIn();
		$('#perso9').delay("1999.5").fadeIn();

		$('.new').delay("2055").fadeIn();
	}


	// Date
    $('#datepicker').datepicker($.datepicker.regional['fr']);
});