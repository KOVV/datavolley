

@extends('admin.template')

@section('title', '- detectie')

@section('head')
@parent

@stop

@section('menuDetectie')
<li class="sub-menu dcjq-current-parent">
                      <a  href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Detectie</span>
                      </a>
                      <ul class="sub">
                                                  <li class=""><a  href={{ URL::asset('admin/detectie/')}}>Overview</a></li>

                          <li><a  href={{ URL::asset('admin/detectie/deelnemers')}}>Deelnemers</a></li>
                          <li class="active"><a  href={{ URL::asset('admin/detectie/toewijzen')}}>Toewijzen</a></li>
                      </ul>
                  </li>
@endSection

@section('content')

    <div class="row">

    	<div class="col-md-6">
<h3>NOG TE ONTWIKKELEN</h3>			
							</div>
        
      

</div>
@endsection

@section('footer')
@parent
<script>
$(document).ready(function() {

$("#example").dataTable({
         searching: false,
    ordering:  false,
    paging: false,
    info: false,
    ajax: {
        url: "{{URL::to('api/v1/public/activity')}}",
        data:{type:'DETECTIE'},
  dataType:"json"
    
      },
//data: [{"activiteit_Aanvangdatum":"67","activiteit_Aanvangtijd":"45","activiteit_Omschrijving":"hygg"}],
        columns: [
            { data: 'activiteit_Aanvangdatum' },
            { data: 'activiteit_Aanvangtijd' },
            { data: 'activiteit_Omschrijving' }
        ]


});




});

</script>
@stop