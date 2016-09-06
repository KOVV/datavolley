<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>KOVV - Detectie</title>

  <!-- Bootstrap core CSS -->
  <link href={{ URL::asset('assets/css/bootstrap.css') }} rel="stylesheet">

  <!--external css-->
  <link href={{ URL::asset('assets/font-awesome/css/font-awesome.css') }} rel="stylesheet" />
  <link href={{ URL::asset('assets/css/jumbotron.css') }} rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.css"/>


   
    </head>

    <body style="height:inherit; padding:0px;">
      <div class="container" style="height:inherit;">


        <div  class="row">
          <div class="page-header">
            <h1>DETECTIE 2016</h1>
          </div>
          <a href="#topAlert"></a>
          <div hidden class="alert alert-danger" id="topAlert" role="alert"></div>

        </div>

        <div hidden class="row" id="rowWithoutToken">


          <div class="col-xs-12">


            <div>
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h3>Vul hieronder de code in die vermeld is op de uitnodiging.</h3>
                    <form class="form-inline">
                      <div class="form-group">

                        <input type="text" class="form-control" id="inputToken" placeholder="Vul hier je code in" >
                      </div>

                      <button  type="submit" id="btnVerstuur" class="btn btn-primary">Go!</button>
                    </form>  
                  </div>
                </div>
              </div>

            </div>


          </div>
        </div>


        <div hidden class="row" id="rowWithToken">




          <h3 id="headerIntro" style="padding-left:50px; padding-right:50px;"> Welkome <span id="headerName"> mathias</span>, laat hieronder weten of je op de detectie training aanwezig zal zijn. Vul ook je gegevens aan waar nodig.</h3>




            <div id="rowActivity" class="col-xs-12" >

             <h1 style="text-align:center;">Activiteit</h1>

             <p> Laat ons weten of je aanwezig zal zijn </p>
             <form id="radioActiviteit" class="form-horizontal">
               <div class="radio">
                <label>
                  <input type="radio" name="activiteitKeuze" id="aanwezig" value="1" >
                  Ik zal aanwezig zijn op de detectietraining van 3 september
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="activiteitKeuze" id="ntAanwezigIntersse" value="2">
                  Ik wil graag aanwezig zijn maar kan niet op 3 september                 </label>
                </div>
                <div class="radio ">
                  <label>
                    <input type="radio" name="activiteitKeuze" id="gnInteresse" value="3" >
                    Ik heb geen interesse
                  </label>
                </div>
              </form>




            </div>
            <div hidden id="gegevens" class="col-xs-12" >

              <h1 style="text-align:center;">Gegevens</h1>

              <p>Onderstaande gegevens bekomen we via de Vlaamse volleybal bond en worden verzameld door jouw club bij het aanvragen van een lidkaart.</p>

              <form id="frmGegevens" class="form-horizontal">

               <div class="form-group">
                <label  class="col-sm-2 control-label">Club</label>
                <div class="col-sm-6">
                  <p class="fixInput " id="txtClub" > </p>
                </div>
              </div>


              <div class="form-group">
                <label  class="col-sm-2 control-label">Naam</label>
                <div class="col-sm-6">
                  <p class="fixInput"> <span id="txtVoornaam"> </span>  <span id="txtAchternaam"> </span></p>
                
                </div>
              </div>
 <div class="form-group">

              <label  class="col-sm-2 col-sm-12 control-label">Geboortejaar</label>


              <div class="col-sm-6">
                  <p class="fixInput"> <span id="txtGeboortejaar"> </span>  </p>

              </div>
            </div>

              <div class="form-group" id="groupStraat">
                <label for="inputStraat" class="col-sm-2 col-sm-12 control-label">Straat*</label>


                <div class="col-sm-6">
                  <input type="text" class="form-control" id="inputStraat"  placeholder="Straat">
                <div hidden class="parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
                </div>


              </div>
              <div class="form-group" id="groupHuisnr">
                <label for="inputHuisNr" class="col-sm-2 col-sm-12 control-label">Huisnr*</label>

                <div class="col-sm-2">
                  <input type="text" class="form-control" id="inputHuisNr"  placeholder="Huisnr">
                </div>
                  <div hidden class="col-sm-6 parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
                </div>
                
              
              <div class="form-group" id="groupPostcodeGemeente">
              <label for="inputPostcode" class="col-sm-2  control-label">Postcode*</label>
              <div class="col-sm-2">

                <input type="text" class="form-control" id="inputPostcode"  placeholder="Postcode">
              
                    
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="inputGemeente"  placeholder="Gemeente">

              </div>
              <div hidden class="col-sm-6 col-sm-offset-2 parent-help-block">
                
                                    <span  class="help-block">
                                 
                                    </span>
              </div>
            </div>
           
             <div class="form-group" id="groupTel">
              <label for="inputTelefoonNr" class="col-sm-2 col-sm-12 control-label">TelefoonNr*</label>


              <div class="col-sm-6">
                <input type="text" class="form-control" id="inputTelefoonNr"  placeholder="Telefoon nummer:055/12 12 12 of 0497/76 85 43">
                 <div hidden class="parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
              </div>
            </div>



            <p>Ouder 1</p>
            <div class="form-group" id="groupOuder1Naam">
              <label for="inputOuder1Naam" class="col-sm-2 control-label">Naam*</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="inputOuder1Naam"  placeholder="Naam">
                <div hidden class="parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
              </div>
            </div>
            <div class="form-group" id="groupOuder1Email">
              <label for="inputEmailOuder1" class="col-sm-2 control-label">Email adress*</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmailOuder1"  placeholder="Email">
                <div hidden class="parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
              </div>
            </div>
            <div class="form-group" id="groupOuder1Tel">
              <label for="inputTelefoonOuder1" class="col-sm-2 control-label">TelefoonNr*</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="inputTelefoonOuder1"  placeholder="Telefoon">
                <div hidden class="parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
              </div>
            </div>

            <p>Ouder 2</p>
            <div class="form-group" id="groupOuder2Naam">
              <label for="inputOuder2Naam" class="col-sm-2 control-label">Naam</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="inputOuder2Naam"  placeholder="Naam">
                <div hidden class="parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
              </div>
            </div>
            <div class="form-group" id="groupOuder2Email">
              <label for="inputEmailOuder2" class="col-sm-2 control-label">Email adress</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="inputEmailOuder2"  placeholder="Email">
                <div hidden class="parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
              </div>
            </div>
            <div class="form-group" id="groupOuder2Tel">
              <label for="inputTelefoonOuder2" class="col-sm-2 control-label">TelefoonNr</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="inputTelefoonOuder2"  placeholder="Telefoon">
                <div hidden class="parent-help-block">
                                    <span  class="help-block">
                                    </span>
