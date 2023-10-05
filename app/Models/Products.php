<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Barryvdh\DomPDF\Tests\TestCase;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Products
 * @package App\Models
 * @version February 2, 2023, 8:58 am UTC
 *
 * @property string $name
 * @property integer $quantities_id
 * @property integer $price
 * @property string $description
 * @property integer $active
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

    public function scopeActiveProducts($query): mixed
    {
        return $query->where('active', ActiveEnum::ACTIVE->value);
    }

    public function scopeInactiveProducts($query): mixed
    {
        return $query->where('active', ActiveEnum::INACTIVE->value);
    }
}
