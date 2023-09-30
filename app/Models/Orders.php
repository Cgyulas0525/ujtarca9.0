<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Offers
 * @package App\Models
 * @version February 3, 2023, 11:19 am UTC
 *
 * @property string $ordernumber
 * @property string $orderdate
 * @property integer $partners_id
 * @property string $description
 * @property integer $ordertype
 */
class Orders extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'orders';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'ordernumber',
        'orderdate',
        'partners_id',
        'description',
        'ordertype',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ordernumber' => 'string',
        'orderdate' => 'date',
        'partners_id' => 'integer',
        'description' => 'string',
        'ordertype' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ordernumber' => 'required|string|max:25',
        'orderdate' => 'required',
        'partners_id' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'ordertype' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function partners(): string|BelongsTo
    {
        return $this->belongsTo(Partners::class, 'partners_id');
    }

    public function orderdetails(): string|HasMany
    {
        return $this->hasMany(Orderdetails::class, 'orders_id');
    }

    public function scopeCustomerOrders($query): mixed
    {
        return $query->where('ordertype', 0);
    }

    public function scopeSupplierOrders($query): mixed
    {
        return $query->where('ordertype', 1);
    }
}
