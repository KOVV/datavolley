<?php

namespace App\Http\Controllers;
use Mail;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /*
    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    /*
    public function activity()
    {
        return view('activity');
    }
    public function vvbPersonen()
    {
        return view('personen.vvbPersonen');
        //$view = View::make('template')->nest('child', 'personen.vvbPersonen');
        //return $view;
    }
    */
    public function admin()
    {
       return view('admin.home', ['name' => 'Mathias Haentjens']);
    }
     public function detectie()
    {
    //$view = view('admin.detectie.home', ['name' => 'Mathias Haentjens']);
        //return $view->renderSections()['conte'];
$activeActivities = DB::table('v_activiteit')
                //->where('activiteit_Status','=',1)
                ->where('activiteit_Type','=','DETECTIE')
                ->count();

    if($activeActivities>0)
    {
       return view('admin.detectie.detectieHome', ['name' => 'Mathias Haentjens']);
    }
    else {
         return view('admin.detectie.noActive', ['name' => 'Mathias Haentjens']);
    }



      
    }
    public function detectieDeelnemers()
    {
        return view('admin.detectie.detectieDeelnemers', ['name' => 'Mathias Haentjens']);
    }

    public function detectieToewijzen()
    {
        return view('admin.detectie.detectieToewijzen', ['name' => 'Mathias Haentjens']);
    }

    public function detectieRegistreer(request $request)
    {
        //$token = $request->input('token');
        return view('detectie.registreer');
    }

    public function detectieRegistreerSuccess()
    {
return view('detectie.success');
    }
    public function test()
    {
 Mail::send('emails.email1', ['name' => 'Mathias'], function ($m)  {
            $m->from('haentjens.mathias@datavolleybalkovv.be', 'Your Application');

            $m->to('haentjens.mathias@gmail.com', 'Mathias')->subject('Your Reminder!');
        });
    }

    public function upload(request $request){
        // getting all of the post data
  $file = $request->file('file');
  // setting up rules
 // $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
  // doing the validation, passing post data, rules and the messages
  // $validator = Validator::make($file, $rules);
  //if ($validator->fails()) {
    // send back to the page with the input data and errors
   // return Redirect::to('upload')->withInput()->withErrors($validator);
  //}
  //else {
    // checking file is valid.
    if ($file->isValid()) {
      $destinationPath = 'assets/img/spelers'; // upload path
      $extension = $file->getClientOriginalExtension(); // getting image extension
      $fileName = $file -> getClientOriginalName() ; //.'.'.$extension ; //rand(11111,99999).'.'.$extension; // renameing image
      $file->move($destinationPath, $fileName); // uploading file to given path
      // sending back with message
      //Session::flash('success', 'Upload successfully'); 
      //return Redirect::to('upload');
    }
    /*else {
      // sending back with error message.
      Session::flash('error', 'uploaded file is not valid');
      return Redirect::to('upload');
    }*/
//  }
    }
}
