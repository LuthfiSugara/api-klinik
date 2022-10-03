<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DetailDokter extends Model
{
    use HasFactory;
    protected $table = 'detail_dokter';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_dokter',
        'id_specialist',
        'mulai_praktek',
        'keterangan',
        'biaya',
    ];

    protected $appends = [
        'lama_kerja'
    ];

    public function specialist(){
        return $this->belongsTo(Specialist::class, 'id_specialist', 'id');
    }

    public function getLamaKerjaAttribute(){
        $date = Carbon::parse($this->mulai_praktek);
        $now = Carbon::now();
        $diffYears = $date->diffInYears($now);
        $diffMonths = $date->diffInMonths($now);
        if($diffYears > 0){
            return $diffYears . " Tahun";
        }else{
            return $diffMonths . " Bulam";
        }
    }
}
