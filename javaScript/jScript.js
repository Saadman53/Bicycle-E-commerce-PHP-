window.onload = function()
{
	document.getElementById("prikazi").addEventListener("mouseover",oboj);
	document.getElementById("prikazi").addEventListener("mouseout",vratiBoju);
	document.getElementById("prikazi").addEventListener("click",nestani);
	
	
}

function oboj()
{
	document.getElementById("prikazi").style.color="#808080";
	document.getElementById("prikazi").style.borderColor="#808080";
}
function vratiBoju()
{
	document.getElementById("prikazi").style.color="#000000";
	document.getElementById("prikazi").style.borderColor="#000000";
}
function nestani()
{
	document.getElementById("prikazi").style.display="none";
}
//Za taster KORPU
function ispisiAlert()
{
	alert("Izvinjavamo se sajt je jos u izradi nije moguce dodati u korpu. Hvala");
}














