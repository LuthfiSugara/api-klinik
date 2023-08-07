<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\DetailConsultation;

class ConsultationController extends Controller
{
    public function addConsultation(Request $request){
        $consultation = new Consultation;
        $consultation->consultation = $request->consultation;
        $consultation->id_dokter = $request->id_dokter;
        $consultation->id_user = $request->id_user;
        $consultation->save();

        if($consultation){
            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }

    public function addDetailConsultation(Request $request){
        $detail = new DetailConsultation;
        $detail->id_consultation = $request->id_consultation;
        $detail->detail = $request->detail;
        $detail->id_user = $request->id_user;
        $detail->save();

        if($detail){
            return ['status' => "success", 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }

    public function getConsultation(Request $request){
        $consultation = new Consultation();
        $consultation = $consultation->with([
            'dokter' => function($q){
                $q->select('id', 'nama');
            },
            'pasien' => function($q){
                $q->select('id', 'nama');
            }
        ]);
        $consultation = $consultation->orderBy('created_at', 'desc');
        if($request->user()->id_level == 2){
            $consultation = $consultation->where('id_user', $request->user()->id);
        }
        if($request->user()->id_level == 3){
            $consultation = $consultation->where('id_dokter', $request->user()->id);
        }
        $consultation = $consultation->get();

        if($consultation){
            return ['status' => "success", 'data' => $consultation, 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }

    public function getDetailConsultation(Request $request, $id){
        $detail = Consultation::with([
            'dokter' => function($q){
                $q->select('id', 'nama', 'foto');
            },
            'pasien' => function($q){
                $q->select('id', 'nama', 'foto');
            },
            'detail' => function($q){
                $q->with([
                    'user' => function($q){
                        $q->select('id', 'nama', 'foto');
                    },
                ])->select('id', 'detail', 'id_consultation', 'id_user', 'created_at');
            }
        ])
        ->orderBy('created_at', 'desc')
        ->where('id', $id)
        ->first();

        if($detail){
            return ['status' => "success", 'data' => $detail, 'message' => 'Success'];
        }else{
            return ['status' => "fail", 'message' => 'Failed'];
        }
    }
}
