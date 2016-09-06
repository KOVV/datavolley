

@extends('admin.template')

@section('title', '- detectie')

@section('head')
@parent
<style>
tr.selected{
  margin-top: 10px; 
  margin-left: 20px;
}

</style>

@stop

@section('menuDetectie')
<li class="sub-menu dcjq-current-parent active">
     <a  href="javascript:;" >                          <i class="fa fa-desktop"></i>
                          <span>Detectie</span>
                      </a>
                      <ul class="sub">
                                                  <li class=""><a  href={{ URL::asset('admin/detectie/')}}>Overview</a></li>

                          <li class="active"><a  href={{ URL::asset('admin/detectie/deelnemers')}}>Deelnemers</a></li>
                          <li><a  href={{ URL::asset('admin/detectie/toewijzen')}}>Toewijzen</a></li>
                      </ul>
                  </li>
@endSection

@section('content')

    <div class="row">
<div class="col-xs-12" style="text-align:center;margin-top:0px;">

      <h3>Detectie bekijken</h3>



    </div>


<div class="form-group">
    <label for="inputDescription" class="control-label  col-xs-1">Search</label>
    <div class=" col-sm-9 col-md-6">
     <div class='input-group date' id='datetimepickerEnd'>
      <input id="inputSearch" type='text' class="form-control"  />
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-search"></span>
      </span>
    </div>
  </div>
  <div class=" col-sm-12 col-md-5">


    <div class="btn-group" role="group" aria-label="...">
<button type="button" id="btnFilters" class="btn btn-default">Filter</button>  
<!--
<button type="button" id="btnActies" class="btn btn-default">Select</button>  
-->
<!--
<button type="button" id="btnSpelers" class="btn btn-default">Spelers toevoegen</button>  
-->
</div>


</div>
</div>
</div>

<div hidden class="row form-inline" id="rowFilters">

<div class="col-sm-2">


    <label for="inputDescription" class="control-label ">Bevestigd</label>
  </div>
    <div class="col-sm-4">
    <select id="selectBevestigd" class="form-control">
       <option></option>
      <option value="3">Geen interesse</option>
      <option value="2">Interesse maar niet aanwezig</option>
      <option value="1">Aanwezig</option>
      <option value="0">Geen antwoord</option>
    </select>

  
</div>

<div class="col-sm-2">

  <label for="inputDescription" class="control-label">Has email?</label>
</div>
    <div class="col-sm-2">
    <select id="selectEmail" class="form-control">
      <option></option>
      <option>1</option>
      <option>0</option>
    </select>

  </div>




  </div>


</div>



<div class="row">

        <div class="col-sm-12">
 <table id="activityTable" class="table table-hover" style="
    border-top: solid 1px;
    margin-top: 20px;">
    <thead>
      <tr><th>Naam</th><th>Voornaam</th><th>Gender</th><th>Club</th><th>Geboortejaar</th><th>Heeft email</th><th>Bevestigd</th><th>Token</th></tr>
    </thead>
    <tbody>
     
    </tbody>
  </table>
  
        </div>

        <div class="col-sm-12">



        </div>
      

</div>

<div class="row" hidden id="rowActies" style="width:100%; position:fixed; bottom:0px; padding:10px; background-color:white;z-index:2;">
 <div class="col-xs-2">
  <p><span id="nbrRecordsSelected">0</span> records geselected</p>
 </div>
 
  <div class="col-xs-4">
    <select id="optionsActie" class="form-control">
            <option value="selectAll">Alles selecteren</option>
      <option value="deselectAll">Selectie ongedaan maken</option>
<!--
      <option value="email1spelers">Verstuur email naar speler</option>
      <option value="email2spelers">Verstuur reminder email naar speler</option>
      <option value="export">Export spelers</option>
      <option value="email1clubs">Verstuur email 1 naar clubs</option>
      <option value="email2clubs">Verstuur email 2 naar clubs</option>
    -->
    </select>

  </div>
  <div class="col-xs-2">
<button id="btnActieUitvoeren" type="btn" class="btn btn-default">Actie uitvoeren</button>
  </div>

