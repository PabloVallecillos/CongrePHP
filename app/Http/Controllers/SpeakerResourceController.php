<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presentation;
use App\UserPresentation;
use App\UserPdfPresentation;
use App\Traits\YoutubeTrait;

class SpeakerResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpeakerResource  $speakerResource
     * @return \Illuminate\Http\Response
     */
    public function show(SpeakerResource $speakerResource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpeakerResource  $speakerResource
     * @return \Illuminate\Http\Response
     */
    
    use YoutubeTrait;
    
    public function editPresentation(Request $request, $idpresentation)
    {
        $name = '';
        
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $file = $request->file('file');
            $target = '../public/assets/img/uploadPresentation';
            $name = $file->getClientOriginalName();
            $file->move($target, $name);
        }else{
            $PresentationName = \DB::table('presentations')->where('id', $idpresentation)->first();
            $name = $PresentationName->miniature;
        }
        
        // 1 forma no fufa Eloquent
        
        // $Presentation               = Presentation::where('id', $idpresentation)->first();
        // $Presentation->tittle       = $request->get('tittle');
        // $Presentation->video        = $this->get_youtube_video_ID($request->get('video'));
        // $Presentation->miniature    = $name;
        // $Presentation->description  = $request->get('description');
        // $Presentation->pay          = 0;
        // $Presentation->save();
        
        $namePresentation           = $request->get('tittle');
        
        $form_data = [
            'tittle'        => $request->get('tittle'),
            'video'         => $this->get_youtube_video_ID($request->get('video')),
            'miniature'     => $name,
            'description'   => $request->get('description'),
            'pay'           => 0,
        ];
        \DB::table('presentations')->where('id', $idpresentation)->update($form_data);
       
        $request->session()->flash('op', 'Presentation Updated ' . $namePresentation);
        
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpeakerResource  $speakerResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpeakerResource $speakerResource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpeakerResource  $speakerResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idpresentation)
    {
        // $userPresentation = UserPresentation::where('idpresentation', $idpresentation)->update('deleted_at' = now());
        // $Presentation = Presentation::where('id', $idpresentation)->delete();
        // $dataName = Presentation::where('id', $idpresentation)->first()->tittle;
        
        
        // $userPresentationPdf = UserPdfPresentation::where('idpresentation', $idpresentation)->first();
        // $userPresentationPdf->delete();
        // $userPresentation->delete();
        
        // $Presentation = Presentation::where('id', $idpresentation)->pluck('id');
        // UserPresentation::whereId('idpresentation', $idpresentation)->delete();
        // Presentation::where('id', $idpresentation)->delete();
        
        
         \DB::table('user_presentations')->where('idpresentation', $idpresentation)->delete();
         \DB::table('pay_congresses')->where('idpresentation', $idpresentation)->delete();
         \DB::table('user_pdf_presentation')->where('idpresentation', $idpresentation)->delete();
        //  $name = \DB::table('presentations')->where('id', $idpresentation)->get();
         \DB::table('presentations')->where('id', $idpresentation)->delete();
         
        // 1 forma no fufa Eloquent
        
        // $userPresentation = UserPresentation::find($idpresentation);
        // $userPresentation->delete();
        
        // $Presentation = Presentation::findOrFail($idpresentation);
        
        // $userPresentationPdf = UserPdfPresentation::find($idpresentation);
        // if($Presentation->pay === 1)
        // {
        //     $userPresentationPdf->delete();
        // }
        
        // $Presentation->delete();
        
        $request->session()->flash('op', 'Presentation deleted ');
        
        return redirect('/');
    }
}
