<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;

    protected $fillable = [
    'judul',
    'deskripsi',
    'jenis',
    'status',
    'tanggal_pesanan',
    'deadline_pesanan',
    'user_id',
    'hasil_file',
    'bukti_pembayaran',
    'status_pembayaran',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
{
    return $this->hasOne(\App\Models\Project::class);
}


}
