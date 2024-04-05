<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company = $request->company;
        $search = $request->search;
        $roleID = $request->roleID;
        $userID = $request->userID;

        $data = Transaction::join('companies','transactions.company_id','companies.id')
                ->join('cars','transactions.car_id','cars.id')
                ->join('users','transactions.user_id','users.id')
                ->when($roleID == 2,function($r) use ($userID){
                    return $r->where('transactions.user_id',$userID);
                })
                ->when(isset($request->company),function($q) use ($company){
                    return $q->where('transactions.company_id',$company);
                })
                ->when($search != null,function($w) use ($search){
                    return $w->where('plate_number','LIKE','%'.$search.'%')
                    ->orWhere('engine_number','LIKE','%'.$search.'%')
                    ->orWhere('companies.name','LIKE','%'.$search.'%')
                    ->orWhere('cars.name','LIKE','%'.$search.'%')
                    ->orWhere('users.first_name','LIKE','%'.$search.'%')
                    ->orWhere('users.last_name','LIKE','%'.$search.'%');
                })
                ->where('users.deleted_at',null)->get();

        return TransactionResource::collection($data);
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
        $data = Transaction::where('user_id',$id)->get();

        return $data;

        return TransactionResource::collection($data);
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
