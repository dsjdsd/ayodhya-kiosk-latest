<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use PDF;
use Yajra\DataTables\DataTables;
use Hash;
class AdminDashboardController extends Controller
{
    public function index(){
        $data['ayodhya_total_dham_temples'] = DB::table('ayodhya_dham_temples')->count();
        $data['ayodhya_total_dham_ghats'] = DB::table('ayodhya_dham_ghats')->count();
        $data['total_other_famous_category_temples'] = DB::table('temples_category')->count();
        $data['total_other_temples'] = DB::table('others_famous_places')->count();
        $data['total_hotels'] = DB::table('hotels')->count();
        $data['total_banks'] = DB::table('banks')->count();
        $data['total_hospitals'] = DB::table('hospitals')->count();
        return view('admin-panel.dashboard',$data);
    }
    public function ayodhyaDhamAddTemple(){
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.ayodhya-dham.temples.add-temple',$data);
    }
    public function ayodhyaDhamSaveTemple(Request $request){
        $validation = [
            'name' => 'required|string|max:255',
            'language_id' => 'required|string|max:255',
            'open_time' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_map_link' => 'required|string|max:2048',
            'airport_station_km' => 'nullable|string|max:255',
            'airport_station_map_link' => 'nullable|string|max:2048',
            'airport_station_estimate_time' => 'nullable|string|max:255',
            'via_railway_station_km' => 'nullable|string|max:255',
            'via_railway_station_map_link' => 'nullable|string|max:2048',
            'via_railway_station_estimate_time' => 'nullable|string|max:255',
            'bus_stop_km' => 'nullable|string|max:255',
            'bus_stop_map_link' => 'nullable|string|max:2048',
            'bus_stop_estimate_time' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string|max:2048',
            'note' => 'nullable|string|max:2048',
        ];
        $request->validate($validation);
        $ayodhyadhamTemple = [
            'name' => $request->name,
            'language_id' => $request->language_id,
            'open_time' => $request->open_time,
            'address' => $request->address,
            'address_map_link' => $request->address_map_link,
            'airport_station_km' => $request->airport_station_km,
            'airport_station_map_link' => $request->airport_station_map_link,
            'airport_station_estimate_time' => $request->airport_station_estimate_time,
            'via_railway_station_km' => $request->via_railway_station_km,
            'via_railway_station_map_link' => $request->via_railway_station_map_link,
            'via_railway_station_estimate_time' => $request->via_railway_station_estimate_time,
            'bus_stop_km' => $request->bus_stop_km,
            'bus_stop_map_link' => $request->bus_stop_map_link,
            'bus_stop_estimate_time' => $request->bus_stop_estimate_time,
            'description' => $request->description,
            'note' => $request->note,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('ayodhya-dham/temples'), $photo_name);
            $ayodhyadhamTemple['photo'] = $photo_name;
        }
        DB::table('ayodhya_dham_temples')->insert($ayodhyadhamTemple);
        return redirect()->route('adminAyodhyaDhamTempleList')->with('success', 'Ayodhya Dham saved successfully!');
    }
    public function ayodhyaDhamTempleList(Request $request){
        if ($request->ajax()) {
            $query = DB::table('ayodhya_dham_temples')->orderBy('id', 'desc');
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', 'like', '%' . $request->status . '%');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('address', function($row){
                    return checkVal($row->address);
                })
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success ayodhya-dham-temples-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger ayodhya-dham-temples-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('photo', function($row) {
                    return $row->photo ? '<a href="'.asset('ayodhya-dham/temples/'.$row->photo) .'" target="_blank"><img src="' . asset('ayodhya-dham/temples/'.$row->photo) . '" alt="Other Temples" style="width:30px; height:30px;"></a>' : "N/A";
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/ayodhya-dham-temple-edit/' . Crypt::encryptString($row->id)) . '" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status'])
                ->make(true);
        }
        return view('admin-panel.ayodhya-dham.temples.list-temples');    
    }
    public function ayodhyaDhamTempleEdit($id){
        $id = Crypt::decryptString($id);
        $data['ayodhyaDhamTempleDetail'] = DB::table('ayodhya_dham_temples')->where('id',$id)->first();
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.ayodhya-dham.temples.edit-temple',$data);   
    }
    public function ayodhyaDhamTempleUpdate(Request $request){
        $validation = [
            'id' => 'required|integer|exists:ayodhya_dham_temples,id',
            'language_id' => 'required|string|max:255',
            'open_time' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_map_link' => 'required|string|max:2048',
            'airport_station_km' => 'nullable|string|max:255',
            'airport_station_map_link' => 'nullable|string|max:2048',
            'airport_station_estimate_time' => 'nullable|string|max:255',
            'via_railway_station_km' => 'nullable|string|max:255',
            'via_railway_station_map_link' => 'nullable|string|max:2048',
            'via_railway_station_estimate_time' => 'nullable|string|max:255',
            'bus_stop_km' => 'nullable|string|max:255',
            'bus_stop_map_link' => 'nullable|string|max:2048',
            'bus_stop_estimate_time' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2048',
            'note' => 'nullable|string|max:2048',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $ayodhyadhamTemple = [
            'name' => $request->name,
            'language_id' => $request->language_id,
            'open_time' => $request->open_time,
            'address' => $request->address,
            'address_map_link' => $request->address_map_link,
            'airport_station_km' => $request->airport_station_km,
            'airport_station_map_link' => $request->airport_station_map_link,
            'airport_station_estimate_time' => $request->airport_station_estimate_time,
            'via_railway_station_km' => $request->via_railway_station_km,
            'via_railway_station_map_link' => $request->via_railway_station_map_link,
            'via_railway_station_estimate_time' => $request->via_railway_station_estimate_time,
            'bus_stop_km' => $request->bus_stop_km,
            'bus_stop_map_link' => $request->bus_stop_map_link,
            'bus_stop_estimate_time' => $request->bus_stop_estimate_time,
            'description' => $request->description,
            'note' => $request->note,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('ayodhya-dham/temples'), $photo_name);
            $ayodhyadhamTemple['photo'] = $photo_name;
        }
        DB::table('ayodhya_dham_temples')->where('id',$request->id)->update($ayodhyadhamTemple);
        return redirect()->route('adminAyodhyaDhamTempleList')->with('success', 'Ayodhya Dham Temples updated successfully!'); 
    }
    public function ayodhyaDhamTempleUpdateStatus(Request $request){
        DB::table('ayodhya_dham_temples')->where('id', $request->ayodhyaDhamTempleId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);  
    }
    public function ayodhyaDhamGhatAdd(){
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.ayodhya-dham.ghat.add-ghat',$data);

    }
    public function ayodhyaDhamGhatSave(Request $request){

        $validation = [
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_map_link' => 'required|string|max:2048',
            'airport_station_km' => 'nullable|string|max:255',
            'airport_station_map_link' => 'nullable|string|max:2048',
            'airport_station_estimate_time' => 'nullable|string|max:255',
            'via_railway_station_km' => 'nullable|string|max:255',
            'via_railway_station_map_link' => 'nullable|string|max:2048',
            'via_railway_station_estimate_time' => 'nullable|string|max:255',
            'bus_stop_km' => 'nullable|string|max:255',
            'bus_stop_map_link' => 'nullable|string|max:2048',
            'bus_stop_estimate_time' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $request->validate($validation);
        $ayodhyadhamGhat = [
            'name' => $request->name,
            'language_id' => $request->language_id,
            'address' => $request->address,
            'address_map_link' => $request->address_map_link,
            'airport_station_km' => $request->airport_station_km,
            'airport_station_map_link' => $request->airport_station_map_link,
            'airport_station_estimate_time' => $request->airport_station_estimate_time,
            'via_railway_station_km' => $request->via_railway_station_km,
            'via_railway_station_map_link' => $request->via_railway_station_map_link,
            'via_railway_station_estimate_time' => $request->via_railway_station_estimate_time,
            'bus_stop_km' => $request->bus_stop_km,
            'bus_stop_map_link' => $request->bus_stop_map_link,
            'bus_stop_estimate_time' => $request->bus_stop_estimate_time,
            'description' => $request->description,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('ayodhya-dham/ghats'), $photo_name);
            $ayodhyadhamGhat['photo'] = $photo_name;
        }
        DB::table('ayodhya_dham_ghats')->insert($ayodhyadhamGhat);
        return redirect()->route('adminAyodhyaDhamGhatList')->with('success', 'Ayodhya Dham saved successfully!');
    }
    public function ayodhyaDhamGhatList(Request $request){
        if ($request->ajax()) {
            $query = DB::table('ayodhya_dham_ghats')->orderBy('id', 'desc');
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', 'like', '%' . $request->status . '%');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('address', function($row){
                    return checkVal($row->address);
                })
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success ayodhya-dham-ghat-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger ayodhya-dham-ghat-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('photo', function($row) {
                    return $row->photo ? '<a href="'.asset('ayodhya-dham/ghats/'.$row->photo) .'" target="_blank"><img src="' . asset('ayodhya-dham/ghats/'.$row->photo) . '" alt="Other Temples" style="width:30px; height:30px;"></a>' : "N/A";
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/ayodhya-dham-ghat-edit/' . Crypt::encryptString($row->id)) . '" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status'])
                ->make(true);
        }
        return view('admin-panel.ayodhya-dham.ghat.list-ghat');
    }
