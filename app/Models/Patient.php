<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'address',
        'created_by',
    ];

    protected $casts = [
        'dob'=>'date:Y-m-d',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function dob(): Attribute
{
    return Attribute::make(
        get: fn ($value) => $value ? date('Y-m-d', strtotime($value)) : null,
    );
}
}
