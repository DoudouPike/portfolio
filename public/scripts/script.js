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


	// var canvas = $("#chart").get(0);
	// if(canvas.getContext)
	// {
	//  	var ctx = canvas.getContext('2d');
	// 	var lastend = 0;
	// 	var data = [50, 50, 50, 50, 20];
	// 	var myTotal = 0;
	// 	var myColor = ['rgb(20,20,20)', 'rgb(70,70,70)', 'rgb(120,120,120)', 'rgb(170,170,170)', 'rgb(230,230,230)'];

	// 	for (var e = 0; e < data.length; e++) {
	// 	  myTotal += data[e];
	// 	}

	// 	for (var i = 0; i < data.length; i++) {
	// 	  ctx.fillStyle = myColor[i];
	// 	  ctx.beginPath();
	// 	  ctx.moveTo(canvas.width / 2, canvas.height / 2);
	// 	  // Arc Parameters: x, y, radius, startingAngle (radians), endingAngle (radians), antiClockwise (boolean)
	// 	  ctx.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, lastend, lastend + (Math.PI * 2 * (data[i] / myTotal)), false);
	// 	  ctx.lineTo(canvas.width / 2, canvas.height / 2);
	// 	  ctx.fill();
	// 	  lastend += Math.PI * 2 * (data[i] / myTotal);
	// 	}
	// }
	
	// var canvas = $("#chart").get(0);
	// if(canvas.getContext)
	// {
	// 	var ctx = canvas.getContext('2d');
	// 	//Dessin
	// 	var myChart = new Chart(canvas, {
	// 	    type: 'pie',
	// 	    data: {
	// 	        labels: [
	// 	        	"HTML",
	// 	        	"CSS",
	// 	        	"PHP",
	// 	        	"MySQL",
	// 	        	"JS/jQuery"
	// 	        ],
	// 	        datasets: [{
	// 	            data: [5, 5, 5, 5, 5],
	// 	            backgroundColor: [
	// 	                'rgb(20 ,20, 20)',
	// 	                'rgb(70 ,70 ,70)',
	// 	                'rgb(120, 120, 120)',
	// 	                'rgb(170, 170, 170)',
	// 	                'rgb(230, 230, 230)'
	// 	            ]
	// 	        }]
	// 	    },
	// 	});
		
		
	// }
	// else
	// {
		
	// }

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