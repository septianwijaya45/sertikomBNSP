<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ArsipController extends Controller
{
    function getDataIndex(Request $request){
        $data = DB::select("
            SELECT id, nomor_surat, kategori, judul, file, created_at
            FROM arsips
        ");
        if($request->ajax()){
            return \DataTables::of($data)
                        ->addColumn('Actions', function($data){
                            return '
                            <button class="btn btn-danger btn-sm " onClick="confirmDelete('.$data->id.')">Hapus</button>
                            <a href="'.route('arsip.download', $data->file).'"><button class="btn btn-warning btn-sm">Unduh</button></a>
                            <a href="'.route('arsip.detail', $data->id).'"><button class="btn btn-primary btn-sm">Lihat >></button></a>
                        ';
                        })
                        ->rawColumns(['Actions'])
                        ->addIndexColumn()
                        ->make(true);
        }

        // test backend postman
        return response()->json(['data' => $data]); 
    }

    function index(){
        return view('arsip.index');
    }

    function insert(){
        return view('arsip.insert');
    }

    function store(Request $request){
        $validate = Validator::make($request->all(), [
            'nomor_surat'       => 'required',
            'kategori'          => 'required',
            'judul'             => 'required',
            'file'              => 'required|mimes:pdf|max:2500'
        ], [
            'nomor_surat.required'  => 'Nomor Surat Harus Diisi!',
            'kategori.required'     => 'Kategori Harus Dipilih!',
            'judul.required'        => 'Judul Harus Diisi!',
            'file.required'         => 'File Harus Diisi!',
            'file.mimes'            => 'File Harus Berupa .pdf!',
            'file.max'              => 'Ukuran File Maksimal 2,5mb!'
        ]);

        if($validate->fails()){
            return response()->json(['errors' => $validate->errors()->all()]);
        }

        // File Upload Code
        $file = $request->file;
        $nameFile = time().'_'.$file->getClientOriginalName();
        $target = 'berkas';
        $file->move($target, $nameFile);

        // Store Data
        $arsip = Arsip::insert([
            'nomor_surat'       => $request->nomor_surat,
            'kategori'          => $request->kategori,
            'judul'             => $request->judul,
            'file'              => $nameFile,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now()
        ]);

        // test backend postman
        return response()->json([
            'message'   => 'Success',
            'data' => $arsip
        ]);
    }

    function detail($id){
        $arsip = Arsip::where('id', $id)->first();

        // test backend postman
        // return response()->json([
        //     'message'       => 'Success',
        //     'data'          => $arsip
        // ]);
        return view('Arsip.detail', compact(['arsip']));
    }

    function destroy($id){
        try {
            $arsip = Arsip::where('id', $id)->first();
            if(empty($arsip)){
                return response()->json(['messages' => 'Data Tidak Ditemukan!']);
            }else{
                Arsip::where('id', $id)->delete();
                File::delete('berkas/'.$arsip->file);
                return response()->json([
                    'message'       => 'Success Delete',
                    'data'          => $arsip
                ]);
            }
        } catch (\Exception $e) {
             throw new HttpException(500, $e->getMessage());
        }
    }


    function search(Request $request, $judul){
        $arsip = DB::select("
            SELECT id, nomor_surat, kategori, judul, file, created_at
            FROM arsips
            WHERE judul LIKE '%{$judul}%'
        ");
        if($request->ajax()){
            return \DataTables::of($arsip)
                        ->addColumn('Actions', function($arsip){
                            return '
                            <button class="btn btn-danger btn-sm " onClick="confirmDelete('.$arsip->id.')">Hapus</button>
                            <a href="Arsip/unduh-data/'.$arsip->id.'"><button class="btn btn-warning btn-sm">Unduh</button></a>
                            <a href="Arsip/detail-data/'.$arsip->id.'"><button class="btn btn-primary btn-sm">Lihat >></button></a>
                        ';
                        })
                        ->rawColumns(['Actions'])
                        ->addIndexColumn()
                        ->make(true);
        }
        // return response()->json([
        //     'messages'      => 'Success',
        //     'data'          => $arsip
        // ]);
    }

    function download($file){
        return response()->download(public_path('berkas/'.$file));
    }
}
