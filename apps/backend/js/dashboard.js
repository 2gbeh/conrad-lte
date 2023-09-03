// JavaScript Document
function $_setMenuTiles ()
{
	var ul = document.querySelectorAll("ul.menu li a");
	for (var value="",i=0; i < ul.length; i++)
	{
		value = ul[i].innerHTML;
		ul[i].setAttribute("title",value);
		ul[i].innerHTML = "<div>"+value+"</div>";
	}
}