</div>



<div class="row" hidden id="rowSpelers">



<div class="col-xs-12" style="text-align:center;margin-top:0px;">

      <h3>Detectie bekijken</h3>



    </div>


<div class="form-group">
    <label for="inputDescription" class="control-label  col-xs-1">Search</label>
    <div class=" col-xs-11">
     <div class='input-group date' id='datetimepickerEnd'>
      <input id="inputSearch" type='text' class="form-control"  />
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-search"></span>
      </span>
    </div>
  </div>
</div>


   <div class="col-xs-12">
 <table id="personen" class="table table-striped">
    <thead>
      <tr><th>Lid_Voornaam</th><th>Lid_Naam</th></tr>
    </thead>
    <tbody>
     
    </tbody>
  </table>
  
        </div>

        

</div>



@endsection

@section('footer')
@parent
<script>
$.ajaxSetup({
 headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
});

/*FUNCTIONS*/



/*INIT*/
var activiteitArray = [];
var activiteitIdArray = [];
var activiteitPersoonArray = [];
var activiteitPersoonSelectedArray = [];
var filteredData = [];
var canvas = document.createElement("canvas");
var  openedRowData = '';


//GET DETECTIE ACTIVITIES
var act = $.ajax({
 url: "{{URL::to('api/v1/public/activity')}}",
 data:{type:'DETECTIE'},
 dataType:"json"

})
.done(function( data ) {
  console.log('Total rcords:' + data.recordsTotal);
  activiteitArray=data.data;
  
});

//Request activity persoon
$.when(act).done(function() {
  // Handle both XHR objects
  console.log("all complete");

$.each(activiteitArray,function(index, value){
  activiteitIdArray.push(value.activiteit_ID);
});
var activiteit = activiteitIdArray.join(";");
console.log(activiteit);


$.ajax({
 url: "{{URL::to('api/v1/private/activity')}}"+"/"+activiteit+"/person",
 dataType:"json"

})
.done(function( data ) {
  //console.log('Total rcords:' + data.recordsTotal);
  activiteitPersoonArray=data.data;
          $('#activityTable').DataTable().rows.add(activiteitPersoonArray).draw();

  
});

});

$('#inputSearch').on( 'keyup', function () {
  console.log('test op search')

    $('#activityTable').DataTable().search( this.value ).draw();
} );


$('#selectEmail').on('change',function(event){
var tableActivity = $("#activityTable").DataTable();
 var selected = $('#selectEmail').val();
 console.log(selected);
 tableActivity
    .column( 5)
    .search( selected).draw();

   
});


$('#selectBevestigd').on('change',function(event){
var tableActivity = $("#activityTable").DataTable();
 var selected = $('#selectBevestigd').val();
 console.log(selected);
 tableActivity
    .column( 6)
    .search( selected).draw();

   
});


/*EVENT HANDLERS*/



$('#btnActieUitvoeren').on('click',function(event){
  var optionActie = $('#optionsActie').val();
   console.log(optionActie);
var tableActivity = $("#activityTable").DataTable();

  switch(optionActie){
    case 'selectAll':
      console.log('Select all');
      $('#activityTable tbody tr').addClass('success');
      activiteitPersoonSelectedArray = tableActivity.rows('.success').data();
        $('#nbrRecordsSelected').text(activiteitPersoonSelectedArray.length);
      break;


    case 'deselectAll':
       
         var tableActivity = $("#activityTable").DataTable();
         break;
    case 'email1spelers':
        console.log('send email to:');
        i =0;
        for (i=0;i< activiteitPersoonSelectedArray.length; i++){
          console.log('Persoon: '+activiteitPersoonSelectedArray[i].persoon_Voornaam+' token: '+activiteitPersoonSelectedArray[i].persoon_token);
        }
        break;
 
 tableActivity.search( '' )
 .columns().search( '' )
 .draw();
 $('#activityTable tbody tr').removeClass('success');
        activiteitPersoonSelectedArray = tableActivity.rows('.success').data();
        $('#nbrRecordsSelected').text(activiteitPersoonSelectedArray.length);
      break;
  }

});


