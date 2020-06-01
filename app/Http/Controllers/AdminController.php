<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Presentation;
use App\PayCongress;
use App\UserPdfPresentation;

class AdminController extends Controller
{
    
    function profile(Request $request)
    {
        $dir = "assets/img/upload";
        $id = \Auth::user()->id;
        $png = $id.'.png';
        $jpg = $id.'.jpg';
        $file = '';
        if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
              if ('.' === $file) continue;
              if ('..' === $file) continue;
              if ($file === $jpg || $file === $png) break;
            }
            closedir($dh);
        }
        return view('common.profile')->with([
            'file' => $file,
        ]);
    }
    
    function upload(Request $request)
    {
        if($request->hasFile('file') && $request->file('file')->isValid())
        {     
            // dd($file);
            $id = \Auth::user()->id;
            $file = $request->file('file'); 
            $target = '../public/assets/img/upload';  
            $extension = $file->getClientOriginalExtension();
            $name =  $id .'.'. $extension;
            $file->move($target, $name);
        }
        return view('common.profile')->with([
            'extension' => $extension
        ]);        
    }
    
    function view($fileName)
    {
        header("Cache-Control: no-cache, must-revalidate");
        $nombre_fichero ='assets/img/upload/'.$fileName;
        $mostrar = 'default.png';
        if(file_exists($nombre_fichero))
        {
            $mostrar = $nombre_fichero;
        }
        
        return response()->file($mostrar);
    }
    
    function admin(Request $request)
    {
        $users = \DB::table('users')->paginate(3);
        
        $messages = [
            'deleted' => 'User deleted',
            'updated' => 'User updated',
            'added' => 'User added',
        ];  
        
        $opSession = $request->session()->get('op');
        
        $alertMessage = null;
        
        if(isset($messages[$opSession])) {
            $alertMessage = $messages[$opSession];
        } else {
             $alertMessage = $opSession;
        }

        return view('admin.table')->with([
            'users' => $users,
            'alertMessage' => $alertMessage
        ]);
    }
    
    function adminPresentation(){
      
        $presentations = \DB::table('presentations')->paginate(5);
        
        return view('admin.tablePresentation')->with([
            'presentations'=> $presentations
        ]);
        
    }
    function adminPays(){
       // SELECT user_pdf_presentation.iduser, users.id, users.name, user_pdf_presentation.idpresentation, presentations.id, presentations.tittle, presentations.pay, user_pdf_presentation.created_at 
       // FROM `user_pdf_presentation`, `presentations`, `users` 
       // WHERE user_pdf_presentation.iduser = users.id AND presentations.id = user_pdf_presentation.idpresentation
        // $pays = \DB::table('user_pdf_presentation')->paginate(5);
        // dd($pays);
        
        // $pays = \DB::table('user_pdf_presentation')
        //         ->join('presentations', 'presentations.id', '=', 'user_pdf_presentation.idpresentation')
        //         ->join('users', 'users.id', '=', 'user_pdf_presentation.iduser')
        //         ->distinct()
        //         ->paginate(5);
       
    //   $pays =  \DB::table('presentations')
    //                 ->join('users', 'users.id', '=', 'presentations.iduser')
    //                 ->join('user_pdf_presentation', 'user_pdf_presentation.idpresentation', '=', 'presentations.id')
    //                 ->select('users.id','user_pdf_presentation.id','user_pdf_presentation.iduser','presentations.created_at','presentations.tittle','presentations.document','presentations.pay', 'users.name')
    //                 ->paginate(5);
        // foreach ($pays as $pay) {
            
        //     $i= $pay->iduser;
            
        // }
            $usernames = UserPdfPresentation::all();
            $payCongress = PayCongress::select('id','iduser','idpresentation','document', 'created_at', 'check')
                         ->paginate(5);
        
        // $userPay = \DB::table('user_pdf_presentation')
        //           ->join('users', 'users.id', '=', 'user_pdf_presentation.iduser')
        //           ->paginate(5);
        return view('admin.tablePay')->with([
            // 'pays'=> $pays,
            'usernames' => $usernames,
            'payCongress' => $payCongress,
            // 'userPay' => $userPay,
        ]);
        
    }
    
    function checkPay($idpay)
    {
        \DB::table('pay_congresses')->where('id', $idpay)->update(['check' => 1]);
        
        return redirect()->action('AdminController@adminPays');
    }
    
    function checkNoPay($idpay)
    {
        \DB::table('pay_congresses')->where('id', $idpay)->update(['check' => 0]);
        
        return redirect()->action('AdminController@adminPays');
    }
    
    function dashboard(Request $request)
    {
         $messages = [
            'updated' => 'Pay updated',
        ];  
        
        $opSession = $request->session()->get('op');
        
        $alertMessage = null;
        
        if(isset($messages[$opSession])) {
            $alertMessage = $messages[$opSession];
        } else {
             $alertMessage = $opSession;
        }


        return view('admin.dashboard')->with([
            'alertMessage' => $alertMessage    
        ]);
    }
    function add()
    {
        return view('admin.add');
    }
    function prueba(Request $request)
    {
        return view('common.profile');
    }
    
}
