<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function __construct()
    {
        // $this->middleware('verified');
        // $this->middleware('verified')->only('store', '');
        // $thiss->middleware('verified')->except('store');
    }
    
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
        $data = $request->all();
        $user = new User($data);
        $user->email_verified_at = now();
        $user->password = 'password';
        $user->type = $request->get('type');;
        $user->save();
        $request->session()->flash('op', 'added');
        return redirect()->action('AdminController@admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        
        return view('admin.edit')->with([
            // 'alertMessage' => $alertMessage,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name'          =>  'required',
            'type'          =>  'required',
            'email'         =>  'required'
        );

        $error = \Validator::make($request->all(), $rules);
        
        $users = User::all();
         $alertMessage = 'Data Error'; 
        if($error->fails())
        {
             return view('admin.table')->with([
                'alertMessage' => $alertMessage,
                'users' => $users,
             ]);
        }
        
        $form_data = array(
            'name'    =>  $request->name,
            'type'     =>  $request->type,
            'email'     =>  $request->email,
        );
        $request->session()->flash('op', 'updated');
        User::whereId($id)->update($form_data);

        return redirect()->action('AdminController@admin');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        
        
        $request->session()->flash('op', 'deleted');
        return redirect()->action('AdminController@admin');
    }
}