public function ayodhyaDhamGhatEdit($id){
    $id = Crypt::decryptString($id);
    $data['ayodhyaDhamGhatDetail'] = DB::table('ayodhya_dham_ghats')->where('id',$id)->first();
    $data['languages'] = DB::table('languages')->where('status',1)->get();
    return view('admin-panel.ayodhya-dham.ghat.edit-ghat',$data);
}

public function ayodhyaDhamGhatupdate(Request $request){

    $validation = [
        'id' => 'required|integer|exists:ayodhya_dham_ghats,id',
        'name' => 'required|string|max:255',
        'language_id' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'address_map_link' => 'required|string|max:2048',
        'airport_station_km' => 'nullable|string|max:255',
        'airport_station_map_link' => 'nullable|string|max:2048',
        'airport_station_estimate_time' => 'nullable|string|max:255',
        'via_railway_station_km' => 'nullable|string|max:255',
        'via_railway_station_map_link' => 'nullable|string|max:2048',
        'via_railway_station_estimate_time' => 'nullable|string|max:255',
        'bus_stop_km' => 'nullable|string|max:255',
        'bus_stop_map_link' => 'nullable|string|max:2048',
        'bus_stop_estimate_time' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:2048',
    ];
    if ($request->hasFile('photo')) {
        $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
    }
    $request->validate($validation);
    $ayodhyadhamGhat = [
        'name' => $request->name,
        'language_id' => $request->language_id,
        'address' => $request->address,
        'address_map_link' => $request->address_map_link,
        'airport_station_km' => $request->airport_station_km,
        'airport_station_map_link' => $request->airport_station_map_link,
        'airport_station_estimate_time' => $request->airport_station_estimate_time,
        'via_railway_station_km' => $request->via_railway_station_km,
        'via_railway_station_map_link' => $request->via_railway_station_map_link,
        'via_railway_station_estimate_time' => $request->via_railway_station_estimate_time,
        'bus_stop_km' => $request->bus_stop_km,
        'bus_stop_map_link' => $request->bus_stop_map_link,
        'bus_stop_estimate_time' => $request->bus_stop_estimate_time,
        'description' => $request->description,
    ];
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
        $photo->move(public_path('ayodhya-dham/ghats'), $photo_name);
        $ayodhyadhamGhat['photo'] = $photo_name;
    }
    DB::table('ayodhya_dham_ghats')->where('id',$request->id)->update($ayodhyadhamGhat);
    return redirect()->route('adminAyodhyaDhamGhatList')->with('success', 'Ayodhya Dham Ghat updated successfully!'); 
}

