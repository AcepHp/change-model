<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDetailCs extends Model
{
    protected $table = 'log_detail_cs';
    protected $primaryKey = 'id_det';
    public $timestamps = false;

    protected $fillable = [
        'id_log',
        'station',
        'check_item',
        'standard',
        'actual',
    ];

    public function log()
    {
        return $this->belongsTo(LogCs::class, 'id_log', 'id_log');
    }
}
