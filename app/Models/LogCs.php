<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogCs extends Model
{
    protected $table = 'log_cs';
    protected $primaryKey = 'id_log';
    public $timestamps = false; // kalau tidak ada created_at, updated_at

    protected $fillable = [
        'area',
        'line',
        'model',
        'shift',
        'date',
    ];

    public function details()
    {
        return $this->hasMany(LogDetailCs::class, 'id_log', 'id_log');
    }
}
