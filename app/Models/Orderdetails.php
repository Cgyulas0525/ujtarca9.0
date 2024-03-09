<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Orderdetails
 *
 * @package App\Models
 * @version February 3, 2023, 11:21 am UTC
 * @property integer $orders_id
 * @property integer $products_id
 * @property integer $quantities_id
 * @property integer $value
 * @property integer $detailvalue
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Orders|null $orders
 * @property-read \App\Models\Products|null $products
 * @property-read \App\Models\Quantities|null $quantities
 * @method static \Database\Factories\OrderdetailsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereDetailvalue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereOrdersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereQuantitiesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Orderdetails withoutTrashed()
 * @mixin Model
 */
class Orderdetails extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'orderdetails';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'orders_id',
        'products_id',
        'quantities_id',
        'value',
        'detailvalue'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'orders_id' => 'integer',
        'products_id' => 'integer',
        'quantities_id' => 'integer',
        'value' => 'integer',
        'detailvalue' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'orders_id' => 'required|integer',
        'products_id' => 'required|integer',
        'quantities_id' => 'required|integer',
        'value' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function quantities(): string|BelongsTo
    {
        return $this->belongsTo(Quantities::class, 'quantities_id');
    }

    public function products(): string|BelongsTo
    {
        return $this->belongsTo(Products::class, 'products_id');
    }

    public function orders(): string|BelongsTo
    {
        return $this->belongsTo(Orders::class, 'orders_id');
    }
}
