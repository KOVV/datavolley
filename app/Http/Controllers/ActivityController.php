<?php
namespace App\Http\Controllers;


use DB;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivityController extends Controller{


    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function showActivity(Request $request, $activityId=null)
    {
		//Check for all possible paramters. Are the allowed
    	try{


    		$where = array();
    		$type = $request->input('type');
    		if (!empty($type)){
    			array_push($where, ['activiteit_type','=',$type]);
    		}


    		if (!empty($activityId)) {
    			array_push($where, ['activiteit_id','=',$activityId]);
    		}



    		$query = DB::table('v_activiteit')
    		->where($where);
    		$users = $query->get();
    		$totalCount = $query->count();
    		return response()->json( (array("status"=>"Succes","recordsTotal"=>$totalCount,"data"=>$users)));

    	}
    	catch (Exception $e) {
    		return view('test', ['output' => json_encode(array("status"=>"Error","data"=>null,"message"=>$e->getMessage()))]);
    	}

    }

    public function writeActivity(Request $request)
    {
    	try {
		// Vars

    		$input = $request->all();
    		if ($input['type']= 'DETECTIE'){
    			$actGroepId = 1;
    		} else {
    			$actGroepId = 2;
    		}
    		$id = DB::table('tbl_activiteit')->insertGetId(
    			[
    			'actviteit_omschrijving' => $input['omschrijving'], 
    			'actGroepId' => $actGroepId,
    			'activiteit_aanvangdatum'=> $input['startDt'],
    			'activiteit_eindedatum'=>$input['endDt'], 
    			'activiteit_aanvangtijd'=> $input['startDt'],
    			'activiteit_eindetijd'=>$input['endDt'], 
    			'activiteit_status' => 2
    			]
    			);
    		return response()->json( (array("status"=>"Succes","data"=>$id)));

    	} catch (Exception $e) {
    		return response()->json( array("Status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
    	}
    }


    public function writeActivityPerson(Request $request, $activityIds=null )
    {
    	try {
    		$activityIdsArray = array();
    		$activityIdsArray = explode(";",$activityIds);

    		$personIdsArray = array();
    		$personIdsArray = $request->input('persoonIds');

    		$table = DB::table('tbl_act_persoon');
    		$tableToken = DB::table('tbl_token');

    		

    		//GET MAX OF ACTIVITY DATES
    		$activityMaxDate = DB::table('tbl_activiteit')->whereIn('activiteit_ID',$activityIdsArray)->max('activiteit_eindedatum');

    		
    			foreach ($personIdsArray as $personId) {
    				foreach ($activityIdsArray as $activityId)
    		{

    				$table->insert(





                        
    					['activiteit_ID' => $activityId,'Lid_nummer'=>$personId["vvbLid"],'persoon_id'=> $personId["id"], 'act_Reserve'=>0,'act_Persoon_PersAanwezig'=>0]
    					);
    			}
    		$tableToken->insert(['token'=>$personId['token'],'type'=>'PERIOD','valid_from'=>DB::raw('now()'),'valid_untill'=>$activityMaxDate,'validated'=>0]);

    		}
    	
    		
    		return response()->json( (array( "status"=>"Succes","data"=>null)));

    	}

    	catch (Exception $e) {
    		return response()->json( array("Status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
    	}
    }

public function readActivityPerson(Request $request, $activityIds=null )
    {
        try {
            $activityIdsArray = array();
            $activityIdsArray = explode(";",$activityIds);

            

            $data = DB::table('v_activiteit_persoon')
            ->select('Lid_Nummer', 'persoon_token', 'persoon_id','persoon_Voornaam', 'persoon_Achternaam', 'persoon_Geslacht','has_email', 'club', 
                'persoon_GeboorteDatum',DB::raw('max(act_Persoon_PersAanwezig) as aanwezigheidsstatus' ))
            ->groupBy('persoon_token', 'persoon_id','persoon_Voornaam', 'persoon_Achternaam', 'persoon_Geslacht','has_email', 'club', 'persoon_GeboorteDatum')
            ->whereIn('activiteit_ID',$activityIdsArray)->get();
           
            return response()->json( (array( "status"=>"Succes","data"=>$data)));

        }

        catch (Exception $e) {
            return response()->json( array("Status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
        }
    }




public function readActivityPersonToken(request $request, $tokenId, $activityIds){

    try {
            $activityIdsArray = array();
            $activityIdsArray = explode(";",$activityIds);

            

            $data = DB::table('v_activiteit_persoon')
            ->select('persoon_token', 'persoon_id','persoon_Voornaam', 'persoon_Achternaam', 'persoon_Geslacht','has_email', 'club', 
                'persoon_GeboorteDatum','persoon_Straat', 'persoon_HuisNr', 'persoon_Postcode', 'persoon_Gemeente', 'persoon_Telefoon', 'persoon_Email', 
 'persoon_Activated', 'lid_nummer',  'persoon_Ouder1_Email', 'persoon_Ouder1_Email','persoon_Ouder1_Telefoon','persoon_Ouder2_Telefoon','persoon_ouder1', 'persoon_ouder2', 
                DB::raw('max(act_Persoon_PersAanwezig) as aanwezigheidsstatus' ))
            ->where('persoon_token','=',$tokenId)
            ->whereIn('activiteit_ID',$activityIdsArray)
            ->groupBy('persoon_token','persoon_id','persoon_Voornaam', 'persoon_Achternaam', 'persoon_Geslacht','has_email', 'club', 'persoon_GeboorteDatum',
                'persoon_Straat', 'persoon_HuisNr', 'persoon_Postcode', 'persoon_Gemeente', 'persoon_Telefoon', 'persoon_Email', 
 'persoon_Activated', 'lid_nummer', 'persoon_Ouder1_Email', 'persoon_Ouder1_Email','persoon_Ouder1_Telefoon','persoon_Ouder2_Telefoon','persoon_ouder1', 'persoon_ouder2')
            
            ->get();
           
            return response()->json( (array( "status"=>"Succes", "data"=>$data)));

        }

        catch (Exception $e) {
            return response()->json( array("Status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
        }

}

public function updateActivityPersonToken(request $request, $tokenId, $activityId,$persoonId){

    try {
// check token
         $valid = 0;
        if (!empty($tokenId)){
                //check token
            $query = DB::table('tbl_token');
            $query->select('token','type','valid_from','valid_untill','validated');
            $query->where('token','=',$tokenId);
            $result = $query->get();

            $valid = 1;
            if(!empty($result))
            {
    
                if ($result[0]->type=="PERIOD") {
                   
                   //Check periode
                    $valid = 1;
                }
                elseif ($result[0]->type =="SINGLE") {
                    $valid = 1;
                }else
                {
                    $valid = 0;
                }


}}


         if($valid == 1) {
            
          
// validate activityId

            
                  $actPersStatus = $request->input('actPersonStatus');

// Get person id
         $data = DB::table('tbl_persoon')
            ->select('persoon_id')
            ->where('persoon_token','=',$tokenId)
            
            ->get();

DB::table('tbl_act_persoon')
            ->where('persoon_id', $persoonId)
            -> where('activiteit_ID', $activityId)
            ->update(['act_Persoon_PersAanwezig' => $actPersStatus]);




           
            return response()->json( (array( "status"=>"Succes")));

         } else {
                            return response()->json( (array("status"=>"Succes","data"=>"Token not valid")));

         }

           


}

        catch (Exception $e) {
            return response()->json( array("Status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
        }
}


public function updateActivityPerson(Request $request, $activityId, $persoonId){

    try {



DB::table('tbl_act_persoon')
            ->where('persoon_id', $persoonId)
            -> where('activiteit_ID', $activityId)
            ->update(['act_Persoon_TrAanwezig' => $request->input('aanwezigheidsStatus'),
                'act_persoon_Volgnummer' => $request->input('volgNummer')
                ]);




           
            return response()->json( (array( "status"=>"Succes")));

        

           


}

        catch (Exception $e) {
            return response()->json( array("Status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
        }
}

}


