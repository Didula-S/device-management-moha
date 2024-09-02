<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'name',
        'department_id',
        'purchase_date',
        'warranty_expiration_date',
        'working_status',
        'invoice_image',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function updateWorkingStatus()
    {
        $activeRepair = $this->repairs()->where('status', 'In Progress')->first();
        $this->working_status = $activeRepair ? 'Under Repair' : 'Working';
        $this->save();
    }
}