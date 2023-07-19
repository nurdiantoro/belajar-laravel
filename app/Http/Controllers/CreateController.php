<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaModel;

class CreateController extends Controller {
    public function index( Request $request ) {
        return view( 'create', [ 'request'=>$request ] );
        // dd( $request );
    }

    public function action( Request $request ) {
        $mahasiswa = new MahasiswaModel;

        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->email = $request->email;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;

        // dd( $mahasiswa );
        $mahasiswa->save();
        $request->session()->flash( 'pesan', 'Berhasil menambah Mahasiswa' );

        return redirect( '/create' );
    }
}
