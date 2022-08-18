$(document).ready(function(){
$("#prikazi").click(function(){
    $(".nestani").slideDown();});
	slideShow();
//PRECICE PRODAVNICA
$(".precice ul li").hover(
	function(){$(this).css("borderColor","#000000");},
	function(){$(this).css("borderColor","#808080");}
);
$(".precice ul li a").hover(
	function(){$(this).css("color","#000000");},
	function(){$(this).css("color","#808080");}
);
//Ajax za brisanje
$('.brisanje').click(function(){
    var id = $(this).data('id');
    
    $.ajax({
      type: "POST",
      url:"php/delate.php",
      data:{
        tag:"tag",
        id:id
      },
      dataType: "json",
      success: function (data) {
        alert("Uspesno ste obrisali korisnika");
      },
      error:function(xhr,statusTxt,error)
      {
        var status=xhr.status;

        switch(status)
        {
          case 500:
		  	alert("Greska na serveru.Trenutno nije moguce obrisati korisnika");
            break;
            case 404:
            alert("Stranica nije pronadjena");
            break;
        }
      }
    });



});
//Ajax za brisanje PROZIVODA
$('.brisanjeP').click(function(){
    var id = $(this).data('id');
    
    $.ajax({
      type: "POST",
      url:"php/delateP.php",
      data:{
        tag:"tag",
        id:id
      },
      dataType: "json",
      success: function (data) {
        alert("Uspesno ste obrisali proizvod");
      },
      error:function(xhr,statusTxt,error)
      {
        var status=xhr.status;

        switch(status)
        {
          case 500:
		  	alert("Greska na serveru.Trenutno nije moguce obrisati korisnika");
            break;
            case 404:
            alert("Stranica nije pronadjena");
            break;
        }
      }
    });



});

$('.update').click(function(){
  var id = $(this).data('id');
  //AJAX ZA UPDATE KORISNIK
  $.ajax({
    type: "POST",
    url:"php/ajaxUser.php",
    data:{
      tag:"tag",
      id:id
    },
    dataType: "json",
    success: function (data) {
      //console.log(data);
      $("#imePrezime").val(data.imePrezime);
      $("#adresa").val(data.adresa);
      $("#grad").val(data.grad);
      $("#postanskiBr").val(data.postanskiBroj);
      $("#emailAdresa").val(data.email);
      $("#ddlUloge").val(data.ulogaID);
	  $("#ddlPol").val(data.polID);
	  $("#sifra").val(data.sifra);
      $("#skiveno").val(data.idKorisnik);
      $('input[name="aktivan"]').prop('checked',false);
      if(data.aktivan==1){
        $(`input[name='aktivan']`).prop('checked',true);
        $(`input[name='aktivan']`).val(data.aktivan);
      } 
    },
    error:function(xhr,statusTxt,error)
    {
      var status=xhr.status;

      switch(status)
      {
        case 500:
          alert("Trenutno nije moguce obrisati korisnika.Greska na serveru");
          break;
          case 404:
          alert("Stranica nije pronadjena");
		  break;
		  
      }
    }
  });



});


//AJAX UPDATE PROIZVOD
$('.updateP').click(function(){
	var id = $(this).data('id');
	
	$.ajax({
	  type: "POST",
	  url:"php/ajaxProizvodi.php",
	  data:{
		tag:"tag",
		id:id
	  },
	  dataType: "json",
	  success: function (data) {
		console.log(data.src);
		$("#naslovP").val(data.naslov);
		$("#skivenoP").val(data.idProizvod);
		$("#cenaProizvoda").val(data.cena);
		$("#altP").val(data.alt);
		$("#ddlKategorija").val(data.idKategorija);
	  },
	  error:function(xhr,statusTxt,error)
	  {
		var status=xhr.status;
  
		switch(status)
		{
		  case 500:
			alert("Trenutno nije moguce obrisati korisnika.Greska na serveru");
			break;
			case 404:
			alert("Stranica nije pronadjena");
			break;
			
		}
	  }
	});
  
  
  
  });



//Provera na admin strani JS
$('#izmena').click(function()
{
	var imePrezime, regImePrezime, adresa, regAdresa, postanskiBroj, regPostanskiBroj, emailAdresa, regEmailAdresa, sifra, regSifra,grad, regGrad,pol,polIzbor,uloga,ulogaIzbor;
	
	//DOHVATANJE VREDNOSTI
	imePrezime = document.getElementById("imePrezime").value;
	adresa = document.getElementById("adresa").value;
	grad = document.getElementById("grad").value;
	postanskiBroj = document.getElementById("postanskiBr").value;
	emailAdresa = document.getElementById("emailAdresa").value;
	sifra = document.getElementById("sifra").value;
  
  pol = document.getElementById("ddlPol");
  polIzbor = pol.options[pol.selectedIndex].value;

  uloga = document.getElementById("ddlUloge");
	ulogaIzbor = uloga.options[uloga.selectedIndex].value;

  var aktivan = document.getElementsByName("aktivan");
	var aktivanIzbor = "";
	for(var i = 0; i < aktivan.length; i++)
	{
		if(aktivan[i].checked)
		{
			aktivanIzbor += aktivan[i].value + " ";
		}
	}
	var skriveno = document.getElementById("skiveno").value;

	//REGULARNI IZRAZI
	regImePrezime = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})+$/;
	regAdresa = /^([A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*(\s[\d]{1,3})$/;
	regGrad=/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10})?(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10})?$/;
	regPostanskiBroj =/^[1 2 3][0-9]{4}$/;
	regEmailAdresa =/^[\w]+[\.\_\-\w\d]*\@gmail\.com$/;
	regSifra=/^[A-Z][\w\d]{5,}$/;
	
	var Greske = new Array();
	var Podaci = new Array();
	
	if(!regImePrezime.test(imePrezime))
	{
		Greske.push("Greska - ime i prezime!");
	}
	else
	{
		Podaci.push("Ime i prezime: " + imePrezime);
	}
	if(!regAdresa.test(adresa))
	{
		Greske.push("Greska - adresa!");
	}
	else
	{
		Podaci.push("Adresa: " + adresa);
	}
	if(!regGrad.test(grad))
	{
		Greske.push("Greska - Grad!");
	}
	else
	{
		Podaci.push("Grad: " + grad);
	}
	if(!regPostanskiBroj.test(postanskiBroj))
	{
		Greske.push("Greska - Postanski Broj!");
	}
	else
	{
		Podaci.push("Postanski Broj: " + postanskiBroj);
	}
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
  if(polIzbor == "0")
  {
		Greske.push("Greska - Niste izabrali pol!");
	}

  if(ulogaIzbor == "0")
  {
		Greske.push("Greska - Niste izabrali ulogu!");
	}

	
	
	
	
	
	//ISPIS
	var rezultat="";
	rezultat += "<ul>";
	if(Greske.length != 0)
	{	rezultat+="<h1>OBAVESTENJE</h1>";
		for(var i = 0; i < Greske.length; i++)
		{	
			rezultat += "<li style='color:#ff0000;'>" + Greske[i] + "</li>";
		}
	}
	else
	{
		$.ajax({
			url:'php/proveraIzmeneUzera.php',
			type:'POST',
			dataType:'json',
			data:{
				provera:"pera",
				imePrezime:imePrezime,
				adresa:adresa,
				grad:grad,
				postanskiBroj:postanskiBroj,
				emailAdresa:emailAdresa,
        		sifra:sifra,
        		polIzbor:polIzbor,
        		ulogaIzbor:ulogaIzbor,
        		aktivanIzbor:aktivanIzbor,
        		skriveno:skriveno
			},
			success:function(data){
      //console.log(data);
      $("#imePrezime").val("");
      $("#adresa").val("");
      $("#grad").val("");
      $("#postanskiBr").val("");
      $("#emailAdresa").val("");
      $("#ddlUloge").val(0);
      $("#ddlPol").val(0);
      $("#skiveno").val("");
      $("#sifra").val("");
      $('input[name="aktivan"]').prop('checked',false);
			
				document.getElementById("div-levo").innerHTML="<h1>OBAVESTENJE</h1>";
				document.getElementById("div-levo").innerHTML+="<h4>Uspesno ste izmenili korisnika</h4>";
			},
			error:function(xhr,status,errorMsg)
			{
				var status = xhr.status;
				switch(status){
					case 404:
					alert("Stranica nije pronadjena");
					 break;
					case 500:
					alert("Upit se nije izvrsio");
					 break;
					default:
					alert("Greska"+xhr.status);
					 break;
				}
			}
			
		});
	}
	
	rezultat += "</ul>";
	
	document.getElementById("div-levo").style.display = "block";
	document.getElementById("div-levo").innerHTML = rezultat;
});




