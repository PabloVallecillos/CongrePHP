<?php

namespace App\Http\Controllers;

use App\UserPdfPresentation;
use App\PayCongress;
use App\User;
use Illuminate\Http\Request;

class PayResourceController extends Controller
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
     * @param  \App\PayResource  $payResource
     * @return \Illuminate\Http\Response
     */
    public function show(PayResource $payResource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayResource  $payResource
     * @return \Illuminate\Http\Response
     */
    public function editPay(Request $request, $idpay)
    {
        $data = PayCongress::all();
        $data2 = PayCongress::find($idpay);
        
        // $dataUser = UserPdfPresentation::all();
        
        // SELECT DISTINCT user_pdf_presentation.iduser, users.name FROM `user_pdf_presentation`, `users` WHERE user_pdf_presentation.iduser = users.id
        
        // $usernames =  \DB::table('user_pdf_presentation')
        //                 ->join('users', 'users.id', '=', 'user_pdf_presentation.iduser')
        //                 ->select('users.name','user_pdf_presentation.iduser')
        //                 ->distinct()
        //                 ->get();
                        
        // $presentations =  \DB::table('pay_congresses')
        //                 ->join('presentations', 'presentations.id', '=', 'pay_congresses.idpresentation')
        //                 ->select('presentations.tittle','pay_congresses.idpresentation')
        //                 ->distinct()
        //                 ->get();
        
        return view('admin.editPay')->with([
            'data' => $data,
            'data2' => $data2,
            // 'presentations' => $presentations,    
            // 'usernames' => $usernames,
        ]);
    }
    
    function updatePay(Request $request, $idpay) {
        $idUser = $request->typeUser;
        $userId = \DB::table('users')->where('name', $idUser)->first();
        $idPresentation = $request->typePresentation;
        $presentationId = \DB::table('presentations')->where('tittle', $idPresentation)->first();
        
        $form_data = array(
            'iduser'             =>  $userId->id,
            'idpresentation'     =>  $presentationId->id,
        );
        
        PayCongress::whereId($idpay)->update($form_data);
        $request->session()->flash('op', 'updated');
        return redirect()->action('AdminController@dashboard');
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayResource  $payResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayResource $payResource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayResource  $payResource
     * @return \Illuminate\Http\Response
     */
    public function destroyPay(Request $request, $idpay)
    {
        //
    }
}
