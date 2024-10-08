<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

    protected $fillable = [
        'user_id',
        'plate_number',
    ];

    // Relasi One To Many
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
