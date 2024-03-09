<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Quantities
 *
 * @package App\Models
 * @version February 2, 2023, 8:57 am UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Orderdetails> $orderDetails
 * @property-read int|null $order_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Products> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\QuantitiesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Quantities withoutTrashed()
 * @mixin \Eloquent
 */
class Quantities extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'quantities';

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

    public function products(): string|HasMany
    {
        return $this->hasMany(Products::class, 'quantities_id');
    }

    public function orderDetails(): string|HasMany
    {
        return $this->hasMany(Orderdetails::class, 'quantities_id');
    }
}
