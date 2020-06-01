<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presentation;
use App\User;
use App\UserPresentation;
use App\Traits\YoutubeTrait;

class SpeakerController extends Controller
{
    function speaker()
    {
        return view('speaker.add');
    }
    
    use YoutubeTrait;
    
    public function storePresentation(Request $request)
    {
        $name = '';
        
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $file = $request->file('file');
            $target = '../public/assets/img/uploadPresentation';
            $name = $file->getClientOriginalName();
            $file->move($target, $name);
        }else{
            $request->session()->flash('op', 'size');
            return redirect('/');
        }
        
       
        
        $presentation = new Presentation([
            'iduserPay' => 0,
            'tittle' => $request->get('tittle'),
            'video' => $this->get_youtube_video_ID($request->get('video')),
            'miniature' => $name,
            'description' => $request->get('description'),
            'pay' => 0,
            'document' => 'pdf',
        ]);

        $presentation->user()->associate(\Auth::user()->id);
        $presentation->push();
        
        $userPresentation = new UserPresentation(['idpresentation' => $presentation->id]);
        // $userPresentation->presentations()->match($presentation->id);
        
        $userPresentation->user()->associate(\Auth::user()->id);
        $userPresentation->push();
        
        if($presentation->save())
        {
            $request->session()->flash('op', 'success');
        }
        
        return redirect('/');
    }
    
    function presentation()
    {
         $presentations = \DB::select("SELECT * FROM presentations");
        //  $username = \DB::select("SELECT 
        //                          presentations.tittle, presentations.id, presentations.created_at, presentations.video, presentations.miniature, presentations.description, presentations.pay
        //                          FROM user_presentations");
        
          $usernames = \DB::table('users')
                        ->select('users.id', 'users.name')
                        ->join('presentations','presentations.iduser','=','users.id')
                        ->get();
                        
        //   $name = \DB::table('users')where('id',)->get();
            
        return view('speaker.all')->with([
            'presentations' => $presentations, 
            'usernames'     => $usernames,
        ]); 
    }
    
    function modify($idpresentation)
    {
    //   $presentation = Presentation::where('id', $idpresentation)->first();
         $presentation = \DB::table('presentations')->where('id', $idpresentation)->first();
       
       return view('speaker.modify')->with([
          'presentation' => $presentation,
          'idpresentation' => $idpresentation,
          
      ]); 
    }
    
    // function unsubscribe($idpresentation)
    // {
    //     $presentation = Presentation::findOrFail($idpresentation);
    //     $presentation->delete();
        
        
    //     $presentation->session()->flash('op', 'deleted');
    //     return redirect()->action('SpeakerController@presentation');
        
    // }
    
}
