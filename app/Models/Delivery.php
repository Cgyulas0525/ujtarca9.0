<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * App\Models\Delivery
 *
 * @property int $id
 * @property string $delivery_number
 * @property \Illuminate\Support\Carbon $date
 * @property int $location_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $delivery_full_name
 * @property-read string $order_number
 * @property-read \App\Models\Location $location
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Orders> $orders
 * @property-read int|null $orders_count
 * @method static Builder|Delivery activeDeliveries()
 * @method static Builder|Delivery newModelQuery()
 * @method static Builder|Delivery newQuery()
 * @method static Builder|Delivery onlyTrashed()
 * @method static Builder|Delivery query()
 * @method static Builder|Delivery whereCreatedAt($value)
 * @method static Builder|Delivery whereDate($value)
 * @method static Builder|Delivery whereDeletedAt($value)
 * @method static Builder|Delivery whereDeliveryNumber($value)
 * @method static Builder|Delivery whereDescription($value)
 * @method static Builder|Delivery whereId($value)
 * @method static Builder|Delivery whereLocationId($value)
 * @method static Builder|Delivery whereUpdatedAt($value)
 * @method static Builder|Delivery withTrashed()
 * @method static Builder|Delivery withoutTrashed()
 * @mixin \Eloquent
 */
class Delivery extends Model
{
    use SoftDeletes;
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    public $table = 'deliveries';

    public $fillable = [
        'delivery_number',
        'date',
        'location_id',
        'description'
    ];

    protected $casts = [
        'delivery_number' => 'string',
        'date' => 'date',
        'description' => 'string'
    ];

    public static array $rules = [
        'delivery_number' => 'required|string',
        'date' => 'required',
        'location_id' => 'required',
        'description' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = [
        'deliveryFullName',
        'orderNumber'
    ];


    public function location(): string|BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function orders(): string|HasMany
    {
        return $this->hasMany(Orders::class, 'delivery_id');
    }

    public function scopeActiveDeliveries(Builder $query)
    {
        $query->where('date', '>=', Carbon::now()->toDateString());
    }

    public function getDeliveryFullNameAttribute(): string
    {
        return $this->delivery_number . ' ' . $this->location->name . ' - ' . $this->date->toDateString();
    }
    public function getOrderNumberAttribute(): string
    {
        return Orders::where('delivery_id', $this->id)->count();
    }


}
