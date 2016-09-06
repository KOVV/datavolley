

@extends('admin.template')

@section('title', 'detectie')

@section('header')
@parent
<style>
.activityInsertInline{
  margin-top: 10px; 
  margin-left: 20px;
}

</style>


@stop

@section('menuDetectie')
<li class="sub-menu">
  <a  href={{ URL::asset('admin/detectie')}}  >
    <i class="fa fa-desktop"></i>
    <span>Detectie</span>
  </a>

</li>
@endSection

@section('content')

<div class="row" id="activityNone" >


  <div class="col-md-6 col-sm-12 col-md-offset-3" style="text-align:center;margin-top:30px;">

    <h3>Geen detectie gevonden!</h3>
    <h4><small>Er zijn geen actieve detectie activiteiten gevonden</small></h4>
    <button type="button" class="btn btn-primary">Nieuwe detectie toevoegen</button>
    <h5>Bekijk oudere detectie activiteiten <u><a>hier</a></u></h5>
  </div>
</div>

<!--INSERT ACTIVITIES-->
<div hidden id="activityInsert">
  <div  class="row activityRow">
    <div class="col-md-6 col-sm-12 col-md-offset-3" style="text-align:center;margin-top:0px;">

      <h3>Nieuwe detectie aanmaken</h3>



    </div>

    <div class="col-xs-12">
      <h4>1. Activiteit:</h4>
    </div>
    <div id="addActivityBtn" hidden class="col-xs-12">

      <button type="button" class="btn btn-primary btn-sm">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Add extra activity
      </button>
    </div>
  </div>

  <form  class="activityInsertInline activityRow form-horizontal" id="insertDetection"> 
    <div class="form-group">
      <div class="col-xs-12">
        <h5>Activiteit toevoegen</h5>
      </div>
      <label for="inputDescription" class="control-label col-xs-12">Omschrijving</label>
      <div class="col-xs-12">
        <input type="text" class="form-control" id="inputDescription" placeholder="Detectie training lichting 2005-2006 op 27/09/2016">
      </div>
    </div>

    <div class="form-group">
      <label for="inputDescription" class="control-label col-sm-3 col-xs-12">Startdatum en uur</label>
      <div class="col-sm-5 col-xs-12">
       <div class='input-group date' id='datetimepickerStart'>
        <input id="inputStartDate" type='text' class="form-control" />
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="inputDescription" class="control-label col-sm-3 col-xs-12">Einddatum en uur</label>
    <div class="col-sm-5 col-xs-12">
     <div class='input-group date' id='datetimepickerEnd'>
      <input id="inputEndDate" type='text' class="form-control" placeholder="2016-06-29 12:00:00" />
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
      </span>
    </div>
  </div>

</div>

<div class="form-group">
  <label  class="control-label col-xs-12">Plaats</label>
  <div class="col-xs-12">
    <select class="form-control">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>

  </div>
</div>

<button id="insertDetection" type="submit" class="btn btn-default">Toevoegen aan detectie</button>
</form>


<div id="activityOverview" hidden class="activityRow row">
  <div class="col-xs-12">
    <table id="activityTable" class="table table-striped">
      <thead><tr><th>Omschrijving</th><th>Startdatum</th><th>Endate</th></tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<div  class="activityRow row">
  <div class="col-xs-12">
   <h4>2. Leden:</h4>
 </div>
</div>

<form  class="activityInsertInline activityRow form-horizontal" id="insertPlayers"  > 

  <div class="form-group">
   <div class="col-xs-12">
     <h5>Spelers toevoegen</h5>
   </div>




   <label for="inputDescription" class="col-xs-12">Selecteer geboortejaar</label>

   
   <div class="col-xs-4">
    <input type="text" class="form-control" id="inputBirthYears" placeholder="2005;2004">
  </div>
  <div class="col-xs-2">
    <button type="btn" id="btnTelSpelers" class="btn btn-default">Tel spelers</button>
  </div>
  <div class="col-xs-12">
    <p>Er zijn  <b><span id="numberPlayers"> 0 </span>  spelers</b> geselecteerd. </p>
  </div>

</div>
</form>

<div  class="activityRow row">
  <div class="col-xs-12" style="text-align:center;">
    <button type="btn" id="btnCreateDetection" class="btn btn-primary">Detectie aanmaken</button>
  </div>
</div>

</div>






@endsection


@section('footer')
@parent

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
var personenArray = [];


/*FUNCTIONS*/
function remove(rowId){
 $(rowId).remove();
}
function hide(rowId){
  $(rowId).hide(1000);
}
function show(rowId){
  $(rowId).show();
}
function checkActivityInput(){
  return true;
}


