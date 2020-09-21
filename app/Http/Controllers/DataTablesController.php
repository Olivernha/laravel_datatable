<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class DataTablesController extends Controller
{
    //
    public function index(){
        
        if(request()->ajax()) {
            return datatables()->of(User::with('city')->get())
            ->editColumn('name',function($user){
                return '<span class="badge badge-primary">'.$user->name .'</span>';
            })
            ->addColumn('city',function($user){
                return $user->city ? $user->city->name : '-';
            })
            ->addColumn('action',function($user){
                return '<a class="btn btn-xs btn-danger delete" data-id="'.$user->id.'">Delete</a>';
            })
            ->rawColumns(['name','action'])
            ->make(true);
        }
        return view('user');
    }
    public function destroy(User $user){
        $user->delete();
        return 'success';
    }
}
