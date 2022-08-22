<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PayeeStep1Request;
use App\Models\Payee;

class InvoiceController extends Controller
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
    //add payee
    public function add_payee(PayeeStep1Request $request){
        $getEmail = $request->input('email');
        $checkEmail = Payee::where('email',$getEmail)->first();
        if(!empty($checkEmail)){
            if($checkEmail->status==1){
                $data['result'] = array(
                    'key'=>200,
                    'val'=>$checkEmail,
                    'message'=>'go to step 2'
                );
                return response()->json($data,200);
            }elseif($checkEmail->status==2){
                $data['result'] = array(
                    'key'=>200,
                    'val'=>$checkEmail,
                    'message'=>'go to step 3'
                );
                return response()->json($data,200);
            }elseif($checkEmail->status==3){
                $data['result'] = array(
                    'key'=>200,
                    'val'=>'Email Already Exists'
                );
                return response()->json($data,200);
            }
        }else{
            $payee = new Payee();
            $payee->contact_name = $request->input('contact_name');
            $payee->contact_name = $request->input('phone');
            $payee->contact_name = $getEmail;
            $payee->status = 1;
            $payee->is_deleted = 0;
            $payee->save();
            $data['result'] = array(
                'key'=>200,
                'val'=>$payee,
                'message'=>'go to step 2'
            );
            return response()->json($data,200);

        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
