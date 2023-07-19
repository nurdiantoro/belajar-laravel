<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class UpdateController extends Controller {
    public function index( Request $request ) {
        $mahasiswa = DB::table( 'mahasiswa' )->get();
        // dd( $mahasiswa );
        return view( 'update', [ 'mahasiswa'=>$mahasiswa, 'request'=>$request ] );
    }

    public function detail( $id ) {
        $mahasiswa = DB::table( 'mahasiswa' )->where( 'id', $id )->first();
        // dd( $mahasiswa );
        return view( 'update_detail', [ 'mahasiswa'=>$mahasiswa ] );
    }

    public function action( Request $request ) {
        $id = $request->id;
        $mahasiswa = MahasiswaModel::find( $id );
        // dd( $mahasiswa );

        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->email = $request->email;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->save();
        $request->session()->flash( 'pesan', 'Berhasil mengubah data Mahasiswa' );

        return redirect( '/update' );
    }
}
