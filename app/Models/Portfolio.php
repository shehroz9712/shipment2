<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id', 'image', 'status', 'is_on_home', 'order'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
