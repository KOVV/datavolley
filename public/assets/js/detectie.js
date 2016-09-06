

//$('document').ready(function() {
 
console.log('ok we zijn vertrokken');
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

       $("#example").dataTable({
         searching: false,
    ordering:  false,
    paging: false,
    info: false,
//data: [{"activiteit_Aanvangdatum":"67","activiteit_Aanvangtijd":"45","activiteit_Omschrijving":"hygg"}],
        columns: [
            { data: 'activiteit_Aanvangdatum' },
            { data: 'activiteit_Aanvangtijd' },
            { data: 'activiteit_Omschrijving' }
        ]


});


$.ajax({
  url: "http://localhost:8888/api/v1/public/activity/",
  dataType:"json"
})
  .done(function( data ) {
      detectieActiviteiten = data.data;
      var detectieActiviteitenLength = detectieActiviteiten.length;
      console.log(detectieActiviteitenLength);

         var table = $('#example').DataTable();
         table.draw();

});
    



 
    var tablePesonen = $('#personen').DataTable( {
    serverSide: true,
    ajax: {
        url: 'http://localhost:8888/api/v1/private/vvbLid',
        //data:{geboorteDatum:"2005;1999"}
    
      },
        columns : [
            { "data": "Lid_Voornaam" },
            { "data": "Lid_Naam" }
        ]
    
} );

/*Voor de geboortedatums*/
$('#getPersonsByBirthdate').on( 'click', 'button', function () {

      console.log('ready?');
      $.ajax({
  method:"GET",
  url: "http://localhost:8888/api/v1/private/vvbLid",
  dataType:"json",
  data:{geboorteDatum:"2005;2004"}
})
  .done(function( data ) {
    console.log('hier?');
      console.log(data.data);
      $('#personen').DataTable().draw();

});

//})




 
  



   
  });

var detectieActiviteiten;

$.ajax({
  url: "http://localhost:8888/api/v1/public/activity?type=DETECTIE",
  dataType:"json"
})
  .done(function( data ) {
      detectieActiviteiten = data.data;
      var detectieActiviteitenLength = detectieActiviteiten.length;
      console.log(detectieActiviteitenLength);

         $("#example").DataTable().rows.add(detectieActiviteiten).draw();

});



$('#insertDetection').submit(function(event){


console.log('submit pressed ok');
/*Get variables*/
var description = $('#inputDescription').val();
var start_dt = '14/05/2016 8:00:00';
var end_dt = '14/05/2016 12:00:00';

console.log('Description =' + description)

/*Ajax call to post api*/


$.ajax({
  method:"POST",
  url: "http://localhost:8888/api/v1/private/activity",
  dataType:"json",
  data:{omschrijving:description,type:'DETECTIE'}
})
  .done(function( data ) {
      console.log(data.Status);

});

/*Redraw datatable */
$("#example").DataTable().draw();


event.preventDefault();
});
    


    
   
 /*
    $('#example tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('info');
            tablePesonen.search('Mathias').draw();
    } );   
    /*
$('#insertDetection').submit(function(event){
	window.alert('Mathias'+event);

});*/
   
  
 

