<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\InsuranceImport;
use App\insurance;
use DB;
class InsuranceController extends Controller
{
    //

    public function importExportView()
    {
       return view('excel.index');
    }


    public function importExcel(Request $request) 
    {
        \Excel::import(new InsuranceImport,$request->import_file);

        \Session::put('success', 'Your file is imported successfully in database.');
           
        return back();
    }


    public function displaydata(Request $request) 
    {
        $data=DB::table('insurances')->get();
		$visitors=[];
        $p=DB::table('insurances');

        if($request->search=="policy"){
            $p->select('policy');
        }elseif($request->search=="Location"){
            $p->select('location');
        }elseif($request->search=="region"){
            $p->select('region');
        }elseif($request->search=="businesstype"){
            $p->select('businesstype');
        }
        $field=$p->get()->toArray();
        if($request->search=="Policy"){
            $visitors = array_column($field, 'policy');
        }elseif($request->search=="Location"){
            $visitors = array_column($field, 'location');
        }elseif($request->search=="region"){
            $visitors = array_column($field, 'region');
        }elseif($request->search=="businesstype"){
            $visitors = array_column($field, 'businesstype');
        }
        if(!empty($request->search)){
        $search=$request->search;
        }else{
            $search='';
        }
        $users=DB::table('insurances')->select('insuredvalue')->get()->toArray();
        $user = array_column($users, 'insuredvalue');

        $pregionr=DB::table('insurances')->select('region')->get()->toArray();
        $region = array_column($pregionr, 'region');

        
        return view('excel.display',compact('data','visitors','user','region','search'));
    }

}
