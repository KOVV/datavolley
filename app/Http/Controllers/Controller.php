<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


 /**
     * Validate token
     *
     * @param  string  $tokenId
     * @return object valid (0 = not valid / 1 = valid) - reason ('Token doesn't exist / 'Token not valid anymore' / 'Token already used')
     */
    public function validateToken($tokenId)
    {


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

}
return $valid;
}

}


