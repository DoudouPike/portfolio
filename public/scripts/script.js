$(document).ready(function()
{
//Panel login
	var loginIcone = $('#panel_icone');
	var loginPanel = $('#panel_links');
	loginIcone.click(function()
	{
		loginPanel.fadeToggle();
		loginPanel.css('display', 'inline-block');
		loginPanel.delay('3000').fadeOut('slow');
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
		$('.old').delay("500").fadeIn("slow");
		$('#old1').delay("600").fadeIn("slow");
		$('#old2').delay("700").fadeIn("slow");
		$('#old3').delay("800").fadeIn("slow");
		$('#old4').delay("900").fadeIn("slow");
		$('#old5').delay("1000").fadeIn("slow");
		$('#old6').delay("1100").fadeIn("slow");
		$('#old7').delay("1200").fadeIn("slow");
		$('#old8').delay("1300").fadeIn("slow");
		$('#old9').delay("1400").fadeIn("slow");

		$('.formation').delay("1500").fadeIn("slow");
		$('#form1').delay("1600").fadeIn("slow");
		$('#form2').delay("1700").fadeIn("slow");
		$('#form3').delay("1800").fadeIn("slow");
		$('#form4').delay("1900").fadeIn("slow");
		$('#form5').delay("2000").fadeIn("slow");
		$('#form6').delay("2100").fadeIn("slow");
		$('#form7').delay("2200").fadeIn("slow");
		$('#form8').delay("2300").fadeIn("slow");
		$('#form9').delay("2400").fadeIn("slow");
		$('#form10').delay("2500").fadeIn("slow");

		$('.perso').delay("2600").fadeIn("slow");
		$('#perso1').delay("2700").fadeIn("slow");
		$('#perso2').delay("2800").fadeIn("slow");
		$('#perso3').delay("2900").fadeIn("slow");
		$('#perso4').delay("3000").fadeIn("slow");
		$('#perso5').delay("3100").fadeIn("slow");
		$('#perso6').delay("3200").fadeIn("slow");
		$('#perso7').delay("3300").fadeIn("slow");
		$('#perso8').delay("3400").fadeIn("slow");
		$('#perso9').delay("3500").fadeIn("slow");

		$('.work').delay("3600").fadeIn("slow");

		$('.show').delay("4000").fadeIn("slow");
	}

	$('.old').hover(function()
	{
		$('#info_old').fadeIn("fast");
		$('.schemaElement:not(".old")').fadeTo(1, 0.3);
	}, function()
	{
		$('#info_old').fadeOut("fast");
		$('.schemaElement:not(".old")').fadeTo(0, 1);
	});

	$('.formation').hover(function()
	{
		$('#info_formation').fadeIn("fast");
		$('.schemaElement:not(".formation")').fadeTo(1, 0.3);
	}, function()
	{
		$('#info_formation').fadeOut("fast");
		$('.schemaElement:not(".formation")').fadeTo(0, 1);
	});

	$('.perso').hover(function()
	{
		$('#info_perso').fadeIn("fast");
		$('.schemaElement:not(".perso")').fadeTo(1, 0.3);
	}, function()
	{
		$('#info_perso').fadeOut("fast");
		$('.schemaElement:not(".perso")').fadeTo(0, 1);
	});

	$('.work').hover(function()
	{
		$('#info_work').fadeIn("fast");
		$('.schemaElement:not(".work")').fadeTo(1, 0.3);
	}, function()
	{
		$('#info_work').fadeOut("fast");
		$('.schemaElement:not(".work")').fadeTo(0, 1);
	});


// Date
    $('#datepicker').datepicker($.datepicker.regional['fr']);

// Success login/logout
	if($('.success').is(':visible'))
	{
		if($('#login').is(':visible'))
		{
			loginPanel.fadeIn("fast");
			loginPanel.css('display', 'inline-block');
			loginPanel.delay('3000').fadeOut('fast');
		}
		$('.success').delay("1800").fadeOut("slow");
	}
});