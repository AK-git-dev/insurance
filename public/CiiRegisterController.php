<?php

namespace App\Http\Controllers;

use App\Models\ArticleImage;
use App\Models\BookCaseStudy;
use App\Models\ProfileArticle;
use App\Models\TitleArticleMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Session;
class CiiRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$tdetail=Session('tdetail');
        if(Session::has('paginate')){
      $paginate = Session::get('paginate');
      } else{
      $paginate = 10;
      }
    if (null !==(request('pagination'))){
      $paginate = request('pagination');
      Session::put('paginate', $paginate);
    }
$searchText="";
if (null !==(request('search_text'))){
$searchText = request('search_text');
 }
        $registerData=DB::table($tdetail['cii_registration_form'].' as rf')
          ->leftjoin($tdetail['category_classification'].' as cc', 'rf.category_classification','=','cc.id')->orderBy('rf.created_at','desc')->paginate($paginate);
        return view('frontpage.registerpage', compact('registerData'));
    }


public function registerpage(){
	return view('frontpage.award_registerpage');
}

  public function storedata(Request $request){


    	$tdetail=Session('tdetail');
    	$data=$request->all();

      $msmenewname = '';

      if(isset($request->msme)) { 
        $image = $request->msme;
          $msmenewname = rand() . '.' . $image->getClientOriginalExtension();
          $image->move(public_path('images/register/msme'), $msmenewname);
      }

    	$datafinal=[
    		'company_name'=>$data['cname'],
    		'name'=>$data['name'],
    		'designation'=>$data['designation'],
    		'email'=>$data['email'],
    		'mobile'=>$data['mobile'],
    		'plant_project_location'=>$data['plocation'],
    		'gst_number'=>$data['gnumber'],
    		'address'=>$data['address'],
    		'turnover'=>$data['turnover'],
    		'category_classification'=>$data['cclassification'],
    		'msme_certificate'=>$msmenewname,
    		'category_award'=>implode(',',$data['award']),
    	];
	$name=$data['name'];
	$email_to=$data['email'];
	$bcc='priya.narula@cii.in';
    	DB::table('1_cii_registration_form')->insert($datafinal);
         $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

            $bank_info='http://cii.ibentos.com/live/apps/public/mail_data/Bank_Details_PNB.pdf';
	$brochure='http://cii.ibentos.com/live/apps/public/mail_data/CII_Water_Awards_2021_Brochure.pdf';
$beyond_fence='http://cii.ibentos.com/live/apps/public/mail_data/Questionnaire_Beyond_the_Fence.doc';
$innovative_product='http://cii.ibentos.com/live/apps/public/mail_data/Questionnaire_Innovative_product.doc';
$within_fence='http://cii.ibentos.com/live/apps/public/mail_data/Questionnaire_Within_the_Fence.doc';
	
	 \Mail::send('mail.award_mail', ['name'=>$name], function ($m) use ($email_to,$bcc,$bank_info,$brochure,$beyond_fence,$innovative_product,$within_fence) {
                    $m->from('waterawards@cii.in', 'CII National Awards');
                    $m->to($email_to);
		   $m->attach($brochure);
		   $m->attach($bank_info);
 		   $m->attach($beyond_fence);
 		   $m->attach($innovative_product);	
		   $m->attach($within_fence);	
                    $m->bcc($bcc)->subject('Acknowledgement: CII National Awards for Excellence in Water Management 2021 ');
	
    	$message="Data Save Successfully";
	Session::flash('success', 'This is a message!');
	 return redirect()->route('registercii')
        ->with('success','data save successfully!');
    	//return redirect('registercii')->with('message',$message);
    }
public function homepage(){
 return view('frontpage.homepage');

}
    
}
