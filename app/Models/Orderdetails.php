<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Products;

/**
 * Class Orderdetails
 * @package App\Models
 * @version February 3, 2023, 11:21 am UTC
 *
 * @property integer $orders_id
 * @property integer $products_id
 * @property integer $quantities_id
 * @property integer $value
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
        'value'
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
        'value' => 'integer'
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

    protected $append = [
        'supplierPrice',
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

    public function getSupplierPriceAttribute(): int
    {
        return $this->value * Products::find($this->products_id)->supplierprice;
    }
}
