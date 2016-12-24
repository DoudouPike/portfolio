$(document).ready(function()
{
	//Panel login
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
	if($(window).width() >= 950)
	{
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
			
			$('#html').mouseover(function()
			{
				$('.chartElement:not(".html")').fadeTo(0, 0.3);
			})
			$('#html').mouseleave(function()
			{
				$('.chartElement:not(".html")').fadeTo(0, 1);
			});

			$('#css').mouseover(function()
			{
				$('.chartElement:not(".css")').fadeTo(0, 0.3);
			})
			$('#css').mouseleave(function()
			{
				$('.chartElement:not(".css")').fadeTo(0, 1);
			});

			$('#php').mouseover(function()
			{
				$('.chartElement:not(".php")').fadeTo(0, 0.3);
			})
			$('#php').mouseleave(function()
			{
				$('.chartElement:not(".php")').fadeTo(0, 1);
			});

			$('#mysql').mouseover(function()
			{
				$('.chartElement:not(".mysql")').fadeTo(0, 0.3);
			})
			$('#mysql').mouseleave(function()
			{
				$('.chartElement:not(".mysql")').fadeTo(0, 1);
			});

			$('#js').mouseover(function()
			{
				$('.chartElement:not(".js")').fadeTo(0, 0.3);
			})
			$('#js').mouseleave(function()
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
				$('#info_old').fadeIn(0);
				$('.schemaElement:not(".old")').fadeTo(0, 0.3);
				$('#show_career').fadeOut(0);
			}, function()
			{
				$('#info_old').fadeOut(0);
				$('.schemaElement:not(".old")').fadeTo(0, 1);
				$('#show_career').fadeIn(0);
			});

			$('.formation').hover(function()
			{
				$('#info_formation').fadeIn(0);
				$('.schemaElement:not(".formation")').fadeTo(0, 0.3);
				$('#show_career').fadeOut(0);
			}, function()
			{
				$('#info_formation').fadeOut(0);
				$('.schemaElement:not(".formati")').fadeTo(0, 1);
				$('#show_career').fadeIn(0);
			});
			$('.perso').hover(function()
			{
				$('#info_perso').fadeIn(0);
				$('.schemaElement:not(".perso")').fadeTo(0, 0.3);
				$('#show_career').fadeOut(0);
			}, function()
			{
				$('#info_perso').fadeOut(0);
				$('.schemaElement:not(".perso")').fadeTo(0, 1);
				$('#show_career').fadeIn(0);
			});

			$('.work').hover(function()
			{
				$('#info_work').fadeIn(0);
				$('.schemaElement:not(".work")').fadeTo(0, 0.3);
				$('#show_career').fadeOut(0);
			}, function()
			{
				$('#info_work').fadeOut(0);
				$('.schemaElement:not(".work")').fadeTo(0, 1);
				$('#show_career').fadeIn(0);
			});

		//Focus
			if($('#login').is(':visible'))
			{
				$('#login').focus();
			}
			if($('#pseudo').is(':visible'))
			{
				$('#pseudo').focus();
			}
	}

// Success login/logout
	if($('.success').is(':visible'))
	{
		if($('#buttonLogin').is(':visible'))
		{
			loginPanel.fadeIn("fast");
			loginPanel.css('display', 'inline-block');
			loginPanel.delay('3500').fadeOut("slow");
		}
		$('.success').delay("3000").fadeOut("slow");
	}

//Prod & Project
	$('.fade').fadeIn(1000);

// Counter
	$('#comment_submit').attr("disabled", "disabled");
	$('#comment_text').keyup(function()
	{
 
	    var nbrPrint = $(this).val().length;
	 
	    // On soustrait le nombre limite au nombre de caractère existant
	    var nbrPrint = 250 - nbrPrint;

	    $('#comment_count').text(nbrPrint);
	 
	    // On écris le nombre de caractère en rouge si celui si est inférieur à 0 
	    // La limite est donc dépasse
	    if(nbrPrint < 0)
	    {
	    	$('#comment_count').addClass("wrongCount");
	    	$('#comment_submit').attr("disabled", "disabled");
	    	$('#comment_submit').css("cursor", "default");
	    	$('#comment_submit').mouseover(function()
			{
				$('#comment_submit').removeClass("buttonOk");
			});
		}
		else if(nbrPrint == 250 || nbrPrint > 248)
		{
			$('#comment_count').removeClass("wrongCount");
			$('#comment_submit').attr("disabled", "disabled");
			$('#comment_submit').css("cursor", "default");
			$('#comment_submit').mouseover(function()
			{
				$('#comment_submit').removeClass("buttonOk");
			});
		}
		else
		{
			$('#comment_count').removeClass("wrongCount");
			$('#comment_submit').removeAttr("disabled");
			$('#comment_submit').css("cursor", "pointer");
			$('#comment_submit').mouseover(function()
			{
				$('#comment_submit').addClass("buttonOk");
			});
			$('#comment_submit').mouseleave(function()
			{
				$('#comment_submit').removeClass("buttonOk");
			});
		}
	 });
//Error
	if($('.error').is(':visible'))
	{
		$('.error').delay(3500).fadeOut("slow");
	}
	$("#close").css("cursor", "pointer");
	$("#close").click(function()
	{
		$('.error').hide();
	});

// Date
    $('#datepicker').datepicker($.datepicker.regional['fr']);

//Scroll
	if($(window).width() < 1000)
	{
		if(($(location).attr('href').indexOf('&id=') != -1)
			|| ($(location).attr('href').indexOf('dashboard&') != -1)
			|| ($(location).attr('href').indexOf('&s') != -1))
		{
		    $('html, body').animate(
		    {
		    	scrollTop: $('.scrollTarget').offset().top
		    }, 750);
		}
	}
});