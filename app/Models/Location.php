<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Location
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $postcode
 * @property int|null $settlement_id
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Delivery> $deliveries
 * @property-read int|null $deliveries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partners> $partners
 * @property-read int|null $partners_count
 * @property-read \App\Models\Settlements|null $settlement
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereSettlementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Location withoutTrashed()
 * @mixin \Eloquent
 */
class Location extends Model
{
    use SoftDeletes;
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    public $table = 'locations';

    public $fillable = [
        'name',
        'description',
        'postcode',
        'settlement_id',
        'address'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'address' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string',
        'description' => 'nullable|string',
        'postcode' => 'nullable',
        'settlement_id' => 'nullable',
        'address' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function deliveries(): string|HasMany
    {
        return $this->hasMany(Delivery::class, 'location_id');
    }

    public function settlement(): string|BelongsTo
    {
        return $this->belongsTo(Settlements::class, 'settlement_id');
    }

    public function partners(): array|belongsToMany
    {
        return $this->belongsToMany(Partners::class, 'location_partner');
    }

    public function partnersCount(): int
    {
        return $this->partners()->count();
    }

}
