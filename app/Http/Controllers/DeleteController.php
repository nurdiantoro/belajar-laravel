<?php

namespace App\Http\Controllers;
use App\Models\MahasiswaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DeleteController extends Controller {
    public function index( Request $request ) {
        $mahasiswa = DB::table( 'mahasiswa' )->get();
        return view( 'delete', [ 'mahasiswa'=>$mahasiswa, 'request'=>$request ] );
    }

    public function action( $id, Request $request ) {
        $mahasiswa = MahasiswaModel::find( $id );
        $mahasiswa->delete();
        $request->session()->flash( 'pesan', 'Berhasil menghapus Mahasiswa' );

        return redirect( '/delete' );
    }
}
