<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Enums\OrderTypeEnum;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Orders
 * @package App\Models
 * @version February 3, 2023, 11:19 am UTC
 *
 * @property string $ordernumber
 * @property string $orderdate
 * @property integer $partners_id
 * @property string $description
 * @property string $ordertype
 * @property string $order_status
 * @property string $delivered_date
 * @property integer $detailsum
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
        'order_status',
        'delivered_date',
        'ordertype',
        'detailsum',
        'delivery_id',
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
        'order_status' => OrderStatusEnum::class,
        'delivered_date' => 'date',
        'ordertype' => OrderTypeEnum::class,
        'detailsum' => 'integer',
        'delivery_id' => 'integer',
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
        'order_status' => 'nullable|string|max:25',
        'delivered_date' => 'nullable',
        'delivery_id' => 'nullable',
        'ordertype' => 'required|string|max:25',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = [
        'detailsSum',
    ];

    protected static $relations_to_cascade = ['orderdetails'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($resource) {
            foreach (static::$relations_to_cascade as $relation) {
                foreach ($resource->{$relation}()->get() as $item) {
                    $item->delete();
                }
            }
        });

        static::restoring(function($resource) {
            foreach (static::$relations_to_cascade as $relation) {
                foreach ($resource->{$relation}()->get() as $item) {
                    $item->withTrashed()->restore();
                }
            }
        });
    }

    public function partners(): string|BelongsTo
    {
        return $this->belongsTo(Partners::class, 'partners_id');
    }

    public function delivery(): string|BelongsTo
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function orderdetails(): string|HasMany
    {
        return $this->hasMany(Orderdetails::class, 'orders_id');
    }

    public function scopeCustomerOrders(Builder $query): void
    {
        $query->where('ordertype', OrderTypeEnum::CUSTOMER->value);
    }

    public function scopeSupplierOrders(Builder $query): void
    {
        $query->where('ordertype', OrderTypeEnum::SUPPLIER->value);
    }

    public function scopeOrdersByType(Builder $query, $type): void
    {
        $query->where('ordertype', $type);
    }

    public function scopePartnerOrders(Builder $query, $partner): void
    {
        $query->where('partners_id', $partner);
    }

    public function scopeOrdersInTheLastMonths(Builder $query, $months): void
    {
        $query->whereBetween('orderdate', [now()->subMonth($months)->toDateString(), now()->toDateString()]);
    }

    public function scopeOrdersByTypeAndStatus(Builder $query, ?string $type = NULL, ?string $status = NULL): void
    {
        $query->where('ordertype', $type)
            ->where(function ($query) use ($type) {
                is_null($type) ? $query->whereNotNull('ordertype') : $query->where('ordertype',  $type);
            })
            ->where(function ($query) use ($status) {
                is_null($status) ? $query->whereNotNull('order_status') : $query->where('order_status', $status);
            });
    }

    public function getDetailsSumAttribute(): int
    {
        return Orderdetails::where('orders_id', $this->id)->get()->sum('supplierPrice');
    }
}