//Dodavanje Korisnika Admin
$('#Add').click(function()
{
	var imePrezime, regImePrezime, adresa, regAdresa, postanskiBroj, regPostanskiBroj, emailAdresa, regEmailAdresa, sifra, regSifra,grad, regGrad,pol,polIzbor,uloga,ulogaIzbor;
	
	//DOHVATANJE VREDNOSTI
	imePrezime = document.getElementById("imePrezime").value;
	adresa = document.getElementById("adresa").value;
	grad = document.getElementById("grad").value;
	postanskiBroj = document.getElementById("postanskiBr").value;
	emailAdresa = document.getElementById("emailAdresa").value;
	sifra = document.getElementById("sifra").value;
  
  pol = document.getElementById("ddlPol");
  polIzbor = pol.options[pol.selectedIndex].value;

  uloga = document.getElementById("ddlUloge");
	ulogaIzbor = uloga.options[uloga.selectedIndex].value;

  var aktivan = document.getElementsByName("aktivan");
	var aktivanIzbor = "";
	for(var i = 0; i < aktivan.length; i++)
	{
		if(aktivan[i].checked)
		{
			aktivanIzbor += aktivan[i].value + " ";
		}
	}
	var skriveno = document.getElementById("skiveno").value;

	//REGULARNI IZRAZI
	regImePrezime = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})+$/;
	regAdresa = /^([A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*(\s[\d]{1,3})$/;
	regGrad=/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10})?(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10})?$/;
	regPostanskiBroj =/^[1 2 3][0-9]{4}$/;
	regEmailAdresa =/^[\w]+[\.\_\-\w\d]*\@gmail\.com$/;
	regSifra=/^[A-Z][\w\d]{5,}$/;
	
	var Greske = new Array();
	var Podaci = new Array();
	
	if(!regImePrezime.test(imePrezime))
	{
		Greske.push("Greska - ime i prezime!");
	}
	else
	{
		Podaci.push("Ime i prezime: " + imePrezime);
	}
	if(!regAdresa.test(adresa))
	{
		Greske.push("Greska - adresa!");
	}
	else
	{
		Podaci.push("Adresa: " + adresa);
	}
	if(!regGrad.test(grad))
	{
		Greske.push("Greska - Grad!");
	}
	else
	{
		Podaci.push("Grad: " + grad);
	}
	if(!regPostanskiBroj.test(postanskiBroj))
	{
		Greske.push("Greska - Postanski Broj!");
	}
	else
	{
		Podaci.push("Postanski Broj: " + postanskiBroj);
	}
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
  if(polIzbor == "0")
  {
		Greske.push("Greska - Niste izabrali pol!");
	}

  if(ulogaIzbor == "0")
  {
		Greske.push("Greska - Niste izabrali ulogu!");
	}

	
	
	
	
	
	//ISPIS
	var rezultat="";
	rezultat += "<ul>";
	if(Greske.length != 0)
	{	rezultat+="<h1>OBAVESTENJE</h1>";
		for(var i = 0; i < Greske.length; i++)
		{	
			rezultat += "<li style='color:#ff0000;'>" + Greske[i] + "</li>";
		}
	}
	else
	{
		$.ajax({
			url:'php/adminDodaj.php',
			type:'POST',
			dataType:'json',
			data:{
				provera:"pera",
				imePrezime:imePrezime,
				adresa:adresa,
				grad:grad,
				postanskiBroj:postanskiBroj,
				emailAdresa:emailAdresa,
        sifra:sifra,
        polIzbor:polIzbor,
        ulogaIzbor:ulogaIzbor,
        aktivanIzbor:aktivanIzbor,
        skriveno:skriveno
			},
			success:function(data){
      //console.log(data);
      $("#imePrezime").val("");
      $("#adresa").val("");
      $("#grad").val("");
      $("#postanskiBr").val("");
      $("#emailAdresa").val("");
      $("#ddlUloge").val(0);
      $("#ddlPol").val(0);
      $("#skiveno").val("");
      $("#sifra").val("");
      $('input[name="aktivan"]').prop('checked',false);
			
				document.getElementById("div-levo").innerHTML="<h1>OBAVESTENJE</h1>";
				document.getElementById("div-levo").innerHTML+="<h4>Uspesno ste dodali korisnika</h4>";
			},
			error:function(xhr,status,errorMsg)
			{
				var status = xhr.status;
				switch(status){
					case 404:
					 alert("Stranica nije pronadjena");
					 break;
					case 500:
					 alert("Upit se nije izvrsio");
					 break;
					default:
					 alert("Greska"+xhr.status);
					 break;
				}
			}
			
		});
	}
	
	rezultat += "</ul>";
	
	document.getElementById("div-levo").style.display = "block";
	document.getElementById("div-levo").innerHTML = rezultat;
});

