<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailDokter;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    public function index(){
        $dokter = User::with([
            'gender' => function($q){
                $q->select('id', 'name');
            },
            'detail' => function($q){
                $q->with('specialist:id,name')->select('id', 'id_dokter', 'id_specialist', 'mulai_praktek', 'keterangan', 'biaya');
            },
        ])
        ->where('id_level', 3)
        ->orderBy('updated_at', 'desc')
        ->get();
        return ['status' => "success", 'data' => $dokter, 'message' => 'Success'];
    }

    public function detailDokter($id){
        $dokter = User::with([
            'gender' => function($q){
                $q->select('id', 'name');
            },
            'detail' => function($q){
                $q->with('specialist:id,name')->select('id', 'id_dokter', 'id_specialist', 'mulai_praktek', 'keterangan', 'biaya');
            },
        ])
        ->where('id', $id)
        ->first();
        return ['status' => "success", 'data' => $dokter, 'message' => 'Success'];
    }

    public function addDokter(Request $request){
        $validator = Validator::make(['email' => $request->email],
            [
                'email' => ['unique:dokter']
            ]
        );

        if($validator->fails()){
            return ['status' => "fail", 'message' => 'Email sudah terdaftar'];
        }else{

            $foto = $request->foto;
            if($request->id_gender == 1){
                $file_name = '/assets/images/default/doctor-male.jpg';
            }else{
                $file_name = '/assets/images/default/doctor-female.jpg';
            }

            if ($foto) {
                $file_name = '/assets/images/dokter/' . $request->nama . time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('/assets/images/dokter/'), $file_name);
            }

            $create = Dokter::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'id_specialist' => $request->id_specialist,
                'id_level' => $request->id_level,
                'id_gender' => $request->id_gender,
                'tanggal_lahir' => $request->tanggal_lahir,
                'mulai_praktek' => $request->mulai_praktek,
                'keterangan' => $request->keterangan,
                'foto' => $file_name,
                'biaya' => $request->biaya,
            ]);

            if($create){
                return ['status' => "success", 'message' => 'Success'];
            }else{
                return ['status' => "fail", 'message' => 'Failed'];
            }
        }
    }

    public function editDokter(Request $request, $id){
        $dokter = User::where('id', $id)->first();
        $foto = $request->foto;
        $file_name = $dokter->foto;

        if ($foto) {
            $file_name = '/assets/images/dokter/' . $request->nama . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('/assets/images/dokter/'), $file_name);
        }

        $dokter->nama = $request->nama;
        if($request->password){
            $dokter->password = bcrypt($request->password);
        }

        $dokter->id_gender = $request->id_gender;
        $dokter->tanggal_lahir = $request->tanggal_lahir;
        $dokter->foto = $file_name;
        $dokter->save();

        $detail = DetailDokter::where('id_dokter', $id)->first();
        $detail->id_specialist = $request->id_specialist;
        $detail->mulai_praktek = $request->mulai_praktek;
        $detail->keterangan = $request->keterangan;
        $detail->biaya = $request->biaya;
        $detail->save();

        if($dokter){
            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }

    public function deleteDokter($id){
        $delete = Dokter::where('id', $id)->delete();
        if($delete){
            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }
}
