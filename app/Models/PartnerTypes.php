<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PartnerTypes
 *
 * @package App\Models
 * @version January 2, 2023, 3:52 pm UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partners> $partners
 * @property-read int|null $partners_count
 * @method static \Database\Factories\PartnerTypesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerTypes withoutTrashed()
 * @mixin Model
 */
class PartnerTypes extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'partnertypes';

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
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function partners(): string|HasMany
    {
        return $this->hasMany(Partners::class, 'partnertypes_id');
    }
}
