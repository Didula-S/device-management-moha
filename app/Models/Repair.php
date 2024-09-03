<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Repair extends Model
{
    use HasFactory;

    // Remove or comment out this line
    // protected $table = 'repair_details';

    protected $fillable = [
        'device_id',
        'repair_agent_id',
        'repair_date',
        'repair_type',
        'description',
        'status',
        'start_date',
        'end_date',
        'price',
    ];

    protected $casts = [
        'repair_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2',
    ];

    protected $dates = ['repair_date', 'start_date', 'end_date'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function repairAgent()
    {
        return $this->belongsTo(RepairAgent::class);
    }
}