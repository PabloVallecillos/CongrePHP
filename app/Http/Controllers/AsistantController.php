<?php

namespace App\Http\Controllers;


use App\PdfDetail;
use App\UserPdfPresentation;
use App\Presentation;
use App\PayCongress;
use App\Http\Requests\CustomRequest;
use Illuminate\Http\Request;
use http\Env\Response;

class AsistantController extends Controller
{
    function asistant(Request $request)
    {
         $userPresentations = Presentation::select('id','iduserPay','iduser','tittle','created_at','video','miniature','description','pay')->distinct()->get();
        // $userPresentations = Presentation::all()->distinct()->get() ! ERROR DESCONOCIDO Method Illuminate\Database\Eloquent\Collection::distinct does not exist.;
         $iduser = \Auth::user()->id;
         
         $payCongress = PayCongress::all();
        //  $messages = [
        //     'pdfSuccess' => 'Wait for pay confirmation',
        //     'pdfError' => 'Error for pay confirmation',
        // ];  
        
        // $opSession = $request->session()->get('op');
        
        // $alertMessage = null;
        
        // if(isset($messages[$opSession])) {
        //     $alertMessage = $messages[$opSession];
        // } else {
        //      $alertMessage = $opSession;
        // }
         
        return view('asistant.all')->with([
            'payCongress' => $payCongress,
            'userPresentations' => $userPresentations, 
        ]);
        
         
        // // $userPresentations = \DB::select("SELECT DISTINCT 
        // //                                 presentations.tittle, presentations.id, presentations.created_at, presentations.video, presentations.miniature, presentations.description, presentations.pay
        // //                                 FROM presentations");
        // // INTENTAR ELOQUENT 
        // // distint eloquent 
        
        // // $userPresentations = Presentation::all();
        // // $userPresentations = Presentation::all()->unique('tittle','id','created_at','video','miniature','description','pay'); no muestra todas las presentationes
        // $userPresentations = Presentation::select('tittle','id','created_at','video','miniature','description','pay')->distinct()->get();
        // // $userPresentations = Presentation::all()->distinct()->get() ! ERROR DESCONOCIDO Method Illuminate\Database\Eloquent\Collection::distinct does not exist.;

        // return view('asistant.all')->with([
        //     'userPresentations' => $userPresentations, 
        // ]);
    }
    
    function pdfOtherPage(Request $request)
    {
        $id = \Auth::user()->id;
        $name = \Auth::user()->name;
        $user = \DB::table('pdf_details')->where('first_name', \Session::get('nameUser'))->first();
        $presentation = \DB::table('presentations')->where('id', \Session::get('idpresentation'))->first();
        $pdf = \PDF::loadView('asistant.pdf', compact('user','presentation'));
        
        $document = $name.'_'.$presentation->tittle.'.pdf';
        $payCongress = new PayCongress([
            'iduser' => $id,
            'idpresentation' => \Session::get('idpresentation'),
            'document' => $document,
            'check' => 0,
        ]);
        $payCongress->save();
        
        return $pdf->download($document);
    }
    
    function uploadPay(Request $request, $idpresentation){
        $name = '';
        $id = \Auth::user()->id;
        // $presentation = Presentation::where('id', $idpresentation)->first();
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $file = $request->file('file');
            $target = '../public/assets/pdf/'.$id;
            $name = $file->getClientOriginalName();
            $file->move($target, $name);
            \DB::table('presentations')->where('id', $idpresentation)->update(['document' => $name, 'pay' => 3]);
            return redirect()->action('AsistantController@asistant');
        }else{
            $request->session()->flash('op', 'size');
            return redirect('/');
        }
        
    }
    
    function subscribe($id)
    {
        $iduser = \Auth::user()->id;
        $presentations = \DB::table('presentations')->where('id', $id)->update(['iduserPay' => $iduser]);
        $presentations = \DB::table('presentations')->where('id', $id)->get();
        
        
        return view('asistant.subscribe')->with([
            'presentations' => $presentations
        ]);
    }
    
    function pdf(CustomRequest $request, $idpresentation)
    {
      $id = \Auth::user()->id;
      $pdf = new PdfDetail([
        'iduser' => $id,
        'first_name' => $request->get('first_name'),
        'last_name' => $request->get('last_name'),
        'card' => $request->get('card'),
        'email' => $request->get('email'),
        'phone' => $request->get('phone')
      ]);
      
      $pdf->save();
      $userPdf = new UserPdfPresentation([
            'iduser' => $id,
            'idpresentation' => $idpresentation
      ]);
      $userPdf->save();
      
      \Session::flash('download.in.the.next.request', 'Certificate.pdf');
      \Session::put('idpresentation', $idpresentation);
      \Session::put('nameUser', $request->get('first_name'));
      Presentation::whereId($idpresentation)->update(['pay' => 2]);
      $user = \DB::table('pdf_details')->where('first_name', $request->get('first_name'))->first();
      $presentation = \DB::table('presentations')->where('id', $idpresentation)->first();
      
      return redirect()->action('AsistantController@asistant');
    
    
    
    //   return view('/'); 
    //   \Session::flash('download.in.the.next.request', 'Certificate.pdf');
    // https://stackoverflow.com/questions/25624927/how-do-i-redirect-after-download-in-laravel
    }

    function video($id)
    {
        $presentation = \DB::table('presentations')->where('id', $id)->first();
        
        return view('asistant.view')->with([
            'presentation' => $presentation
        ]);
    }
    
    function pdf2($idpresentation)
    {
        $id = \Auth::user()->id;
        $user = \DB::table('users')->where('id', $id)->first();
        
        $presentation = \DB::table('presentations')->where('id', $idpresentation)->first();
        
        $pdf = \PDF::loadView('asistant.pdf2', compact('user','presentation'));
        return $pdf->download('Certificate.pdf');
    }
}
