<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
    }
    public function dashboard(Request $request)
    {
        return view('dashboard', ['request' => $request]);
    }

    public function login(Request $request)
    {
        if (!Auth::check()) {
            return view('login', ['request' => $request]);
        } else {
            return redirect(url('/'));
        }
    }

    public function login_action(Request $request)
    {
        // Melakukan pengecekan di form
        // cek email apakah terisi dan benar
        // cek password apakah terisi

        $validasi = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];

        $pesan = [
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Email yang kamu masukan salah',
            'password.required' => 'Password Wajib Di isi',
        ];

        $remember = $request->filled('remember_me');
        $credentials = $request->validate($validasi, $pesan);
        /*
        dd($credentials); Hasilnya Array, bukan boolean:
        array:2 [▼ // app\Http\Controllers\AuthController.php:44
        "email" => "nurdiantoro100@gmail.com"
        "password" => "123"
        ]
        */

        if (Auth::attempt($credentials, $remember)) {
            // if (Auth::attempt($credentials)) {
            // return 'berhasil';

            $request->session()->regenerate();
            // $user= Auth::id();
            // $user= Auth::user()->email;
            // dd($user);

            return redirect(url('/'));
        } else {
            return back();
        }
    }

    public function register(Request $request)
    {
        return view('register', ['request' => $request]);
    }

    public function register_action(Request $request)
    {
        $validasi = [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
        $pesan = [
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Email yang kamu masukan salah',
            'email.unique' => 'Email yang kamu gunakan sudah terdaftar',
            'password.required' => 'Password Wajib Di isi',
        ];

        // validate otomatis return back() kalo ada yang salah
        $request->validate($validasi, $pesan);
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => 'user.png',
        ]);

        // mengirim email verifikasi
        event(new Registered($user));

        // Login User
        if ($user) {
            // Perbedaan Auth::login sama Auth::attempt
            // baca di chatGPT
            Auth::login($user);
            return redirect(url('/'));
        } else {
            return back()->with($pesan);
        }
    }

    public function update_user(Request $request)
    {
        if ($request->email == Auth::user()->email) {
            $cek_email = '';
        } else {
            $cek_email = 'unique:users';
        }

        $validasi = [
            'nama' => ['required'],
            'email' => ['required', 'email', $cek_email],
        ];

        $pesan = [
            'nama.required' => 'Nama Wajib Di isi',
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Email yang kamu masukan salah',
            'email.unique' => 'Email yang kamu gunakan sudah terdaftar',
        ];

        // Lakukan validasi pada form update user
        $request->validate($validasi, $pesan);


        // Simpan foto ke Directory public/img/
        if ($request->hasFile('foto')) {
            $data_file = $request->file('foto');
            $nama_file = Str::slug(time() . '_' . Auth::user()->name) . '.' . $data_file->getClientOriginalExtension();
            $data_file->move(public_path('img'), $nama_file);
        } else {
            $nama_file = Auth::user()->foto;
        }

        // dd($nama_file);
        // Update data user
        User::find(Auth::user()->id)->update([
            'name' => $request->nama,
            'email' => $request->email,
            'foto' => $nama_file,
        ]);
        return redirect(url('/user_detail'))->with('pesan', 'Data berhasil diubah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(url('login'));
    }

    /*
    |--------------------------------------------------------------------------
    | Forgot Password
    | dari request forgot password sampai membuat password baru
    |--------------------------------------------------------------------------
    */
    public function forgot_password()
    {
        return view('forgot_password');
    }

    public function forgot_password_request(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Email verifikasi sudah terkirim'])
            : back()->withErrors(['email' => 'Email yang kamu masukan belum terdaftar']);
    }

    public function forgot_password_redirect_dari_email(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }

    public function forgot_password_form(string $token)
    {
        return view('forgot_password_form', ['token' => $token]);
    }

    public function forgot_password_action(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        $credentials = $request->only('email', 'password', 'token');
        $callback = function (User $user, string $password) {
            $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        };

        $status = Password::reset($credentials, $callback);

        return $status === Password::PASSWORD_RESET
            ? redirect(url('/'))->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
