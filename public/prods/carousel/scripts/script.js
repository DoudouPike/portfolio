/* VARIABLES */
var current;
var imgTab, descriptionTab, linkTab;
var thisImg, thisDescription, thisLink;
var interval;

/* FONCTIONS */
//Tableau d'image
function imgTab()
{	
	imgTab = [];
	imgTab[0] = "images/html5.jpg"
	imgTab[1] = "images/css3.jpg"
	imgTab[2] = "images/js.png"
	imgTab[3] = "images/jquery.jpg"
	imgTab[4] = "images/php.png"
	imgTab[5] = "images/mysql.jpg"
}
//Tableau des descriptions
function descriptionTab()
{
	descriptionTab = [];
	descriptionTab[0] = "HTML 5"
	descriptionTab[1] = "CSS 3"
	descriptionTab[2] = "JavaScript"
	descriptionTab[3] = "jQuery"
	descriptionTab[4] = "php"
	descriptionTab[5] = "MySQL"
}
//Tableau de liens
function linkTab()
{
	linkTab = [];
	linkTab[0] = "http://doudoupike.fr"
	linkTab[1] = "http://doudoupike.fr"
	linkTab[2] = "http://doudoupike.fr"
	linkTab[3] = "http://doudoupike.fr"
	linkTab[4] = "http://doudoupike.fr"
	linkTab[5] = "http://doudoupike.fr"
}

//Afficher/Cacher la description
function showDescription()
{
	selectTitle.classList.remove("hide");
}
function hideDescription()
{
	selectTitle.classList.add("hide");
}

//Slide
function rightSide()
{
	current++;
	if(current >= imgTab.length)
	{
		current = 0;
	}
	thisImg.setAttribute("src", imgTab[current]);	
	thisDescription.innerHTML = descriptionTab[current];
	thisLink.setAttribute("href", linkTab[current]);
}
function leftSide()
{
	current--;
	if(current < 0)
	{
		current = imgTab.length - 1;
	}
	thisImg.setAttribute("src", imgTab[current]);	
	thisDescription.innerHTML = descriptionTab[current];
	thisLink.setAttribute("href", linkTab[current]);
}
//Stop Auto Scroll
function stopAutoScroll()
{
	clearInterval(interval);
}
//Auto Scroll
function autoScroll()
{
	interval = setInterval(function()
	{
		current++;
		if(current >= imgTab.length)
		{
			current = 0;
		}
		if(current < 0)
		{
			current = imgTab.length;
		}
		thisImg.setAttribute("src", imgTab[current]);	
		thisDescription.innerHTML = descriptionTab[current];
		thisLink.setAttribute("href", linkTab[current]);
	}, 2500);	
	
}
//Carousel
function carousel()
{
	thisImg.setAttribute("src", imgTab[current]);
	thisDescription.innerHTML = descriptionTab[current];
	thisLink.setAttribute("href", linkTab[current]);
	autoScroll();
	document.querySelector(".carousel").appendChild(thisImg);
	document.querySelector(".title").appendChild(thisDescription);
	document.querySelector(".title").appendChild(thisLink);
}

/* VALEUR */
current = 0;
selectCarousel = document.querySelector(".carousel");
selectTitle = document.querySelector(".title");

thisImg = document.createElement("img");
thisImg.classList.add("carouselImg");

thisDescription = document.createElement("p");
thisDescription.classList.add("description");

thisLink = document.createElement("a");
thisLink.classList.add("descriptionLink");
thisLink.setAttribute("target", "blank_");
thisLink.innerHTML = "<i class=\"fa fa-external-link\" aria-hidden=\"true\"></i>";

selectCarousel.onmouseover = stopAutoScroll;
selectCarousel.onmouseleave = autoScroll;

thisImg.onmouseover = showDescription;
selectTitle.onmouseover = showDescription;
thisImg.onmouseleave = hideDescription;
selectTitle.onmouseleave = hideDescription;

/* Retour */

imgTab();//appel de la fonction tableau

descriptionTab();//appel de la liste des descriptions

linkTab();

carousel();//appel de la fonction carousel

document.querySelector("#right").onclick = rightSide;
document.querySelector("#left").onclick = leftSide;