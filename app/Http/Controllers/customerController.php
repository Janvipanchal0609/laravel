<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\country;
use Illuminate\Http\Request;

use Hash;
use Session;
use Alert;

class customerController extends Controller
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

    function login()
	{
		return view('website/login'); 
	}
	
	function login_auth(Request $request)
	{
		$data=customer::where('username','=',$request->username)->first();
		if($data)
		{
			if(Hash::check($request->password,$data->password))
			{
				// session create
				session()->put('userid',$data->id);
				session()->put('name',$data->name);
				
				// use session => session('name') / // session()->get('name')
				
				Alert::success('Congrats', 'You\'ve Successfully Login');
				return redirect('/');
			}
			else
			{
				Alert::error('Failed', 'Wrong Password ');
				return redirect()->back();	
			}
		}
		else
		{
			Alert::error('Failed', 'Wrong Email ');
			return redirect()->back();
		}
		
	}
	
	function logout()
	{
		// session delete
		session()->pull('userid');
		session()->pull('name');
		Alert::success('Congrats', 'You\'ve Successfully Logout');
		return redirect('/');
		
	}
	
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data=country::all();
        return view('website/signup',['country'=>$data]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new customer;
		$data->name=$request->name;
		$data->email=$request->email;
		$data->username=$request->username;
		$data->password=Hash::make($request->password);
		$data->gen=$request->gen;
		$data->lag=implode(",",$request->lag);
		$data->mobile=$request->mobile;
		$data->cid=$request->cid;
		
		//img upload
		$file=$request->file('file');		
		$filename=time().'_img.'.$request->file('file')->getClientOriginalExtension();
		$file->move('upload/customer/',$filename);  // use move for move image in public/images		
		$data->file=$filename;
		

		$data->save();
		Alert::success('Congrats', 'You\'ve Successfully Registered');
		return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
		$data=customer::all();
        return view('admin/manage_cust',['data_customer'=>$data]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer,$id)
    {
		// get id data img
		$data=customer::find($id);  // get only one data in string 
		$filename=$data->file;
		
		// data delete with unlink image
        customer::find($id)->delete();
		if($filename!="")
		{
			unlink('upload/customer/'.$filename);
		}
		Alert::success('Congrats', 'You\'ve Successfully Deleted');
		return redirect()->back();
    }
}
