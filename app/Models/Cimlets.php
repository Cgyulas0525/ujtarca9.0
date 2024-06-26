<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Cimlets
 *
 * @package App\Models
 * @version January 2, 2023, 3:04 pm UTC
 * @property string $name
 * @property integer $value
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClosureCimlets> $closurecimlets
 * @property-read int|null $closurecimlets_count
 * @method static \Database\Factories\CimletsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cimlets withoutTrashed()
 * @mixin Model
 */
class Cimlets extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cimlets';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'value',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'value' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'value' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function closurecimlets(): string|HasMany
    {
        return $this->hasMany(ClosureCimlets::class, 'cimlets_id');
    }

}
