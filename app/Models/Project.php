<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['order_id', 'status', 'is_published'];

    public function order()
{
    return $this->belongsTo(\App\Models\Order::class);
}

}