</div>
              </div>
            </div>
          </form>


        </div>
        <div hidden class="col-xs-12" id="verstuurBtnDiv">
         <button type="btn" id="verstuurBtn" class="btn btn-default">Versturen</button>

        </div>
       

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src={{ URL::asset('assets/js/jquery.js') }}></script>
    <script src={{ URL::asset('assets/js/jquery-1.8.3.min.js') }}></script>


    <script>


    </script>

    <script src={{ URL::asset('assets/js/bootstrap.min.js') }}></script>
    <script class="include" type="text/javascript" src={{ URL::asset('assets/js/jquery.dcjqaccordion.2.7.js') }}></script>
    <script src={{ URL::asset('assets/js/jquery.scrollTo.min.js')}}></script>
    <script src={{ URL::asset('assets/js/jquery.nicescroll.js')}} type="text/javascript"></script>




    <!--common script for all pages-->
    <!--
    <script src={{ URL::asset('assets/js/admin.js')}}> </script>
  -->
  <script src={{ URL::asset('assets/js/common-scripts.js')}}></script>







  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
  <script>
  moment().format();
  </script>



  <script>

  $.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
 });

  /*GLOBAL VARIABELS*/
  var activiteitArray = [];
  var activiteitIdArray = [];
  var activiteitPersoonArray = [];
  var activiteitStatusArray = [];
  var token;
  /*FUNCTIONS*/
var test ="";



/*INIT*/

//GET DETECTIE ACTIVITIES
var activity = $.ajax({
 url: '/api/v1/public/activity',
 data:{type:'DETECTIE'},
 dataType:"json"

})
.done(function( data ) {
  console.log('Total records:' + data.recordsTotal);
  activiteitArray=data.data;
  
});
//READ PARAMETERS IN URL

var sPageURL = decodeURIComponent(window.location.search.substring(1)),
sURLVariables = sPageURL.split('&'),
sParameterName,
i;
var hasTokenFlag = 0;
for (i = 0; i < sURLVariables.length; i++) {
  sParameterName = sURLVariables[i].split('=');
  console.log(sParameterName);
  if (sParameterName[0] === "token") {
    hasTokenFlag = 1;
    token = sParameterName[1];

  }
  
}