$('#btnActies').on('click',function(event){
  
if($('#btnActies').hasClass('active')){
      $('#btnActies').removeClass('active');
      $('#rowActies').hide();
      $('#btnActies:focus').blur();
      $('#activityTable tbody .success').removeClass('success');
      activiteitPersoonSelectedArray = [];
      $('#nbrRecordsSelected').text(activiteitPersoonSelectedArray.length);
  } else {
    $('#activityTable tbody tr.shown + tr').hide();
           $('#activityTable tbody tr.shown ').removeClass('shown');
      $('#btnActies').addClass('active');
      $('#rowActies').show();
  }


});

$('#btnFilters').on('click',function(event){

  if($('#btnFilters').hasClass('active')){
      $('#btnFilters').removeClass('active');
      $('#rowFilters').hide();
      $('#btnFilters:focus').blur();
      var tableActivity = $("#activityTable").DataTable();
 
 tableActivity.search( '' )
 .columns().search( '' )
 .draw();
  } else {
    $('#activityTable tbody tr.shown + tr').hide();
           $('#activityTable tbody tr.shown ').removeClass('shown');
      $('#btnFilters').addClass('active');
      $('#rowFilters').show();
  }

});

$('#btnSpelers').on('click',function(event){

  if($('#btnSpelers').hasClass('active')){
      $('#btnSpelers').removeClass('active');
      $('#rowSpelers').hide();
      $('#btnSpelers:focus').blur()
  } else {
      $('#btnSpelers').addClass('active');
      $('#rowSpelers').show();
  }

});


 /* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
              '<td colspan="4">Volgnummer:<input id="volgNummer" type="number"/></td>'+
        '</tr>'+
        '<tr>'+
              '<td colspan="4" rowspan="1"><input id="fileupload" type="file" name="pic" accept="image/*"></td>'+
        '</tr>'+
        '<tr>'+
              '<td colspan="4" rowspan="3"><canvas id="ca"></canvas></td>'+
        '</tr>'+
'<tr>'+
        '<td colspan="4"  rowspan="1"><button id="testbtn" class="btn">Opladen</button></td>'+
        '</tr>'+
       
    '</table>';
}


$(document).ready(function() {

   var table = $("#activityTable").DataTable( {
   searching: true,
   ordering:  false,
   info: true,
  // bPaginate: true,
    //bLengthChange: false,
   pageLength: 50,
   dom:'tip',
   data: activiteitPersoonArray,
   columns: [
   { data: 'persoon_Achternaam'},
   { data: 'persoon_Voornaam'},
   { data: 'persoon_Geslacht'},
   { data: 'club'},
   { data: 'persoon_GeboorteDatum'},
   { data: 'has_email'},
   { data: 'aanwezigheidsstatus'},
   { data: 'persoon_token'}
   ]
 } );

//var tableActivity = $("#activityTable").DataTable();

$('#activityTable tbody').on( 'click', 'tr.odd,tr.even', function () {

// If select button is pressed then we select records
if ($('#btnActies').hasClass('active')) {

  $(this).toggleClass('success');
        activiteitPersoonSelectedArray = table.rows('.success').data();
        $('#nbrRecordsSelected').text(activiteitPersoonSelectedArray.length);

} 
// else we give details
else{

 openedRowData = table.row( this ).data();

         var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
           //$('#activityTable tbody tr.shown + tr').hide();
                    var tr1 = $('#activityTable tbody tr.shown');
        var row1 = table.row( tr1 );
          row1.child.hide();
           $('#activityTable tbody tr.shown ').removeClass('shown');
            row.child( format(row.data()) ).show();
            tr.addClass('shown');


function readURL(input) {

    if (input.files && input.files[0]) {
      
console.log('in readUrl');

              var reader = new FileReader();
        var img = document.createElement("img");
        reader.onload = function (e) {
          img.src = e.target.result;

       var MAX_WIDTH = 682;
var MAX_HEIGHT = 1024;
var width = img.width;
var height = img.height;
 
if (width > height) {
  if (width > MAX_WIDTH) {
    height *= MAX_WIDTH / width;
    width = MAX_WIDTH;
  }
} else {
  if (height > MAX_HEIGHT) {
    width *= MAX_HEIGHT / height;
    height = MAX_HEIGHT;
  }
}
canvas.width = width;
canvas.height = height;
var ctx = canvas.getContext("2d");

ctx.drawImage(img, 0, 0, width, height);
//var dataurl = canvas.toDataURL("image/jpeg");

// example image
 var canvas1 = document.getElementById("ca");
       var MAX_WIDTH = 100;
var MAX_HEIGHT = 100;
var width = img.width;
var height = img.height;
 
if (width > height) {
  if (width > MAX_WIDTH) {
    height *= MAX_WIDTH / width;
    width = MAX_WIDTH;
  }
} else {
  if (height > MAX_HEIGHT) {
    width *= MAX_HEIGHT / height;
    height = MAX_HEIGHT;
  }
}
canvas1.width = width;
canvas1.height = height;
var ctx = canvas1.getContext("2d");

ctx.drawImage(img, 0, 0, width, height);






        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#fileupload").change(function(){
     console.log("read this START");
    readURL(this);
    console.log("read this OK");

});

function dataURItoBlob(dataURI) {
    // convert base64/URLEncoded data component to raw binary data held in a string
    var byteString;
    if (dataURI.split(',')[0].indexOf('base64') >= 0)
        byteString = atob(dataURI.split(',')[1]);
    else
        byteString = unescape(dataURI.split(',')[1]);


    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    // write the bytes of the string to a typed array
    var ia = new Uint8Array(byteString.length);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    return new Blob([ia], {type:mimeString});
}
           
            $('#testbtn').on('click',function(event){
 //var canvas = document.getElementById("ca");
var dataURL = canvas.toDataURL("image/jpeg");
var blob = dataURItoBlob(dataURL);
console.log(blob);
var formData = new FormData(document.forms[0]);
formData.append("file", blob, openedRowData.Lid_Nummer+'.jpg');

 
var upload = $.ajax({
url: "{{URL::to('apply/upload')}}",
data:formData,
dataType:"json",
type:"post",
 cache: false,
        contentType: false,
        processData: false
})
.done(function( data ) {
console.log('persoon update file ready');
})

var fileName = $.ajax({
url: "{{URL::to('api/v1/private/person/')}}"+'/'+openedRowData.persoon_id,
data:{persoon_Image:openedRowData.Lid_Nummer+'.jpg'},
dataType:"json",
type:"put"
})
.done(function( data ) {
console.log('persoon update file name ready');
})


  // nog aan te passen
  var activiteit = 556;

var fields =   $.ajax({
    url: "{{URL::to('api/v1/private/')}}"+ "/activity/"+activiteit+"/person/"+openedRowData.persoon_id,
    data:{volgNummer:$('#volgNummer').val(), aanwezigheidsStatus:1},
    dataType:"json",
    type:"put"
  })
  .done(function( data ) {
    console.log('persoon update volgnummer name ready');
  })

$.when( fields, fileName, upload).done(function ( v1, v2 ) {
  window.alert('upload ok');
   var tr1 = $('#activityTable tbody tr.shown');
        var row1 = table.row( tr1 );
          row1.child.hide();
           $('#activityTable tbody tr.shown ').removeClass('shown');
}).fail(function(){window.alert('failed')});

});

        }
    } 
  });
 

        

   




 /*
    var tablePesonen = $('#personen').DataTable( {
    serverSide: true,
    searching: true,
   ordering:  false,
   info: true,
  // bPaginate: true,
    //bLengthChange: false,
   pageLength: 50,
   dom:'tip',
    ajax: {
        url: 'http://localhost:8888/api/v1/private/vvbLid',
        //data:{geboorteDatum:"2005;1999"}
    
      },
        columns : [
            { "data": "Lid_Voornaam" },
            { "data": "Lid_Naam" }
        ]
    
} );

    */

$('#personen tbody').on( 'click', 'tr', function () {
      //  $(this).toggleClass('success');

      
    /*
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    } );
*/

});



});


</script>
@stop