<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(Request $request)
    {
        if(\Auth::check()){
            $name = \Auth::user()->name;
        }else {
            $name = '';
        }
        $messages = [
            'logged' => 'Welcome ' . $name,
            'verified' => 'Verified user can log in now',
            'registered' => 'Registered, ' . $name . ' , we sent an email.',
            'passwordreset' => 'Password has been reseat',
            'success' => 'Presentation created successfully',
            'size' => 'The file uploaded exceeds upload_max_filesize',
            'pdfSuccess' => 'Wait for pay confirmation',
            'pdfError' => 'Error for pay confirmation',
        ];  
        
        $opSession = $request->session()->get('op');
        
        $alertMessage = null;
        
        if(isset($messages[$opSession])) {
            $alertMessage = $messages[$opSession];
        } else {
             $alertMessage = $opSession;
        }

        return view('welcome')->with([
            'alertMessage' => $alertMessage, 
        ]);
    }
    
    public function correo()
    {
        $destinatario = 'vallecillostyler@gmail.com';
        $correo = new \App\Mail\InformationEmail();
        $correo->setSubject('Saludos');
        \Mail::to($destinatario)->send($correo);
    }
    
    
}