if(hasTokenFlag==1){

 console.log('rowWithToken');
 console.log('token='+token);

 $.when(activity).done(function(){


 $.each(activiteitArray,function(index, value){
  activiteitIdArray.push(value.activiteit_ID);
});

 var activiteit = activiteitIdArray.join(";");
 $.ajax({
  url: "/api/v1/private/"+token+"/activity/"+activiteit+"/person",
  dataType:"json",
  type:"get"
})
 .done(function( data ) {
  activiteitPersoonArray = data.data;
  console.log('Succes identified');
  
  if (activiteitPersoonArray.length == 0){
    $('#topAlert').text("Token niet teruggevonden. Probeer opnieuw of neem contact op met NNNN@kovv.be");
   $('#topAlert').show();
  } else {

      console.log('Succes identified');
      $('#headerName').text(activiteitPersoonArray[0].persoon_Voornaam);
      $('#rowWithToken').show();
      //FILL personal data
      $("#txtVoornaam").text(activiteitPersoonArray[0].persoon_Voornaam);
      $("#txtAchternaam").text(activiteitPersoonArray[0].persoon_Achternaam);
      $("#txtClub").text(activiteitPersoonArray[0].club);
      $("#inputStraat").val(activiteitPersoonArray[0].persoon_Straat);
      $("#inputHuisNr").val(activiteitPersoonArray[0].persoon_HuisNr);
      $("#inputPostcode").val(activiteitPersoonArray[0].persoon_Postcode);
      $("#inputGemeente").val(activiteitPersoonArray[0].persoon_Gemeente);
      $("#txtGeboortejaar").text(activiteitPersoonArray[0].persoon_GeboorteDatum);
      $("#inputTelefoonNr").val(activiteitPersoonArray[0].persoon_Telefoon);

      

      $("#inputOuder1Naam").val(activiteitPersoonArray[0].persoon_ouder1);
      $("#inputEmailOuder1").val(activiteitPersoonArray[0].persoon_Ouder1_Email);
      $("#inputTelefoonOuder1").val(activiteitPersoonArray[0].persoon_Ouder1_Telefoon);

      $("#inputOuder2Naam").val(activiteitPersoonArray[0].persoon_ouder2);
      $("#inputEmailOuder2").val(activiteitPersoonArray[0].persoon_Ouder2_Email);
      $("#inputTelefoonOuder2").val(activiteitPersoonArray[0].persoon_Ouder2_Telefoon);






  }


})
 .fail(function(data){
   console.log('Token identification failed');
   $('#topAlert').text("Error. Probeer opnieuw of neem contact op met NNNN@kovv.be");
   $('#topAlert').show();
 });

});

} else
{
  console.log('rowWithoutToken');

  $('#rowWithoutToken').show();


}



 //EVENT HANDLERS
 // // Code versturen
 $('#btnVerstuur').on('click',function(event){
  event.preventDefault();
  var inputToken = $('#inputToken').val();
  console.log('send code: '+inputToken);
  window.location = "registreer?token="+inputToken;


});

// // Radio button selection
$("#radioActiviteit input[name='activiteitKeuze']").on('click',function(){
var selectedVal = "";
var selected = $("#radioActiviteit input[name='activiteitKeuze']:checked").val();

console.log("keuze van activiteit: "+selected);

switch(selected) {
    case '1':
    $('#gegevens').show();
    $('#verstuurBtnDiv').show();
        break;
    case '2':
      $('#gegevens').show();
    $('#verstuurBtnDiv').show();
        break;
    case '3':
             $('#gegevens').hide();
    $('#verstuurBtnDiv').show();
        break;
}
  
});

