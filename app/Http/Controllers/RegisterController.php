<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
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
        User::insert([
            'username' => $request->UserName,
            'password' => Hash::make($request->Password),
            'first_name' => $request->FirstName,
            'last_name' => $request->LastName,
            'sex' => $request->Sex,
            'role_id' => $request->Role,
            'created_at' => date('Y/m/d H:i:s', strtotime('+8 hours')),
            'updated_at' => date('Y/m/d H:i:s', strtotime('+8 hours')),
            'updated_by' => 'Admin',
        ]);

        $user_id = User::select('id')->find(DB::table('users')->max('id'));

        if(isset($request->Company)){
            Transaction::insert([
                'user_id' => $user_id->id,
                'company_id' => $request->Company,
                'car_id' => $request->Car,
                'plate_number' => $request->PlateNumber,
                'engine_number' => $request->EngineNumber,
                'fuel_id' => $request->FuelType,
                'body_id' => $request->BodyType,
                'created_at' => date('Y/m/d H:i:s', strtotime('+8 hours')),
                'updated_at' => date('Y/m/d H:i:s', strtotime('+8 hours')),
                'updated_by' => 'Admin',
            ]);
        }

        return 'Success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('username',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
        User::where('username',$id)->update(['password' => Hash::make($request->password)]);

        return 'Success';
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
        User::where('id',$request->UserID)->update([
            'first_name' => $request->FirstName,
            'last_name' => $request->LastName,
            'deleted_at' => $request->Delete == true ? date('Y/m/d H:i:s', strtotime('+8 hours')) : null
        ]);

        return 'Success';
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
