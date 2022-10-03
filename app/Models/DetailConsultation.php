<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DetailConsultation extends Model
{
    use HasFactory;

    protected $table = 'detail_consultation';
    protected $primaryKey = 'id';

    protected $fillable = [
        'detail',
        'id_consultation',
        'id_user',
    ];

    protected $appends = [
        'posting_time'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
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