//Button verstuur
$("#verstuurBtn").on('click',function(){

$('#frmGegevens div.form-group').removeClass('has-error');
$('#frmGegevens div.parent-help-block').hide();
        $('#frmGegevens div.parent-help-block span').html("");

  console.log('Verstuur button click');
  var straat =       $("#inputStraat").val();
  var huisNr =       $("#inputHuisNr").val();
  var postcode =       $("#inputPostcode").val();
  var gemeente =       $("#inputGemeente").val();
  //var geboorteDatum =       $("#inputGeboortejaar").val();
  var telefoonNr =       $("#inputTelefoonNr").val();

     var ouder1 =  $("#inputOuder1Naam").val();
      var ouder1Email = $("#inputEmailOuder1").val();
      var ouder1Tel = $("#inputTelefoonOuder1").val();
      var ouder2 = $("#inputOuder2Naam").val();
      var ouder2Email = $("#inputEmailOuder2").val();
      var ouder2Tel = $("#inputTelefoonOuder2").val();


  var persoon=activiteitPersoonArray[0].persoon_id;


  var pers =  $.ajax({
  url: "/api/v1/private/"+token+"/person/"+persoon,
   data:{persoon_Straat:straat,
    persoon_HuisNr:huisNr,
persoon_Postcode:postcode,
persoon_Gemeente:gemeente,
//persoon_GeboorteDatum:geboorteDatum,
persoon_Telefoon:telefoonNr,
persoon_Ouder1: ouder1,
persoon_ouder2: ouder2,
persoon_Ouder2_Email: ouder2Email,
persoon_Ouder2_Telefoon: ouder2Tel,
persoon_Ouder1_Email:ouder1Email,
persoon_Ouder1_Telefoon:ouder1Tel
  },
 dataType:"json",
 type:"put"

})
 .done(function( data ) {
 console.log('persoon update ready');
})
 .fail(function(data){
  console.log('persoon update error');
 });



var activiteit = activiteitIdArray.join(";");
activiteitStatus =  $("#radioActiviteit input[name='activiteitKeuze']:checked").val();
var act = $.ajax({
  url: "/api/v1/private/"+token+"/activity/"+activiteit+"/person/"+persoon,
   data:{actPersonStatus:activiteitStatus
  },
 dataType:"json",
 type:"put"

})
 .done(function( data ) {
 console.log('ready activity update');
})
 .fail(function(data){
  console.log('error activity update');
 });




$.when(act, pers).done(function(v1,v2){
  window.location = "registreer/success"; 

}).fail(function(v1,v2){
test = v1;
  if (v1.status == 422){

$.each( JSON.parse(v1.responseText) , function( key, value ) {

switch (key){

case 'persoon_Straat':
    $('#groupStraat').addClass('has-error');
    $('#groupStraat div.parent-help-block').show();
        $('#groupStraat span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_Gemeente':
case 'persoon_Postcode':
    $('#groupPostcodeGemeente').addClass('has-error');
    $('#groupPostcodeGemeente div.parent-help-block').show();
        $('#groupPostcodeGemeente span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_HuisNr':
    $('#groupHuisnr').addClass('has-error');
    $('#groupHuisnr div.parent-help-block').show();
        $('#groupHuisnr span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_Telefoon':
    $('#groupTel').addClass('has-error');
    $('#groupTel div.parent-help-block').show();
        $('#groupTel span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_Ouder1':
    $('#groupOuder1Naam').addClass('has-error');
    $('#groupOuder1Naam div.parent-help-block').show();
        $('#groupOuder1Naam span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_Ouder1_Email':
    $('#groupOuder1Email').addClass('has-error');
    $('#groupOuder1Email div.parent-help-block').show();
        $('#groupOuder1Email span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_Ouder1_Telefoon':
    $('#groupOuder1Tel').addClass('has-error');
    $('#groupOuder1Tel div.parent-help-block').show();
        $('#groupOuder1Tel span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_ouder2':
    $('#groupOuder2Naam').addClass('has-error');
    $('#groupOuder2Naam div.parent-help-block').show();
        $('#groupOuder2Naam span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_Ouder2_Email':
    $('#groupOuder2Email').addClass('has-error');
    $('#groupOuder2Email div.parent-help-block').show();
        $('#groupOuder2Email span.help-block').append("<strong>"+value+"</strong>");
break;
case 'persoon_Ouder2_Telefoon':
    $('#groupOuder2Tel').addClass('has-error');
    $('#groupOuder2Tel div.parent-help-block').show();
        $('#groupOuder2Tel span.help-block').append("<strong>"+value+"</strong>");
break;

}

});

        

  } else {
 $('#topAlert').text("Fout bij het versturen. Probeer opnieuw of neem contact op met NNNN@kovv.be");
   $('#topAlert').show();
    location.hash = "#topAlert";
  }
  
//console.log("status "+v1.status+" en dan het: "+JSON.parse(v1.responseText).persoon_Postcode)
  //console.log(statusCode);

});

});
 </script>


</body>
</html>



