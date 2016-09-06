<?php
namespace App\Http\Controllers;


use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PersonController extends Controller{

	
	public function showVvbLid(Request $request)
	{

        try {
          $where = array();

          $search = $request->input('search');
          $draw = $request->input('draw');

          if (!empty($search['value'])){
              array_push($where, ['Lid_Voornaam','like','%'.$search['value'].'%']);
          }
          $query = DB::table('tbl_LedenOostVlaanderen');
          $totalCount = $query->count();
          $query
          ->select('Lid_nummer','Lid_Voornaam','Lid_Naam','Club_stamnummer','Lid_Geboortedatum')
          ->where($where);

          /*Geboortedatum*/
          $birthdate = $request->input('geboorteDatum');

          if (!empty($birthdate)){

           $query->where(
               function($query) use ($birthdate)
               {

                   $query->where('Club_Stamnummer','like','O-%');
                   $birthdateArray = explode(";",$birthdate);
                   //foreach($birthdateArray as $birthday){
                    $query->whereIn(DB::raw('year(Lid_Geboortedatum)'),$birthdateArray);
                //}
                return $query;
            }
            );
       }
       $count = $query->count();
       $users = $query->get();





       return response()->json( array("draw"=>(int)$draw,"recordsTotal"=>$totalCount,"redordsFiltered"=>$count,"status"=>"Succes","data"=>$users));


   } catch (Exception $e) {     
    return $app->json(array("status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
}  
}

public function updatePerson(Request $request, $tokenId,$personId){

try
{
//CHECK TOKEN
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


            

            $this->validate($request, [
        'persoon_Postcode' => 'required|digits:4',
        'persoon_Straat' => 'required',
                'persoon_HuisNr' => 'required',
        'persoon_Gemeente' => 'required',
        'persoon_Telefoon' => 'required|min:8',
                'persoon_Ouder1' => 'required',
        'persoon_Ouder1_Email' => 'required|email',
        'persoon_Ouder1_Telefoon' => 'required|min:8',
        'persoon_ouder2' => 'required_with:persoon_Ouder2_Email,persoon_Ouder2_Telefoon',
        'persoon_Ouder2_Email' => 'email',
        'persoon_Ouder2_Telefoon' => 'min:8',




    ]);

DB::table('tbl_persoon')
            ->where('persoon_id', $personId)
            ->update(['persoon_Straat' =>  $request->input('persoon_Straat'),
              'persoon_HuisNr'=>$request->input('persoon_HuisNr'),
'persoon_Postcode'=>$request->input('persoon_Postcode'),
'persoon_Gemeente'=>$request->input('persoon_Gemeente'),
//'persoon_GeboorteDatum'=>$request->input('persoon_GeboorteDatum'),
'persoon_Telefoon'=>$request->input('persoon_Telefoon'),
'persoon_Email' =>$request->input('persoon_Ouder1_Email'), 
'persoon_Ouder1'=>$request->input('persoon_Ouder1'),
'persoon_ouder2'=>$request->input('persoon_ouder2'),
'persoon_Ouder2_Email'=>$request->input('persoon_Ouder2_Email'),
'persoon_Ouder2_Telefoon'=>$request->input('persoon_Ouder2_Telefoon'),
'persoon_Ouder1_Email'=>$request->input('persoon_Ouder1_Email'),
'persoon_Ouder1_Telefoon'=>$request->input('persoon_Ouder1_Telefoon')
              ]);


        return response()->json( array("status"=>"Succes","data"=>$personId));

         } else
         {
          return response()->json( (array("status"=>"Succes","data"=>"Token not valid")));

         }



} catch (Exception $e) 
{
 return $app->json(array("status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
}
   

}

public function updatePerson1(Request $request, $personId){

try
{


$updateArray = [];
if (!empty($request->input('persoon_Image'))){

    DB::table('tbl_persoon')
            ->where('persoon_id', $personId)
->update(['persoon_Image' =>  $request->input('persoon_Image')]);
}
            



        return response()->json( array("status"=>"Succes","data"=>$personId));

      



} catch (Exception $e) 
{
 return $app->json(array("status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
}
   

}



public function writePerson(Request $request){
  try{
    $vvbLidArray = array();
    $vvbLidArray = $request->input('vvbLid'); 
    
  //  if (!empty($vvbLid)) {

      $persoonArray = array();

foreach ($vvbLidArray as $vvbLid) {

$token= base_convert(microtime(false), 10, 36); // md5(uniqid(rand(), true));
        $data = DB::table('tbl_LedenOostVlaanderen')
        ->select(
          'Club_Stamnummer',
          'Lid_Nummer',
          'Lid_Naam',
          'Lid_Voornaam',
          'Lid_Straat',
          'Lid_Huisnummer',
          'Lid_Postcode',
          'Lid_Gemeente',
          'Lid_Land',
          'Lid_Geslacht',
          'Lid_Geboortedatum',
          'Lid_Speler',
          'Lid_Telefoon',
          'Lid_Telefoon2',
          'Lid_email',
          'Lid_email2',
          'Lid_GSM',
          'Lid_GSM2'
                    )
          
          ->where('Lid_Nummer','=',$vvbLid )->get();

        $email = "" ;
        $emailOuder1 = "";
        $emailOuder2 = "";
        $ouder1 ="";
        $ouder2 = "";




        if (empty($data[0]-> Lid_email)){
          $email = $data[0]-> Lid_email2;
          $emailOuder1 = $data[0]-> Lid_email2;
          $ouder1 = $data[0]-> Lid_email2;

        }  else {
          $email = $data[0]-> Lid_email;
          $ouder1 = $data[0]-> Lid_email;
          $emailOuder1= $data[0]-> Lid_email;
          $emailOuder2= $data[0]-> Lid_email2;
          $ouder2 = $data[0]-> Lid_email2;
        }


        $tel = "";
        $telOuder1 ="";
        $telOuder2 = "";


        if (empty($data[0]-> Lid_Telefoon)) {
          if (empty($data[0]-> Lid_Telefoon2)) {
            if (empty($data[0]-> Lid_GSM)) {
              $tel=$data[0]-> Lid_GSM2;
              $telOuder1= $data[0]-> Lid_GSM2;
            } else{
              $tel=$data[0]-> Lid_GSM;
              $telOuder1= $data[0]-> Lid_GSM;
              $telOuder2= $data[0]-> Lid_GSM2;
            }

          }else {
            $tel=$data[0]-> Lid_Telefoon2;
            if (empty($data[0]-> Lid_GSM)) 
            { 
              $telOuder1= $data[0]-> Lid_GSM2;
            } else{
              $telOuder1= $data[0]-> Lid_GSM;
              $telOuder2= $data[0]-> Lid_GSM2;
            }
            
          }
        } else {
         $tel=$data[0]-> Lid_Telefoon;
         if (empty($data[0]-> Lid_Telefoon2)) {
          if (empty($data[0]-> Lid_GSM)) {
            $tel=$data[0]-> Lid_GSM2;
            $telOuder1= $data[0]-> Lid_GSM2;
          } else{
            $telOuder1= $data[0]-> Lid_GSM;
            $telOuder2= $data[0]-> Lid_GSM2;
          }

        } else {
          $telOuder1=$data[0]-> Lid_Telefoon2;
          if (empty($data[0]-> Lid_GSM)) { 
            $telOuder2= $data[0]-> Lid_GSM2;
          } else{
            $telOuder2= $data[0]-> Lid_GSM;
          }

        }

      }

        $gender = "";
        switch (strtoupper($data[0]-> Lid_Geslacht)) {
          case 'VROUW':
            $gender='V';
            break;
          case 'MAN':
            $gender = 'M';
              break;
          
        }


        $userid = DB::table('tbl_persoon')->select('persoon_id','persoon_token')->where('lid_nummer','=',$vvbLid)->get();

        if(!empty($userid)){
                array_push($persoonArray,['vvbLid'=>$vvbLid, 'id'=>$userid[0]->persoon_id,'token'=>$userid[0]->persoon_token]);

        }else
        {

        $userId = DB::table('tbl_persoon')->insertGetId(
          [
            'lid_nummer' => $vvbLid,
            'persoon_Voornaam' =>$data[0]-> Lid_Voornaam,
            'persoon_Achternaam'=>$data[0]-> Lid_Naam,
            'persoon_Geslacht'=> $gender,
            'persoon_Straat'=>$data[0]-> Lid_Straat,
            'persoon_HuisNr'=>$data[0]-> Lid_Huisnummer,
            'persoon_Postcode'=>$data[0]-> Lid_Postcode,
            'persoon_Gemeente'=>$data[0]-> Lid_Gemeente,
            'persoon_Telefoon'=>$tel,
            'persoon_Email'=> $email,
            'persoon_ouder1'=>$ouder1,
            'persoon_ouder2'=>$ouder2,
            'persoon_Ouder1_Email'=>$emailOuder1,
            'persoon_Ouder2_Email'=>$emailOuder2,
            'persoon_Ouder1_Telefoon'=>$telOuder1,
            'persoon_Ouder2_Telefoon'=>$telOuder2,
            'persoon_Club'=>$data[0]-> Club_Stamnummer,
            'persoon_GeboorteDatum'=>$data[0]-> Lid_Geboortedatum,
            'persoon_CreationDate'=>DB::raw('now()'),
            'persoon_token'=> $token,
            'persoon_Activated'=>0
          ]
          );


        array_push($persoonArray,['vvbLid'=>$vvbLid, 'id'=>$userId,'token'=>$token]);
}
}


        return response()->json( array("status"=>"Succes","data"=>$persoonArray));


  } catch (Exception $e) {

    return $app->json(array("status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);

  }

}

public function getPerson(Request $request, $tokenId=null)
{
    try {
        $resultPerson = null;
        $result = null;
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


            

                if ($valid==1){
                    $query = DB::table('tbl_persoon');
                    $query
                    ->select('persoon_id','persoon_Voornaam','persoon_token')
                    ->where('persoon_token','=',$tokenId);
                    $resultPerson = $query->get();

                    return response()->json( (array("status"=>"Succes","test"=>$result, "data"=>$resultPerson)));
                }
                else
                {
                    // token not valid
                    return response()->json( (array("status"=>"Error","data"=>null,"message"=>"Token not valid")));
                }

            }
            else
            {
                return response()->json( (array("status"=>"Succes","data"=>"Token not valid")));

            }


}



            return response()->json( (array("Status"=>"Succes","data"=>$result)));


        }
  


    

    catch (Exception $e) {
        return response()->json (array("Status"=>"Error","data"=>null,"Message"=>$e->getMessage()), 412);
    }
    
    

}
}





