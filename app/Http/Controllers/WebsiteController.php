<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WebsiteController extends Controller
{
    public function home(){
       return view('website-panel.home');
    }
    public function welcome(){
        $data['ayodhyaDhamTemple'] = DB::table('ayodhya_dham_temples')->select('photo')->where('status', 1)->whereNotNull('photo')->orderBy('id', 'desc')->get();
        return view('website-panel.welcome',$data);
    }
    public function emergency(){
        return view('website-panel.emergency');
    }
    public function hospitalList(){
        $data['hospitalImages'] = DB::table('hospitals')->select('photo')->where('status', 1)->whereNotNull('photo')->limit(5)->get();
        $data['hospitals'] = DB::table('hospitals')->where('status', 1)->orderBy('id', 'desc')->get();
        return view('website-panel.hospitals-list',$data);
    }
    public function bankList(){
        $data['banks'] = DB::table('banks')->where('status', 1)->orderBy('id', 'desc')->get();
        return view('website-panel.banks-list',$data);  
    }
    public function travelList(){
        $data['travelList'] = DB::table('travels')->where('status', 1)->get();
        $data['otherFamousPlaceImage'] = DB::table('others_famous_places')->select('photo')->where('status', 1)->whereNotNull('photo')->orderBy('id', 'desc')->get();
        return view('website-panel.travel-list',$data);
    }
    public function travelDetail($id){
        $id = Crypt::decryptString($id);
        $data['travelDetail']= DB::table('travels')
        ->leftJoin('travel_details', 'travels.id', '=', 'travel_details.travel_id')->where('travels.id', $id)
        ->select('travels.id','travels.type','travel_details.name','travel_details.open_time','travel_details.address','travel_details.via_airport','travel_details.estimate_time','travel_details.description','travel_details.photo')
        ->first();
        $data['otherFamousPlaceImage'] = DB::table('others_famous_places')->select('photo')->where('status', 1)->whereNotNull('photo')->orderBy('id', 'desc')->get();
        return view('website-panel.travel-detail',$data);
    }
    public function otherFamousTemple(){
        $data['templeCategory'] = DB::table('temples_category')->where('status', 1)->get();
        $data['otherFamousPlace'] = DB::table('others_famous_places')->where('status', 1)->get();
        return view('website-panel.other-famous-temple',$data);
    }
    public function otherFamousSubCategory($id){
        $id = Crypt::decryptString($id);
        $query = DB::table('temples_category')->where('id', $id)->first();
        if($query){
            $data['subCategoryList'] = DB::table('sub_category_temples')->where('status',1)->where('temple_category_id',$query->id)->get();
            $data['templeCategory'] = $query;
            return view('website-panel.other-famous-sub-category-list',$data);
        }
        return redirect()->back()->with('error', 'Category not found');
    }
    public function otherFamousTempleDetail($id){
        $id = Crypt::decryptString($id);
        $data['otherTempleDetail'] = DB::table('others_famous_places')->where('id',$id)->first();
        $data['otherFamousPlaceImage'] = DB::table('others_famous_places')->select('photo')->where('status', 1)->whereNotNull('photo')->orderBy('id', 'desc')->get();
        return view('website-panel.other-famous-temple-detail',$data);
    }
    public function otherFamousSubCategoryDetail($id){

        $id = Crypt::decryptString($id);
        $data['subCategoryDetail'] = DB::table('sub_category_temples')->where('id',$id)->first();
        $data['otherFamousPlaceImage'] = DB::table('sub_category_temples')->select('photo','name')->where('status', 1)->whereNotNull('photo')->where('temple_category_id',$data['subCategoryDetail']->temple_category_id)->orderBy('id', 'desc')->get();
        return view( 'website-panel.other-famous-sub-category-detail',$data);
    }
    public function hotelList(){
        $data['hotelList'] = DB::table('hotels')->where('status',1)->get();
        return view( 'website-panel.hotel-list',$data);
    }
    public function ayodhyaDhamPlace(){
        $data['ayodhyaDham'] = DB::table('ayodhya_dham')->where('status',1)->get();
        return view( 'website-panel.ayodhya-dham',$data);
    }
    public function ayodhyaDhamTemple(){
        $data['ayodhyaDhamTemples'] = DB::table('ayodhya_dham_temples')->where('status',1)->get();
        return view( 'website-panel.ayodhya-dham-temples',$data);
    }
    public function ayodhyaDhamTempleDetail($id){
        $id = Crypt::decryptString($id);
        $query = DB::table('ayodhya_dham_temples')->where('id', $id)->first();
        $data['artiList'] = DB::table('temple_arti')->where('status',1)->where('temple_id',$query->id)->get();
        $data['nearMeList'] = DB::table('near_me')->where('status',1)->where('temple_id',$query->id)->get();
        $data['ayodhyaDhamTempleDetail'] = $query; 
        return view('website-panel.ayodhya-dham-temples-detail',$data);
    }
    public function ayodhyaDhamGhat(){
        $data['ayodhyaDhamGhat'] = DB::table('ayodhya_dham_ghats')->where('status',1)->get();
        return view( 'website-panel.ayodhya-dham-ghat-list',$data);
    }
    public function ayodhyaDhamGhatDetail($id){
        $id = Crypt::decryptString($id);
        $data['ghatDetail'] = DB::table('ayodhya_dham_ghats')->where('id', $id)->first();
        $data['otherFamousGhatImage'] = DB::table('ayodhya_dham_ghats')->select('photo','name')->where('status', 1)->whereNotNull('photo')->orderBy('id', 'desc')->get();
        return view( 'website-panel.ayodhya-dham-ghat-detail',$data);
    }
    public function templeQrLocation($id){
        $id = Crypt::decryptString($id);
        $data['ayodhyaDhamTemples'] = DB::table('ayodhya_dham_temples')->where('id',$id)->first(); 
        return view( 'website-panel.ayodhya-dham-temple-qr',$data);
    }

}
