<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Products
 *
 * @package App\Models
 * @version February 2, 2023, 8:58 am UTC
 * @property string $name
 * @property integer $quantities_id
 * @property integer $price
 * @property string $description
 * @property integer $active
 * @property int $id
 * @property int|null $supplierprice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Component> $components
 * @property-read int|null $components_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Feature> $features
 * @property-read int|null $features_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Orderdetails> $orderdetails
 * @property-read int|null $orderdetails_count
 * @property-read \App\Models\Quantities|null $quantities
 * @method static \Illuminate\Database\Eloquent\Builder|Products activeProducts()
 * @method static \Database\Factories\ProductsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Products inactiveProducts()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereQuantitiesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSupplierprice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Products withoutTrashed()
 * @mixin Model
 */
class Products extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'quantities_id',
        'price',
        'supplierprice',
        'description',
        'active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'quantities_id' => 'integer',
        'price' => 'integer',
        'supplierprice' => 'integer',
        'description' => 'string',
        'active' => ActiveEnum::class,
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'quantities_id' => 'required|integer',
        'price' => 'required|integer',
        'supplierprice' => 'nullable|integer',
        'description' => 'nullable|string|max:500',
        'active' => 'required|string|max:25',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function quantities(): string|BelongsTo
    {
        return $this->belongsTo(Quantities::class, 'quantities_id');
    }

    public function orderdetails(): string|HasMany
    {
        return $this->hasMany(Orderdetails::class, 'products_id');
    }

    public function components(): array|BelongsToMany
    {
        return $this->belongsToMany(Component::class, 'component_product')
            ->withPivot('value');
    }

    public function features(): array|BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'feature_product')
            ->withPivot('value');
    }

    public function scopeActiveProducts($query): mixed
    {
        return $query->where('active', ActiveEnum::ACTIVE->value);
    }

    public function scopeInactiveProducts($query): mixed
    {
        return $query->where('active', ActiveEnum::INACTIVE->value);
    }
}
