<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ClosureCimlets
 *
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 * @property integer $closures_id
 * @property integer $cimlets_id
 * @property integer $value
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Cimlets|null $cimlets
 * @property-read \App\Models\Closures|null $closures
 * @property-read int $cash
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets closureClosureCimlets($id)
 * @method static \Database\Factories\ClosureCimletsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereCimletsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereClosuresId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClosureCimlets withoutTrashed()
 * @mixin Model
 */
class ClosureCimlets extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'closurecimlets';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'closures_id',
        'cimlets_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'closures_id' => 'integer',
        'cimlets_id' => 'integer',
        'value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'closures_id' => 'required|integer',
        'cimlets_id' => 'required|integer',
        'value' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = [
        'cash',
    ];


    public function closures(): string|BelongsTo
    {
        return $this->belongsTo(Closures::class, 'closures_id');
    }

    public function cimlets(): string|BelongsTo
    {
        return $this->belongsTo(Cimlets::class, 'cimlets_id');
    }

    public function getCashAttribute(): int
    {
        return $this->value * $this->cimlets->value;
    }

    public function scopeClosureClosureCimlets($query, $id): mixed
    {
        return $query->where('closures_id', $id);
    }

}
