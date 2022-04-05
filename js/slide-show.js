var slideIndex = 0;
showSlides();

function showSlides(currentIndex=null)
{
	var i;
	var slides = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("dot");
	for (i = 0; i < slides.length; i++)
	{
		slides[i].style.display = "none";
	}
	slideIndex++;
	if (slideIndex > slides.length) 
	{
		slideIndex = 1;
	}
	for (i = 0; i < dots.length; i++) 
	{
		dots[i].className = dots[i].className.replace(" slideshow-active", "");
	}
	if(currentIndex !=null)
	{
		slideIndex=currentIndex+1;
		slides[slideIndex-1].style.display = "block";
		dots[slideIndex-1].className += " slideshow-active";
		setTimeout(showSlides, 2000);
	}
	else
	{
		slides[slideIndex - 1].style.display = "block";
		dots[slideIndex - 1].className += " slideshow-active";
		setTimeout(showSlides, 2000);
	}
}

