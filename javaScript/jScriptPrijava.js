
function proveraForme(){
	var emailAdresa, regEmailAdresa, sifra, regSifra;
	
	//DOHVATANJE VREDNOSTI
	
	emailAdresa = document.getElementById("emailAdresa").value;
	sifra = document.getElementById("sifra").value;
	
	
	//REGULARNI IZRAZI
	
	regEmailAdresa =/^[\w]+[\.\_\-\w\d]*\@gmail\.com$/;
	regSifra =/^[A-Z][\w\d]{5,}$/;
	
	var Greske = new Array();
	var Podaci = new Array();
	
	
	if(!regEmailAdresa.test(emailAdresa))
	{
		Greske.push("Greska - Email Adresa!");
		
	}
	else
	{
		Podaci.push("Email Adresa: " + emailAdresa);
		
	}
	if(!regSifra.test(sifra))
	{
		Greske.push("Greska - Sifra!");
		
	}
	else
	{
		Podaci.push("Sifra: " + sifra);
		
	}
	
	
	//ISPIS
	var rezultat ="";
	rezultat += "<ul>";
	if(Greske.length != 0)
	{	rezultat +="<h1>OBAVESTENJE</h1>";
		for(var i = 0; i < Greske.length; i++)
		{	
			rezultat += "<li style='color:#ff0000;'>" + Greske[i] + "</li>";
			
		}
		
	}
	else
	{
		return true;
	}
	
	rezultat += "</ul>";
	
	document.getElementById("div-levo").style.display = "block";
	document.getElementById("div-levo").innerHTML = rezultat;
	return false;

	
}


































