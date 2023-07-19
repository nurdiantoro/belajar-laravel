<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\MahasiswaModel;

class ReadController extends Controller {
    public function index() {
        $mahasiswa = DB::table( 'mahasiswa' )->get();
        // dd( $mahasiswa );
        return view( 'read', [ 'mahasiswa' => $mahasiswa ] );
    }

    public function detail( $id ) {
        $mahasiswa = DB::table( 'mahasiswa' )->where( 'id', $id )->first();
        // dd( $mahasiswa );
        return view( 'read_detail', [ 'mahasiswa' => $mahasiswa ] );
    }
}
