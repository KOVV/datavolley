<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $users = DB::select('select * from tbl_activiteit where actviteit_Omschrijving = :omsch', ['omsch' => 'Detectie 2016 training 1 op 25/09 in Wetteren']);
foreach ($users as $user) {
    echo $user->name;
}
    }
}

?>