public function ayodhyaDhamGhatUpdateStatus(Request $request){
    DB::table('ayodhya_dham_ghats')->where('id', $request->ayodhyaDhamGhatId)->update(['status'=>$request->newStatus]);
    return response()->json(['message' => 'Status updated successfully','status'=>200]);  
} 
public function templeWiseArtiAdd(){
    $data['ayodhyaDhamTemple'] = DB::table('ayodhya_dham_temples')->where('status',1)->get();
    return view('admin-panel.ayodhya-dham.temples.add-temple-wise-arti',$data);
}
public function templeWiseArtiSave(Request $request){
    $validation = [
        'temple_id' => 'required|integer|exists:ayodhya_dham_temples,id',
        'arti_name' => 'required|string|max:255',
        'arti_time' => 'required|string|max:255',
    ];
    $request->validate($validation);
    $artiDetail =[
        'temple_id'=>$request->temple_id,
        'arti_name'=>$request->arti_name,
        'arti_time'=>$request->arti_time,
    ];
    DB::table('temple_arti')->insert($artiDetail);
    return redirect()->route('adminArtiList')->with('success', 'Add Temple Arti successfully!'); 
}
public function artiList(Request $request){
    $data['templeList'] = DB::table('ayodhya_dham_temples')->where('status', 1)->get();
    if ($request->ajax()) {
        $query = DB::table('temple_arti')
            ->select('temple_arti.id', 'temple_arti.arti_name', 'temple_arti.arti_time','temple_arti.status', 'ayodhya_dham_temples.name as temple_name')
            ->join('ayodhya_dham_temples', 'temple_arti.temple_id', '=', 'ayodhya_dham_temples.id')
            ->orderBy('temple_arti.id', 'desc');
    
        if ($request->filled('arti_name')) {
            $query->where('temple_arti.arti_name', 'like', '%' . $request->arti_name . '%');
        }
        if ($request->filled('temple_id')) {
            $query->where('temple_arti.temple_id', $request->temple_id);
        }
        if ($request->filled('status')) {
            $query->where('temple_arti.status', $request->status);
        }
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                return $row->status==1?"<button class='btn btn-success arti-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger arti-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
            })
            ->addColumn('action', function($row) {
                return '<a href="' . url('admin/arti-edit/' . Crypt::encryptString($row->id)) . '" class="btn btn-primary">Edit</a>';
            })

            ->rawColumns(['status','action'])
            ->make(true);
    }
    return view('admin-panel.ayodhya-dham.temples.arti-list', $data); 
}
public function artiEdit($id){
    $id = Crypt::decryptString($id);
    $data['artiDetail'] = DB::table('temple_arti')->where('id',$id)->first();
    $data['ayodhyaDhamTemple'] = DB::table('ayodhya_dham_temples')->where('status',1)->get();
    return view('admin-panel.ayodhya-dham.temples.edit-arti',$data);
}
public function artiUpdate(Request $request){
    $validation = [
        'id' => 'required|integer|exists:temple_arti,id',
        'temple_id' => 'required|integer|exists:ayodhya_dham_temples,id',
        'arti_name' => 'required|string|max:255',
        'arti_time' => 'required|string|max:255',
    ];
    $request->validate($validation);
    $artiDetail =[
        'temple_id'=>$request->temple_id,
        'arti_name'=>$request->arti_name,
        'arti_time'=>$request->arti_time,
    ];
    DB::table('temple_arti')->where('id',$request->id)->update($artiDetail);
    return redirect()->route('adminArtiList')->with('success', 'Arti Updated successfully!'); 
}
public function artiUpdateStatus(Request $request){
    DB::table('temple_arti')->where('id', $request->artiId)->update(['status'=>$request->newStatus]);
    return response()->json(['message' => 'Status updated successfully','status'=>200]);
}

