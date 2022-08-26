<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Appointment;
use App\models\Dokter;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function addAppointment(Request $request){
        $waktu_berkunjung = $request->tanggal_berkunjung . ' ' . $request->jam_berkunjung . ':00';
        $dokter = Dokter::where('id', $request->id_dokter)->first();
        $total = Appointment::whereDate('tanggal_berkunjung', '=', $request->tanggal_berkunjung )->get()->count();

        $create = new Appointment;
        $create->id_user = $request->id_user;
        $create->id_dokter = $request->id_dokter;
        $create->biaya = $dokter->biaya;
        $create->nomor_urut = $total + 1;
        $create->diagnosa = $request->diagnosa;
        $create->tanggal_berkunjung = $waktu_berkunjung;
        $create->save();

        if($create){
            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }

    public function detailAppointment(Request $request, $id){
        return Appointment::with([
            'dokter' => function($q){
                $q->with(['specialist:id,name'])->select('id', 'nama', 'email', 'id_specialist', 'id_gender', 'tanggal_lahir', 'mulai_praktek', 'keterangan', 'foto', 'biaya');
            },
            'user' => function($q){
                $q->select('id', 'nama', 'email', 'tanggal_lahir', 'id_gender', 'no_hp', 'berat_badan', 'tinggi_badan', 'foto');
            }
        ])
        ->where('id', $id)->first();
    }

    public function allAppointment(Request $request){
        $history = Appointment::with([
            'dokter' => function($q){
                $q->with(['specialist:id,name'])->select('id', 'nama', 'email', 'id_specialist', 'id_gender', 'tanggal_lahir', 'mulai_praktek', 'keterangan', 'foto', 'biaya');
            },
            'user' => function($q){
                $q->select('id', 'nama', 'email', 'tanggal_lahir', 'id_gender', 'no_hp', 'berat_badan', 'tinggi_badan', 'foto');
            }
        ])
        ->orderBy('created_at', 'asc')
        ->get();
        return ['status' => "success", 'data' => $history, 'message' => 'Success'];
    }
}
