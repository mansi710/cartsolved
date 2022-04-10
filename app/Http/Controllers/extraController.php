<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class extraController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $user=User::all();
        $searchId=$request->searchId;
        $searchName=$request->searchName;
        $searchEmail=$request->searchEmail;

        $user=User::when($searchId,function ($query,$searchId){
            return $query->where('id',$searchId);
        })->when($searchName,function($query,$searchName){
            return $query->where('name',$searchName);
        })->when($searchEmail,function($query,$searchEmail){
            return $query->where('email',$searchEmail);

            return $query;
        });


        dump($user);

        return view('user',compact('user'));
        
        
    }
}