//KONTAKT FORMA
$("#mika").click(function()
{	
	var naslov = document.getElementById('naslovPoruke').value;
	
	var poruka = document.getElementById('porukaKorisnika').value;

	var regNaslov =/^[A-z\s\!\?]{3,50}$/;
	var regPoruka =/^[A-z\?\@\-\_\!\s]{3,500}$/;

	var Greske = new Array();

	if(!regNaslov.test(naslov))
	{
		Greske.push("Greska - Naslov niste dobro ubeli!");
	}
	if(!regPoruka.test(poruka))
	{
		Greske.push("Greska - pri unosu poruke!");
	}
	//ISPIS
	var rezultat="";
	rezultat += "<ul>";
	if(Greske.length != 0)
	{	rezultat+="<h1>OBAVESTENJE</h1>";
		for(var i = 0; i < Greske.length; i++)
		{	
			rezultat += "<li style='color:#ff0000;'>" + Greske[i] + "</li>";
		}
	}
	else
	{
		$.ajax({
			url:'php/kontaktKorisnika.php',
			type:'POST',
			dataType:'json',
			data:{
				provera:"pera",
				naslov:naslov,
				poruka:poruka
			
			},
			success:function(data){
     			 //console.log(data);
     			 $("#naslovPoruke").val("");
     			 $("#porukaKorisnika").val("");
      
			
				document.getElementById("div-levo").innerHTML="<h1>OBAVESTENJE</h1>";
				document.getElementById("div-levo").innerHTML+="<h4>Uspesno ste nas kontaktirali</h4>";
			},
			error:function(xhr,status,errorMsg)
			{
				var status = xhr.status;
				switch(status){
					case 404:
					 alert("Stranica nije pronadjena");
					 break;
					case 500:
					 alert("Upit se nije izvrsio");
					 break;
					default:
					 alert("Greska"+xhr.status);
					 break;
				}
			}
			
		});
	}
	
	
	rezultat += "</ul>";
	document.getElementById("div-levo").style.display = "block";
	document.getElementById("div-levo").innerHTML = rezultat;
});


//ANKETA
$('.btnAnketa').click(function(){
	var idAnketa = $(this).attr('data-id');
	var izb=$('#ddl'+idAnketa).val();
	//alert(izb);

	$.ajax({
		type: "POST",
		url: "php/anketa.php",
		data:{
			anketa:true,
			idAnketa:idAnketa,
			idOdgovor:izb
		},
		dataType: "json",
		success: function (data) {
			console.log(data);
			var ispis = "<ul>";
			
			for(var i=0; i<data.length; i++)
			{
				ispis +="<li>"+data[i]+"</li>";
			}
			ispis += "</ul>";
			$("#div-levo").html(ispis);
		},
		error:function(xhr)
		{
			console.log("EROR: ",xhr);
		}
	});
});



});	


function slideShow() {
  var current = $('#slajder .show');
  var next = current.next().length ? current.next() : current.parent().children(':first');
  
  current.hide().removeClass('show');
  next.fadeIn().addClass('show');
  
  setTimeout(slideShow, 5000);
}
