/*INIT*/




//GET DETECTIE ACTIVITIES

$.ajax({
 url: "{{URL::to('api/v1/public/activity')}}" ,
 data:{type:'DETECTIE'},
 dataType:"json"

})
.done(function( data ) {
  console.log('Total rcords:' + data.recordsTotal);
  activiteitArray=data.data;
  
});



/*EVENTS*/
$("#addActivityBtn button").on('click', function(){
  show("#insertDetection");
  hide("#addActivityBtn");
});

$('#activityNone button').on('click', function(){
  show("#activityInsert");
  hide("#activityNone");
});


$('#insertDetection').submit(function(event){
  console.log('submit pressed ok');
  /*Get variables*/
  var description = $('#inputDescription').val();
  var startDt = $('#inputStartDate').val();
  var endDt = $('#inputEndDate').val();
  var activity = {
    Description:description,
    StartDate:startDt,
    EndDate:endDt
  };
  console.log('Description =' + description + startDt + endDt);
  checkStatus = checkActivityInput();
  if (checkStatus = true){
    activiteitArray.push(activity);
    show("#addActivityBtn");
    show("#activityOverview");
    hide("#insertDetection");
    $('#activityTable').DataTable().rows.add([activity]).draw();
  }else
  {
    console.log('Error');
  }
  event.preventDefault();
});




$("#btnTelSpelers").on('click',function(event){
  var birthYears = $('#inputBirthYears').val();
  console.log('birthYears =' + birthYears);
  /*Ajax call to post api*/
  $.ajax({
    url: "{{URL::to('api/v1/private/vvbLid')}}",
    dataType:"json",
    method:"GET",
    data:{geboorteDatum:birthYears}
  })
  .done(function( data ) {
    console.log('Data:' + data.data);
    personenArray = data.data;
    $('#numberPlayers').text(data.redordsFiltered);

  });


  event.preventDefault();
});




$('#btnCreateDetection').on('click',function(event){
  //Check if all list have content
  if (personenArray.length==0 || activiteitArray.length==0){
    alert('Er zijn geen activiteiten of spelers geselecteerd!')

  } else {
    //create activities
    var activiteitIdArray=[];
    var personenIdArray=[];
    var promiseArray =[];

    var i = 0;
    var len = activiteitArray.length;
    for (; i < len; ) { 
      console.log('Aanmaken van: '+activiteitArray[i].Description);
       var promise = $.ajax({
        url: "{{URL::to('api/v1/private/activity')}}",
        dataType:"json",
        type:"post",
        data:{type:'DETECTIE', omschrijving:activiteitArray[i].Description,startDt:activiteitArray[i].StartDate,endDt:activiteitArray[i].EndDate}
      })
      .done(function( data ) {
        activiteitIdArray.push(data.data);
        console.log('Succes');
      })
      .fail(function(data){
       console.log('fail');
     });
promiseArray.push(promise);    
  i++;

    }

    //Create personen
   


   // var i = 0;
    //var len = personenArray.length;
   // for (; i < len; ) { 
//create person if not yet exists
 var promise = $.ajax({
        url: "{{URL::to('api/v1/private/person')}}",
        dataType:"json",
        type:"post",
        data:{vvbLid:jQuery.map(personenArray,function(a){return [a.Lid_nummer]})}
       // data:{vvbLid:personenArray[i].Lid_nummer}

      })
      .done(function( data ) {
        personenIdArray=data.data;
        console.log('Succes');
      })
      .fail(function(data){
       console.log('fail');
     });
      promiseArray.push(promise);
            // i++;
          // }

//add to activity _ personen tabel
 $.when.apply($, promiseArray).done(function() {
  // Handle both XHR objects
  console.log("all complete");
  var activiteit = activiteitIdArray.join(";");
$.ajax({
        url: '/api/v1/private/activity/' +activiteit+ '/person',
        dataType:"json",
        type:"post",
        data:{persoonIds:personenIdArray}
      })
      .done(function( data ) {
        
        console.log('Succes write link');
location.reload();
      })
      .fail(function(data){
       console.log('fail rite link');
     });
});





  }  

});



$(document).ready(function() {

 $("#activityTable").dataTable( {
   searching: false,
   ordering:  false,
   paging: false,
   info: false,
   data: activiteitArray,
   columns: [
   { data: 'Description' },
   { data: 'EndDate' },
   { data: 'StartDate' }
   ]
 } );
});


</script>
@stop