public function hospitalList(Request $request){
        if ($request->ajax()) {
            $query = DB::table('hospitals')->orderBy('id', 'desc');
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('pincode')) {
                $query->where('pincode', 'like', '%' . $request->pincode . '%');
            }
            if ($request->filled('category')) {
                $query->where('category', 'like', '%' . $request->category . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', 'like', '%' . $request->status . '%');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success hospital-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger hospital-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('pincode', function($row) {
                    return checkVal($row->pincode);
                })
                ->addColumn('photo', function($row) {
                    return $row->photo?'<a href="'.asset('hospitals/'.$row->photo) .'" target="_blank"><img src="' . asset('hospitals/'.$row->photo) . '" alt="Hospital Logo" style="width:20px; height:20px;"></a>':"N/A";
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/hospital-edit/' . Crypt::encryptString($row->id)) . '"  class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status'])
                ->make(true);
        }
        return view('admin-panel.hospitals.hospital-list');
    }
    public function hospitalAdd(){
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.hospitals.add-hospital',$data);
    }
    public function hospitalSave(Request $request)
    {
        $validation = [
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $hospital = [
            'language_id' => $request->language_id,
            'name' => $request->name,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'category' => $request->category,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('hospitals'), $photo_name);
            $hospital['photo'] = $photo_name;
        }
        DB::table('hospitals')->insert($hospital);
        return redirect()->route('adminHospitalList')->with('success', 'Hospital saved successfully!');    
    }
    public function hospitalEdit($id){
        $id = Crypt::decryptString($id);
        $data['hospital_detail'] = DB::table('hospitals')->where('id',$id)->first();
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.hospitals.edit-hospital',$data);
    }
    public function hospitalUpdate(Request $request){
        $validation = [
            'id' => 'required|integer|exists:hospitals,id',
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $hospital = [
            'language_id' => $request->language_id,
            'name' => $request->name,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'category' => $request->category,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('hospitals'), $photo_name);
            $hospital['photo'] = $photo_name;
        }
        DB::table('hospitals')->where('id', $request->id)->update($hospital);
        return redirect()->route('adminHospitalList')->with('success', 'Hospital updated successfully!'); 
    }
    public function hospitalUpdateStatus(Request $request){
        DB::table('hospitals')->where('id', $request->hospitalId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);
    }
    public function bankAdd(){
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.banks.add-bank',$data); 
    }
    public function bankSave(Request $request)
    {
        $validation = [
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'pincode' => 'required|string|max:255',
            'address_link' => 'nullable|string|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $request->validate($validation);
        $bank = [
            'language_id' => $request->language_id,
            'name' => $request->name,
            'address' => $request->address,
            'category' => $request->category,
            'website' => $request->website,
            'pincode' => $request->pincode,
            'address_link' => $request->address_link,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('banks'), $photo_name);
            $bank['photo'] = $photo_name;
        }
        DB::table('banks')->insert($bank);
        return redirect()->route('adminBankList')->with('success', 'Bank saved successfully!');
    }
    public function bankList(Request $request){
        if ($request->ajax()) {
            $query = DB::table('banks')->orderBy('id', 'desc');
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('pincode')) {
                $query->where('pincode', 'like', '%' . $request->pincode . '%');
            }
            if ($request->filled('category')) {
                $query->where('category', 'like', '%' . $request->category . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', 'like', '%' . $request->status . '%');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success bank-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger bank-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('website', function($row) {
                    return '<a href="'.$row->website.'" target="_blank">'.$row->website.'</a>';
                })
                ->addColumn('address', function($row) {
                    return '<a href="'.$row->address_link.'" target="_blank">'.$row->address.'</a>';
                })
                ->addColumn('pincode', function($row) {
                    return $row->pincode;
                })
                ->addColumn('photo', function($row) {
                    return '<a href="'.asset('banks/'.$row->photo) .'" target="_blank"><img src="' . asset('banks/'.$row->photo) . '" alt="Bank Logo" style="width:20px; height:20px;"></a>';
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/bank-edit/' . Crypt::encryptString($row->id)) . '"  class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status','website','address'])
                ->make(true);
        }
        return view('admin-panel.banks.bank-list'); 
    }
    public function bankEdit($id){
        $id = Crypt::decryptString($id);
        $data['bank_detail'] = DB::table('banks')->where('id',$id)->first();
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.banks.edit-bank',$data); 
    }
    public function bankUpdate(Request $request){
        $validation = [
            'id' => 'required|integer|exists:banks,id',
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'pincode' => 'required|string|max:255',
            'address_link' => 'nullable|string|max:2048',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $bank = [
            'language_id' => $request->language_id,
            'name' => $request->name,
            'address' => $request->address,
            'category' => $request->category,
            'website' => $request->website,
            'pincode' => $request->pincode,
            'address_link' => $request->address_link,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('banks'), $photo_name);
            $bank['photo'] = $photo_name;
        }
        DB::table('banks')->where('id', $request->id)->update($bank);
        return redirect()->route('adminBankList')->with('success', 'Bank updated successfully!'); 
    }
    public function bankUpdateStatus(Request $request){
        DB::table('banks')->where('id', $request->banklId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);
    }
    public function travelList(Request $request){
        if ($request->ajax()) {
            $query = DB::table('travels')->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success travel-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger travel-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('type', function($row) {
                    if($row->type=="Accommodation"){
                        return '<a href="'.route('adminHotelList').'" >'.$row->type.'</a>';  
                    }else{
                        return '<a href="'.url('admin/travel-detail/'.Crypt::encryptString($row->id)).'" >'.$row->type.'</a>';
                    }
                    
                })
                ->addColumn('photo', function($row) {
                    return '<a href="'.asset('travels/'.$row->photo) .'" target="_blank"><img src="' . asset('travels/'.$row->photo) . '" alt="Travel Logo" style="width:30px; height:30px;"></a>';
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/travel-edit/' . Crypt::encryptString($row->id)) . '"  class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status','type'])
                ->make(true);
        }
        return view('admin-panel.travels.travel-list');
    }
    public function travelAdd(){
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.travels.add-travel',$data);  
    }
    public function travelSave(Request $request){

        $validation = [
            'language_id' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $request->validate($validation);
        $travel = [
            'type' => $request->type,
            'language_id' => $request->language_id,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('travels'), $photo_name);
            $travel['photo'] = $photo_name;
        }
        DB::table('travels')->insert($travel);
        return redirect()->route('adminTravelList')->with('success', 'Travel saved successfully!');
    }
    public function travelEdit($id){
        $id = Crypt::decryptString($id);
        $data['travel'] = DB::table('travels')->where('id',$id)->first();
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.travels.edit-travel',$data);  
    }
    public function travelUpdate(Request $request){
        $validation = [
            'id' => 'required|integer|exists:travels,id',
            'language_id' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $travel = [
            'type' => $request->type,
            'language_id' => $request->language_id,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('travels'), $photo_name);
            $travel['photo'] = $photo_name;
        }
        DB::table('travels')->where('id', $request->id)->update($travel);
        return redirect()->route('adminTravelList')->with('success', 'Travel updated successfully!'); 
    }
    public function travelUpdateStatus(Request $request){
        DB::table('travels')->where('id', $request->travelId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);
    }
    public function travelDetail($id){
        $id = Crypt::decryptString($id);
        $data['travel'] = DB::table('travels')
        ->leftJoin('travel_details', 'travels.id', '=', 'travel_details.travel_id')
        ->where('travels.id', $id)
        ->select('travels.id','travels.type','travel_details.name','travel_details.open_time','travel_details.address','travel_details.via_airport','travel_details.estimate_time','travel_details.description','travel_details.photo')
        ->first();
        return view('admin-panel.travels.travel-detail',$data); 
    }
    public function travelDetailUpdate(Request $request) {
        $validation = [
            'travel_id' => 'required|exists:travels,id',
            'name' => 'required|string|max:255',
            'open_time' => 'required|string|max:255',
            'address' => 'required|string|max:2048',
            'via_airport' => 'required|string|max:255',
            'estimate_time' => 'required|string|max:255',
            'description' => 'nullable|string|max:2048',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $travel_id = $request->travel_id;
        $travel_detail = [
            'name' => $request->name,
            'open_time' => $request->open_time,
            'address' => $request->address,
            'via_airport' => $request->via_airport,
            'estimate_time' => $request->estimate_time,
            'description' => $request->description,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('travel_details'), $photo_name);
            $travel_detail['photo'] = $photo_name;
        }
        $travel_detail_check = DB::table('travel_details')->where('travel_id', $travel_id)->first();
        if ($travel_detail_check) {
            DB::table('travel_details')->where('travel_id', $travel_id)->update($travel_detail);
            return redirect()->route('adminTravelList')->with('success', 'Travel detail updated successfully!'); 
        } else {
            $travel_detail['travel_id'] = $travel_id;
            DB::table('travel_details')->insert($travel_detail);
            return redirect()->route('adminTravelList')->with('success', 'Travel detail inserted successfully!'); 
        }
    }
    public function hotelList(Request $request){
        if ($request->ajax()) {
            $query = DB::table('hotels')->orderBy('id', 'desc');
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('mobile_number')) {
                $query->where('mobile_number', 'like', '%' . $request->mobile_number . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', 'like', '%' . $request->status . '%');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('address', function($row){
                    return checkVal($row->address);
                })
                ->addColumn('mobile_number', function($row){
                    return checkVal($row->mobile_number);
                })
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success hotel-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger hotel-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('photo', function($row) {
                    return $row->photo ? '<a href="'.asset('hotels/'.$row->photo) .'" target="_blank"><img src="' . asset('hotels/'.$row->photo) . '" alt="Hotel Logo" style="width:20px; height:20px;"></a>':"N/A";
                })
                ->addColumn('image1', function($row) {
                    return $row->image1 ? '<a href="'.asset('hotels/'.$row->image1) .'" target="_blank"><img src="' . asset('hotels/'.$row->image1) . '" alt="Hotel Image-1" style="width:20px; height:20px;"></a>':"N/A";
                })
                ->addColumn('image2', function($row) {
                    return $row->image2 ? '<a href="'.asset('hotels/'.$row->image2) .'" target="_blank"><img src="' . asset('hotels/'.$row->image2) . '" alt="Hotel Image-2" style="width:20px; height:20px;"></a>':"N/A";
                })
                ->addColumn('image3', function($row) {
                    return $row->image3 ? '<a href="'.asset('hotels/'.$row->image3) .'" target="_blank"><img src="' . asset('hotels/'.$row->image3) . '" alt="Hotel Image-3" style="width:20px; height:20px;"></a>':"N/A";
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/hotel-edit/' . Crypt::encryptString($row->id)) . '" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status','image1','image2','image3'])
                ->make(true);
        }
        return view('admin-panel.hotels.hotel-list'); 
    }
    public function hotelAdd(){
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.hotels.add-hotel',$data);  
    }
    public function hotelSave(Request $request){
        $validation = [
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image3' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $request->validate($validation);
        $hotelDetail = [
            'language_id'=>$request->language_id,
            'name'=>$request->name,
            'mobile_number'=>$request->mobile_number,
            'address'=>$request->address,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('hotels'), $photo_name);
            $hotelDetail['photo'] = $photo_name;
        }
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $image1_name = date('d-m-Y') . '-' . time() . '-' . $image1->getClientOriginalName();
            $image1->move(public_path('hotels'), $image1_name);
            $hotelDetail['image1'] = $image1_name;
        }
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2_name = date('d-m-Y') . '-' . time() . '-' . $image2->getClientOriginalName();
            $image2->move(public_path('hotels'), $image2_name);
            $hotelDetail['image2'] = $image2_name;
        }
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $image3_name = date('d-m-Y') . '-' . time() . '-' . $image3->getClientOriginalName();
            $image3->move(public_path('hotels'), $image3_name);
            $hotelDetail['image3'] = $image3_name;
        }
        DB::table('hotels')->insert($hotelDetail);
        return redirect()->route('adminHotelList')->with('success', 'Hotel added successfully!');
    }
    public function hotelEdit($id){
        $id = Crypt::decryptString($id);
        $data['hotel_detail'] = DB::table('hotels')->where('id',$id)->first();
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.hotels.edit-hotel',$data); 
    }
    public function hotelUpdate(Request $request){

        $validation = [
            'id' => 'required|exists:hotels,id',
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        if ($request->hasFile('image1')) {
            $validation['image1'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        if ($request->hasFile('image2')) {
            $validation['image2'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        if ($request->hasFile('image3')) {
            $validation['image3'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $hotelDetail = [
            'name'=>$request->name,
            'language_id'=>$request->language_id,
            'mobile_number'=>$request->mobile_number,
            'address'=>$request->address,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('hotels'), $photo_name);
            $hotelDetail['photo'] = $photo_name;
        }
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $image1_name = date('d-m-Y') . '-' . time() . '-' . $image1->getClientOriginalName();
            $image1->move(public_path('hotels'), $image1_name);
            $hotelDetail['image1'] = $image1_name;
        }
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2_name = date('d-m-Y') . '-' . time() . '-' . $image2->getClientOriginalName();
            $image2->move(public_path('hotels'), $image2_name);
            $hotelDetail['image2'] = $image2_name;
        }
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $image3_name = date('d-m-Y') . '-' . time() . '-' . $image3->getClientOriginalName();
            $image3->move(public_path('hotels'), $image3_name);
            $hotelDetail['image3'] = $image3_name;
        }
        DB::table('hotels')->where('id', $request->id)->update($hotelDetail);
        return redirect()->route('adminHotelList')->with('success', 'Hotel updated successfully!');
    }
    public function hotelUpdateStatus(Request $request){
        DB::table('hotels')->where('id', $request->hotelId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);
    }
    public function templeCategoryList(Request $request){
        if ($request->ajax()) {
            $query = DB::table('temples_category')->orderBy('id', 'desc');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return '<a href="'.url('admin/sub-category-temples-list/'.Crypt::encryptString($row->id)).'" target="_blank">'.$row->name.'</a>'; 
                })
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success temples-category-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger temples-category-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('photo', function($row) {
                    return '<a href="'.asset('temple-categories/'.$row->photo) .'" target="_blank"><img src="' . asset('temple-categories/'.$row->photo) . '" alt="Temples Category" style="width:30px; height:30px;"></a>';
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/temple-category-edit/' . Crypt::encryptString($row->id)) . '" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status','name'])
                ->make(true);
        }
        return view('admin-panel.temples-category.category-list');
    }
    public function templeCategoryAdd(){
        return view('admin-panel.temples-category.add-category');
    }
    public function templeCategorySave(Request $request){
        $validation = [
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $request->validate($validation);
        $templeCategory = [
            'name' => $request->name,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('temple-categories'), $photo_name);
            $templeCategory['photo'] = $photo_name;
        }
        DB::table('temples_category')->insert($templeCategory);
        return redirect()->route('adminTempleCategoryList')->with('success', 'Temples Category saved successfully!');
    }
    public function templeCategoryEdit($id){
        $id = Crypt::decryptString($id);
        $data['temples_category_detail'] = DB::table('temples_category')->where('id',$id)->first();
        return view('admin-panel.temples-category.edit-category',$data); 
    }
    public function templeCategoryUpdate(Request $request){
        $validation = [
            'id' => 'required|integer|exists:temples_category,id',
            'name' => 'required|string|max:255',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $templeCategory = [
            'name' => $request->name,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('temple-categories'), $photo_name);
            $templeCategory['photo'] = $photo_name;
        }
        DB::table('temples_category')->where('id', $request->id)->update($templeCategory);
        return redirect()->route('adminTempleCategoryList')->with('success', 'Temples Category updated successfully!'); 
    }
    public function templeCategoryUpdateStatus(Request $request){
        DB::table('temples_category')->where('id', $request->templesCategoryId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);
    }
    public function subCategoryTempleList(Request $request,$id){
        $id = Crypt::decryptString($id);
        $data['temples_category_detail'] = DB::table('temples_category')->where('id',$id)->first();
        if ($request->ajax()) {
            $query = DB::table('sub_category_temples')->where('temple_category_id',$id)->orderBy('id', 'desc');
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', 'like', '%' . $request->status . '%');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('address', function($row){
                    return checkVal($row->address);
                })
              
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success sub-category-temple-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger sub-category-temple-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('photo', function($row) {
                    return $row->photo?'<a href="'.asset('sub-category-temple/'.$row->photo) .'" target="_blank"><img src="' . asset('sub-category-temple/'.$row->photo) . '" alt="Temples Category" style="width:30px; height:30px;"></a>':"N/A";
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/sub-category-temples-edit/' . Crypt::encryptString($row->id)) . '" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status'])
                ->make(true);
        }
        return view('admin-panel.sub-category-temples.list-sub-category-temple',$data); 
    }
    public function subCategoryTempleAdd($id){
        $id = Crypt::decryptString($id);
        $data['temples_category_detail'] = DB::table('temples_category')->where('id',$id)->first();
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.sub-category-temples.add-sub-category-temple',$data); 
    }
    public function subCategoryTempleSave(Request $request){
        $validation = [
            'temple_category_id' => 'required|exists:temples_category,id',
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:2048',
            'address_map_link' => 'required|string|max:2048',
            'airport_station_km' => 'nullable|string|max:255',
            'airport_station_map_link' => 'nullable|string|max:2048',
            'airport_station_estimate_time' => 'nullable|string|max:255',
            'via_railway_station_km' => 'nullable|string|max:255',
            'via_railway_station_map_link' => 'nullable|string|max:2048',
            'via_railway_station_estimate_time' => 'nullable|string|max:255',
            'bus_stop_km' => 'nullable|string|max:255',
            'bus_stop_map_link' => 'nullable|string|max:2048',
            'bus_stop_estimate_time' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $request->validate($validation);
        $subCategoryTemple = [
            'temple_category_id' => $request->temple_category_id,
            'language_id' => $request->language_id,
            'name' => $request->name,
            'address' => $request->address,
            'address_map_link' => $request->address_map_link,
            'airport_station_km' => $request->airport_station_km,
            'airport_station_map_link' => $request->airport_station_map_link,
            'airport_station_estimate_time' => $request->airport_station_estimate_time,
            'via_railway_station_km' => $request->via_railway_station_km,
            'via_railway_station_map_link' => $request->via_railway_station_map_link,
            'via_railway_station_estimate_time' => $request->via_railway_station_estimate_time,
            'bus_stop_km' => $request->bus_stop_km,
            'bus_stop_map_link' => $request->bus_stop_map_link,
            'bus_stop_estimate_time' => $request->bus_stop_estimate_time,
            'description' => $request->description,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('sub-category-temple'), $photo_name);
            $subCategoryTemple['photo'] = $photo_name;
        }
        DB::table('sub_category_temples')->insert($subCategoryTemple);
        return redirect('admin/sub-category-temples-list/' . Crypt::encryptString($request->temple_category_id))->with('success', 'Sub Category Temple updated successfully!');
    }
    public function subCategoryTempleEdit($sub_category_id){
        $sub_category_id = Crypt::decryptString($sub_category_id);
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        $data['templeSubCategoryDetail'] = DB::table('sub_category_temples')->join('temples_category', 'temples_category.id', '=', 'sub_category_temples.temple_category_id')->select('sub_category_temples.*','temples_category.name as category_name')->where('sub_category_temples.id', $sub_category_id)->first();
        return view('admin-panel.sub-category-temples.edit-sub-category-temple',$data); 
    }
    public function subCategoryTempleUpdate(Request $request){
        $validation = [
            'id' => 'required|exists:sub_category_temples,id',
            'temple_category_id' => 'required',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:2048',
            'address_map_link' => 'required|string|max:2048',
            'airport_station_km' => 'nullable|string|max:255',
            'airport_station_map_link' => 'nullable|string|max:2048',
            'airport_station_estimate_time' => 'nullable|string|max:255',
            'via_railway_station_km' => 'nullable|string|max:255',
            'via_railway_station_map_link' => 'nullable|string|max:2048',
            'via_railway_station_estimate_time' => 'nullable|string|max:255',
            'bus_stop_km' => 'nullable|string|max:255',
            'bus_stop_map_link' => 'nullable|string|max:2048',
            'bus_stop_estimate_time' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2048',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $subCategoryTemple = [
            'name' => $request->name,
            'address' => $request->address,
            'address_map_link' => $request->address_map_link,
            'airport_station_km' => $request->airport_station_km,
            'airport_station_map_link' => $request->airport_station_map_link,
            'airport_station_estimate_time' => $request->airport_station_estimate_time,
            'via_railway_station_km' => $request->via_railway_station_km,
            'via_railway_station_map_link' => $request->via_railway_station_map_link,
            'via_railway_station_estimate_time' => $request->via_railway_station_estimate_time,
            'bus_stop_km' => $request->bus_stop_km,
            'bus_stop_map_link' => $request->bus_stop_map_link,
            'bus_stop_estimate_time' => $request->bus_stop_estimate_time,
            'description' => $request->description,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('sub-category-temple'), $photo_name);
            $subCategoryTemple['photo'] = $photo_name;
        }
        DB::table('sub_category_temples')->where('id', $request->id)->update($subCategoryTemple);
        return redirect('admin/sub-category-temples-list/' . Crypt::encryptString($request->temple_category_id))->with('success', 'Sub Category Temple updated successfully!');
    }
    public function subCategoryTempleUpdateStatus(Request $request){
        DB::table('sub_category_temples')->where('id', $request->subCategoryTempleId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);
    }
    public function templeList(Request $request){
        if ($request->ajax()) {
            $query = DB::table('others_famous_places')->orderBy('id', 'desc');
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', 'like', '%' . $request->status . '%');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('address', function($row){
                    return checkVal($row->address);
                })
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success other-temples-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger other-temples-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('photo', function($row) {
                    return $row->photo ? '<a href="'.asset('other-temples/'.$row->photo) .'" target="_blank"><img src="' . asset('other-temples/'.$row->photo) . '" alt="Other Temples" style="width:30px; height:30px;"></a>' : "N/A";
                })
                ->addColumn('action', function($row) {
                    return '<a href="' . url('admin/temple-edit/' . Crypt::encryptString($row->id)) . '" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status'])
                ->make(true);
        }
        return view('admin-panel.other-temples.list-temples'); 
    }
    public function templeAdd(){
        $data['languages'] = DB::table('languages')->where('status',1)->get();
        return view('admin-panel.other-temples.add-temples',$data); 
    }
    public function templeSave(Request $request){
        $validation = [
            'name' => 'required|string|max:255',
            'language_id' => 'required|string|max:255',
            'address' => 'required|string|max:2048',
            'address_map_link' => 'required|string|max:2048',
            'airport_station_km' => 'nullable|string|max:255',
            'airport_station_map_link' => 'nullable|string|max:2048',
            'airport_station_estimate_time' => 'nullable|string|max:255',
            'via_railway_station_km' => 'nullable|string|max:255',
            'via_railway_station_map_link' => 'nullable|string|max:2048',
            'via_railway_station_estimate_time' => 'nullable|string|max:255',
            'bus_stop_km' => 'nullable|string|max:255',
            'bus_stop_map_link' => 'nullable|string|max:2048',
            'bus_stop_estimate_time' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $request->validate($validation);
        $othertemples = [
            'name' => $request->name,
            'language_id' => $request->language_id,
            'address' => $request->address,
            'address_map_link' => $request->address_map_link,
            'airport_station_km' => $request->airport_station_km,
            'airport_station_map_link' => $request->airport_station_map_link,
            'airport_station_estimate_time' => $request->airport_station_estimate_time,
            'via_railway_station_km' => $request->via_railway_station_km,
            'via_railway_station_map_link' => $request->via_railway_station_map_link,
            'via_railway_station_estimate_time' => $request->via_railway_station_estimate_time,
            'bus_stop_km' => $request->bus_stop_km,
            'bus_stop_map_link' => $request->bus_stop_map_link,
            'bus_stop_estimate_time' => $request->bus_stop_estimate_time,
            'description' => $request->description,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('other-temples'), $photo_name);
            $othertemples['photo'] = $photo_name;
        }
        DB::table('others_famous_places')->insert($othertemples);
        return redirect()->route('adminTempleList')->with('success', 'Other Temples saved successfully!');    
    }
    public function templeEdit($id){
       $id = Crypt::decryptString($id);
       $data['otherFamousDetail'] = DB::table('others_famous_places')->where('id',$id)->first();
       $data['languages'] = DB::table('languages')->where('status',1)->get();
       return view('admin-panel.other-temples.edit-temples',$data); 
    }
    public function templeUpdate(Request $request){
        $validation = [
            'id' => 'required|exists:others_famous_places,id',
            'language_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:2048',
            'address_map_link' => 'required|string|max:2048',
            'airport_station_km' => 'nullable|string|max:255',
            'airport_station_map_link' => 'nullable|string|max:2048',
            'airport_station_estimate_time' => 'nullable|string|max:255',
            'via_railway_station_km' => 'nullable|string|max:255',
            'via_railway_station_map_link' => 'nullable|string|max:2048',
            'via_railway_station_estimate_time' => 'nullable|string|max:255',
            'bus_stop_km' => 'nullable|string|max:255',
            'bus_stop_map_link' => 'nullable|string|max:2048',
            'bus_stop_estimate_time' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2048',
        ];
        if ($request->hasFile('photo')) {
            $validation['photo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $othertemples = [
            'name' => $request->name,
            'language_id' => $request->language_id,
            'address' => $request->address,
            'address_map_link' => $request->address_map_link,
            'airport_station_km' => $request->airport_station_km,
            'airport_station_map_link' => $request->airport_station_map_link,
            'airport_station_estimate_time' => $request->airport_station_estimate_time,
            'via_railway_station_km' => $request->via_railway_station_km,
            'via_railway_station_map_link' => $request->via_railway_station_map_link,
            'via_railway_station_estimate_time' => $request->via_railway_station_estimate_time,
            'bus_stop_km' => $request->bus_stop_km,
            'bus_stop_map_link' => $request->bus_stop_map_link,
            'bus_stop_estimate_time' => $request->bus_stop_estimate_time,
            'description' => $request->description,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('other-temples'), $photo_name);
            $othertemples['photo'] = $photo_name;
        }
        DB::table('others_famous_places')->where('id',$request->id)->update($othertemples);
        return redirect()->route('adminTempleList')->with('success', 'Other Temples updated successfully!');   
    }
    public function templeUpdateStatus(Request $request){
        DB::table('others_famous_places')->where('id', $request->otherTempleId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);
    }
    public function setting(){
        $data['setting'] = DB::table('settings')->first();
        return view('admin-panel.settings.setting',$data); 
    }
    public function settingSave(Request $request){
        $validation = [
            'title' => 'required|string|max:255',
        ];
        if ($request->hasFile('logo1')) {
            $validation['logo1'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        if ($request->hasFile('logo2')) {
            $validation['logo2'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        if ($request->hasFile('sponsorship_by_logo')) {
            $validation['sponsorship_by_logo'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($validation);
        $settingDetail = [
            'title'=>$request->title,
        ];
        if ($request->hasFile('logo1')) {
            $logo1 = $request->file('logo1');
            $logo1_name = date('d-m-Y') . '-' . time() . '-' . $logo1->getClientOriginalName();
            $logo1->move(public_path('settings'), $logo1_name);
            $settingDetail['logo1'] = $logo1_name;
        }
        if ($request->hasFile('logo2')) {
            $logo2 = $request->file('logo2');
            $logo2_name = date('d-m-Y') . '-' . time() . '-' . $logo2->getClientOriginalName();
            $logo2->move(public_path('settings'), $logo2_name);
            $settingDetail['logo2'] = $logo2_name;
        }
        if ($request->hasFile('sponsorship_by_logo')) {
            $sponsorship_by_logo = $request->file('sponsorship_by_logo');
            $sponsorship_by_logo_name = date('d-m-Y') . '-' . time() . '-' . $sponsorship_by_logo->getClientOriginalName();
            $sponsorship_by_logo->move(public_path('settings'), $sponsorship_by_logo_name);
            $settingDetail['sponsorship_by_logo'] = $sponsorship_by_logo_name;
        }
        $checkData = DB::table('settings')->count();
        if($checkData){
            DB::table('settings')->update( $settingDetail);
            return back()->with('success', 'Setting updated successfully!'); 
        }
        else{
            DB::table('settings')->insert( $settingDetail); 
            return back()->with('success', 'Setting Inerted successfully!'); 
        }
    }
    public function changePassword(){
        return view('admin-panel.settings.change-password');  
    }
    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255',
        ]);
        $user = DB::table('users')->where('id',Auth::user()->id)->first();
        if ($user) {
            if (Hash::check($request->old_password, $user->password)) {
                $change_password = [
                    'password'=>Hash::make($request->new_password),
                    'normal_password'=>$request->new_password,
                ];
                DB::table('users')->where('id',$user->id)->update($change_password);
                Auth::logout();
                return redirect()->route('admin-login')->with('success', 'Password updated successfully.');
            } 
            return redirect()->back()->with('error', 'The old password is incorrect.');
        }
        return redirect()->back()->with('error', 'User Not Found.');
    }
    public function nearMeList(Request $request){

        if ($request->ajax()) {
            $query = DB::table('near_me')
            ->select('near_me.id', 'near_me.name', 'near_me.status', 'ayodhya_dham_temples.name as temple_name','near_me.photo','near_me.distance')
            ->join('ayodhya_dham_temples', 'near_me.temple_id', '=', 'ayodhya_dham_temples.id')
            ->orderBy('near_me.id', 'desc');
            if ($request->filled('name')) {
                $query->where('near_me.name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('status')) {
                $query->where('near_me.status', 'like', '%' . $request->status . '%');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                 ->addColumn('distance', function($row){
                    return checkVal($row->distance);
                })
                ->addColumn('status', function($row){
                    return $row->status==1?"<button class='btn btn-success near-me-status'  data-id='{$row->id}' data-status='1'>Active</button>":"<button class='btn btn-danger near-me-status' data-id='{$row->id}' data-status='0'>In-Active</button>";
                })
                ->addColumn('photo', function($row) {
                    return $row->photo ? '<a href="'.asset('near-me/'.$row->photo) .'" target="_blank"><img src="' . asset('near-me/'.$row->photo) . '" alt="Other Temples" style="width:30px; height:30px;"></a>' : "N/A";
                })
                ->addColumn('action', function($row) {
                    return '<a href="#" class="btn btn-primary">Edit</a>';
                })
                ->rawColumns(['photo', 'action','status'])
                ->make(true);
        }
        return view('admin-panel.ayodhya-dham.temples.list-near-me'); 
    }
    public function addNearMe(){
        $data['ayodhyaDhamTemple'] = DB::table('ayodhya_dham_temples')->where('status',1)->get();
        return view('admin-panel.ayodhya-dham.temples.add-near-me',$data);
    }
    public function saveNearMe(Request $request){
        $validation = [
            'temple_id' => 'required|exists:ayodhya_dham_temples,id',
            'name' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string|max:2048',
        ];
        $request->validate($validation);
        $nearMe = [
            'temple_id' => $request->temple_id,
            'name' => $request->name,
            'distance' => $request->distance,
            'description' => $request->description,
        ];
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = date('d-m-Y') . '-' . time() . '-' . $photo->getClientOriginalName();
            $photo->move(public_path('near-me'), $photo_name);
            $nearMe['photo'] = $photo_name;
        }
        DB::table('near_me')->insert( $nearMe); 
        return redirect()->route('adminNearMeList')->with('success', 'Temple Near Me Added Successfully.');    

    }
    public function nearMeUpdateStatus(Request $request){
        DB::table('near_me')->where('id', $request->nearMeId)->update(['status'=>$request->newStatus]);
        return response()->json(['message' => 'Status updated successfully','status'=>200]);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('admin-login')->with('error', 'Your account has been logged out successfully');    
    }
}
