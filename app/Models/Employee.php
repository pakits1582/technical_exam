<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'factory_id',
        'email',
        'phone',
    ];

    public function employee_factory()
    {
        return $this->belongsTo(Factory::class, 'factory_id');
    }
}
