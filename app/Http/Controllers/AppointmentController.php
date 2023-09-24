<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function addAppointment(Request $request){
        $waktu_berkunjung = $request->tanggal_berkunjung . ' ' . $request->jam_berkunjung . ':00';
        $dokter = User::with([
            'detail' => function($q){
                $q->with('specialist:id,name')->select('id', 'id_dokter', 'id_specialist', 'mulai_praktek', 'keterangan', 'biaya');
            },
        ])
        ->where('id', $request->id_dokter)
        ->first();

        $total = Appointment::where('tanggal_berkunjung', '=', $waktu_berkunjung)->count();
        
        if($total <= 4){
            $create = new Appointment;
            $create->id_user = $request->id_user;
            $create->id_dokter = $request->id_dokter;
            $create->biaya = $dokter->detail->biaya;
            $create->nomor_urut = $total + 1;
            $create->status = 2;
            $create->diagnosa = $request->diagnosa;
            $create->tanggal_berkunjung = $waktu_berkunjung;
            $create->save();

            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Antrian sudah penuh'];
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
        $history = new Appointment();
        $history = $history->with([
            'dokter' => function($q){
                $q->with([
                    'detail' => function($q2){
                        $q2->with(['specialist:id,name'])->select('id_dokter', 'id_specialist', 'mulai_praktek', 'keterangan', 'biaya');
                    }
                ])
                ->select('id', 'nama', 'email', 'tanggal_lahir', 'id_gender', 'no_hp', 'berat_badan', 'tinggi_badan', 'foto');
            },
            'user' => function($q){
                $q->select('id', 'nama', 'email', 'tanggal_lahir', 'id_gender', 'no_hp', 'berat_badan', 'tinggi_badan', 'foto');
            },
            'status' => function($q){
                $q->select('id', 'name');
            },
            // 'detail' => function($q){
            //     $q->select('id', 'name');
            // },
        ]);
        if($request->user()->id_level === 2){
            $history = $history->where('id_user', $request->user()->id);
        }
        if($request->user()->id_level === 3){
            $history = $history->where('id_dokter', $request->user()->id);
        }
        $history = $history->orderBy('created_at', 'desc');
        $history = $history->get();

        return ['status' => "success", 'data' => $history, 'message' => 'Success'];
    }

    public function allUserAppointment(Request $request){
        return $request->user()->id;
        $history = new Appointment();
        $history = $history->with([
            'dokter' => function($q){
                $q->with(['specialist:id,name'])->select('id', 'nama', 'email', 'id_specialist', 'id_gender', 'tanggal_lahir', 'mulai_praktek', 'keterangan', 'foto', 'biaya');
            },
            'user' => function($q){
                $q->select('id', 'nama', 'email', 'tanggal_lahir', 'id_gender', 'no_hp', 'berat_badan', 'tinggi_badan', 'foto');
            },
            'status' => function($q){
                $q->select('id', 'name');
            }
        ]);
        if($request->user()->id_level === 2){
            $history->where('id_user', $request->user()->id);
        }
        if($request->user()->id_level === 3){
            $history->where('id_dokter', $request->user()->id);
        }
        $history->orderBy('created_at', 'desc');
        $history->get();

        return ['status' => "success", 'data' => $history, 'message' => 'Success'];
    }

    public function updateStatusAppointment($id, $id_status){
        $status = Appointment::where('id', $id)->first();
        $status->status = $id_status;
        if($id_status == 1){
            $status->ispay = true;
        }
        $status->save();

        if($status){
            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }

    public function printPayment(){
        return view('print');
    }

    public function getQueueAppointment(Request $request){
        $data = Appointment::with([
            'user' => function($q){
                $q->select('id', 'nama');
            }
        ])
        ->where([
            'id_dokter' => $request->id_dokter,
            'tanggal_berkunjung' => $request->date
        ])
        ->orderBy('created_at', 'asc')
        ->get();

        if($data){
            return ['status' => "success", "data" => $data, 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }
}
