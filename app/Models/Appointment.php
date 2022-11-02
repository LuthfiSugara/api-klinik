<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'appointment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_dokter',
        'nomor_urut',
        'biaya',
        'tanggal_berkunjung',
        'diagnosa',
        'status',
        'ispay',
    ];

    public function dokter(){
        return $this->belongsTo(User::class, 'id_dokter', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status', 'id');
    }

    public function getTanggalBerkunjungAttribute($value){
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $value, 'Asia/Jakarta');
        $date->setTimezone('UTC');
        return $date;
    }
}
