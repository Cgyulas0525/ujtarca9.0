<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Settlements
 *
 * @package App\Models
 * @version January 3, 2023, 2:33 pm UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property int $postcode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Location> $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partners> $partners
 * @property-read int|null $partners_count
 * @method static \Database\Factories\SettlementsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlements withoutTrashed()
 * @mixin Model
 */
class Settlements extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'settlements';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
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
        'postcode' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'postcode' => 'nullable|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function partners(): string|HasMany
    {
        return $this->hasMany(Partners::class, 'settlement_id');
    }

    public function locations(): string|HasMany
    {
        return $this->hasMany(Location::class, 'settlement_id');
    }
}
