<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Employee::where('nama','LIKE','%'.$request->search.'%')->paginate(5);
        }else{
            $data = Employee::paginate(5);
            Session::put('halaman_url',request()->fullUrl());
        }

        return view("datapegawai",compact('data'));
    }
    public function tambahpegawai(){
        return view('tambahdata');
    }
    public function insertdata(Request $request){

        $this->validate($request,[
                'nama' => 'required|min:7|max:20',
                'notelpon' => 'required|min:11|max:12',
        ]);

        $data = Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data berhasil ditambahkan');
    }
    public function show($id){
        $data = Employee::find($id);
        //dd($data);

        return view('editdata',compact('data'));
    }
    public function edit(Request $request,$id){
        $data = Employee::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return redirect(session('halaman_url'))->with('success','Data berhasil dirubah');
        }

        return redirect()->route('pegawai')->with('success','Data berhasil dirubah');
    }
    public function delete($id){
        $data = Employee::find($id);
        $data->delete();

        return redirect()->route('pegawai')->with('success','Data berhasil dihapus');

    }
    public function exportpdf(){
        $data = Employee::all();
        view()->share('data',$data);
        
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }
    public function exportexcel(){
        return Excel::download(new EmployeeExport,'datapegawai.xlsx');
    }
    public function importexcel(Request $request){
        $data = $request->file('file');
        
        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData',$namafile);

        Excel::import(new EmployeeImport,\public_path('/EmployeeData/'.$namafile));
        return \redirect()->back();
    }
}
