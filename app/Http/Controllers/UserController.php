<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\models\User;
use App\models\ValidationUser;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\models\Gender;
use App\models\Dokter;
use App\models\DetailDokter;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make(['email' => $request->email],
            [
                'email' => ['unique:users']
            ]
        );

        if($validator->fails()){
            return ['status' => "fail", 'message' => 'Email sudah terdaftar'];
        }else{

            $foto = $request->foto;
            if($request->id_gender == 1 && $request->id_level == 3){
                $file_name = '/assets/images/default/doctor-male.jpg';
            }else if($request->id_gender == 2 && $request->id_level == 3){
                $file_name = '/assets/images/default/doctor-female.jpg';
            }else if($request->id_gender == 1){
                $file_name = '/assets/images/default/doctor-male.jpg';
            }else{
                $file_name = '/assets/images/profile/female.jpg';
            }

            if ($foto) {
                $file_name = '/assets/images/profile/' . $request->nama . time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('/assets/images/profile/'), $file_name);
            }

            $user = new User;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->id_gender = $request->id_gender;
            $user->no_hp = $request-> no_hp;
            $user->berat_badan = $request->berat_badan;
            $user->tinggi_badan = $request->tinggi_badan;
            $user->foto = $file_name;
            $user->id_level = $request->id_level;
            $user->save();

            if($request->id_level == 3){
                $detail = new DetailDokter;
                $detail->id_dokter = $user->id;
                $detail->id_specialist = $request->id_specialist;
                $detail->mulai_praktek = $request->mulai_praktek;
                $detail->keterangan = $request->keterangan;
                $detail->biaya = $request->biaya;
                $detail->save();
            }

            // $validation = ValidationUser::create([
            //     'id_user' => $user->id,
            //     'key_validation' => Str::random(16)
            // ]);

            // $data = [
            //     'id_user' => $user->id,
            //     'key_validation' => $validation->key_validation
            // ];

            // \Mail::to($user->email)->send(new \App\Mail\VerificationUser($data));

            if($user){
                return ['status' => "success", 'message' => 'Registrasi Berhasil'];
            }else{
                return ['status' => "fail", 'message' => 'Gagal mendapatkan data'];
            }
        }
    }

    public function updateProfile(Request $request){
        $id = $request->user()->id;
        $user = User::where('id', $id)->first();

        $foto = $request->foto;
        $file_name = $user->foto;

        if ($foto) {
            $file_name = '/assets/images/profile/' . $request->nama . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('/assets/images/profile/'), $file_name);
        }

        $user->nama = $request->nama;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->id_gender = $request->id_gender;
        $user->no_hp = $request-> no_hp;
        $user->berat_badan = $request->berat_badan;
        $user->tinggi_badan = $request->tinggi_badan;
        $user->foto = $file_name;
        $user->save();

        if($user->id_level == 3){
            $detail = DetailDokter::where('id_dokter', $user->id)->first();
            $detail->id_specialist = $request->id_specialist;
            $detail->mulai_praktek = $request->mulai_praktek;
            $detail->keterangan = $request->keterangan;
            $detail->biaya = $request->biaya;
            $detail->save();
        }

        // if($request->password){
        //     // return "Password";
        //     $userUpdate = User::update([
        //         'nama' => $request->nama,
        //         'email' => $request->email,
        //         'password' => bcrypt($request->password),
        //         'tanggal_lahir' => $request->tanggal_lahir,
        //         'id_gender' => $request->id_gender,
        //         'no_hp' => $request-> no_hp,
        //         'berat_badan' => $request->berat_badan,
        //         'tinggi_badan' => $request->tinggi_badan,
        //         'foto' => $file_name,
        //     ])
        //     ->where('id', $id);
        // }else{
        //     // return "not Password";
        //     $userUpdate = User::update([
        //         'nama' => $request->nama,
        //         'email' => $request->email,
        //         'tanggal_lahir' => $request->tanggal_lahir,
        //         'id_gender' => $request->id_gender,
        //         'no_hp' => $request-> no_hp,
        //         'berat_badan' => $request->berat_badan,
        //         'tinggi_badan' => $request->tinggi_badan,
        //         'foto' => $file_name,
        //     ])
        //     ->where('id', $id);
        // }


        if($user){
            return ['status' => "success", 'message' => 'Berhasil mengubah profile'];
        }else{
            return ['status' => "fail", 'message' => 'Gagal mengubah profile'];
        }
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user){
            $user = Dokter::where('email', $request->email)->first();
        }

        if(!$user){
            return ['status' => "fail", 'message' => 'User tidak terdaftar'];
        }else{
            if($user && Hash::check($request->password, $user->password)){
                $token = $user->createToken($request->device_name)->plainTextToken;
                return ['status' => "success", 'access_token' => $token, 'data' => $user];
            }else{
                return ['status' => "fail", 'message' => 'Password Salah'];
            }
        }
    }

    public function profile(Request $request){
        $id = $request->user()->id;

        $user = User::with('gender')
        ->where('id', $id)
        ->first();

        if($user){
            return ['status' => "success", 'data' => $user, 'message' => 'Berhasil mendapatkan data'];
        }else{
            return ['status' => "fail", 'message' => 'Gagal mendapatkan data'];
        }
    }

    public function verificationUser(Request $request, $idUser, $key){
        $user = User::where('id', $idUser)->first();
        $validation = ValidationUser::where([
            'id_user' => $idUser,
            'key_validation' => $key
        ])->first();

        if($user && $validation){
            $user->email_verified_at = Carbon::now();
            $user->save();
            $status = "success";
            return view('verification-result', ['status' => $status]);
            // return ['status' => "fail", 'message' => 'Gagal Memverifikasi Email'];
        }else{
            $status = "fail";
            return view('verification-result', ['status' => $status]);
            // return ['status' => "fail", 'message' => 'Gagal Memverifikasi Email'];
        }
    }

    public function verificationResult(){
        return view('verification-result');
    }
}
