<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use SoftDeletes;
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    public $table = 'locations';

    public $fillable = [
        'name',
        'description',
        'postcode',
        'settlement_id',
        'address'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'address' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string',
        'description' => 'nullable|string',
        'postcode' => 'nullable',
        'settlement_id' => 'nullable',
        'address' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function deliveries(): string|HasMany
    {
        return $this->hasMany(Delivery::class, 'location_id');
    }

    public function settlement(): string|BelongsTo
    {
        return $this->belongsTo(Settlements::class, 'settlement_id');
    }

}
