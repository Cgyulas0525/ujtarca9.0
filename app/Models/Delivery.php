<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use SoftDeletes;
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    public $table = 'deliveries';

    public $fillable = [
        'delivery_number',
        'date',
        'location_id',
        'description'
    ];

    protected $casts = [
        'delivery_number' => 'string',
        'date' => 'date',
        'description' => 'string'
    ];

    public static array $rules = [
        'delivery_number' => 'required|string',
        'date' => 'required',
        'location_id' => 'required',
        'description' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function location(): string|BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function orders(): string|HasMany
    {
        return $this->hasMany(Orders::class, 'delivery_id');
    }
}