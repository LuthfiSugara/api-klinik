<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Consultation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consultation';
    protected $primaryKey = 'id';

    protected $fillable = [
        'consultation',
        'id_dokter',
        'id_user',
        "has_read"
    ];

    protected $appends = [
        'posting_time'
    ];

    public function dokter(){
        return $this->belongsTo(User::class, 'id_dokter', 'id');
    }

    public function pasien(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function detail(){
        return $this->hasMany(DetailConsultation::class, 'id_consultation', 'id');
    }

    public function getPostingTimeAttribute(){
        $diff = Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
        $arrTime = explode(" ", $diff);
        $descTime = "";

        if($arrTime[1] == "seconds" || $arrTime[1] == "second"){
            $descTime = " detik yang lalu";
        }else if($arrTime[1] == "minutes" || $arrTime[1] == "minute"){
            $descTime = " menit yang lalu";
        }else if($arrTime[1] == "hours" || $arrTime[1] == "hour"){
            $descTime = " jam yang lalu";
        }else if($arrTime[1] == "weeks" || $arrTime[1] == "week"){
            $descTime = " minggu yang lalu";
        }else if($arrTime[1] == "months" || $arrTime[1] == "month"){
            $descTime = " bulan yang lalu";
        }else if($arrTime[1] == "years" || $arrTime[1] == "year"){
            $descTime = " tahun yang lalu";
        }else{
            $descTime = "";
        }

        return $arrTime[0] . $descTime;
    }
}
