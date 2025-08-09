<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Yearstacked
 *
 * @package App\Models
 * @version April 14, 2023, 10:46 am CEST
 * @property integer $year
 * @property integer $revenue
 * @property integer $spend
 * @property integer $average
 * @property integer $card
 * @property integer $szcard
 * @property integer $cash
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read int $result
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked getCardPercent()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked getCashPercent()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked getPreviousRecord()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked getSzCardPercent()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked query()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereSpend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereSzcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Yearstacked withoutTrashed()
 * @mixin Model
 */
class Yearstacked extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'yearstackeds';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'year',
        'revenue',
        'spend',
        'average',
        'card',
        'szcard',
        'cash'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'year' => 'integer',
        'revenue' => 'integer',
        'spend' => 'integer',
        'average' => 'integer',
        'card' => 'integer',
        'szcard' => 'integer',
        'cash' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'year' => 'required|integer',
        'revenue' => 'required|integer',
        'spend' => 'required|integer',
        'average' => 'required|integer',
        'card' => 'required|integer',
        'szcard' => 'required|integer',
        'cash' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = [
        'result',
        'resultPercent',
    ];


    public function getResultAttribute(): int
    {
        return $this->revenue - $this->spend;
    }

    public function getResultPercentAttribute(): int
    {
        return ($this->revenue - $this->spend) / ($this->revenue ?: 1) * 100;
    }

    public function scopeGetCardPercent(): mixed
    {
        return Round($this->card / ($this->revenue / 100), 0);
    }

    public function scopeGetSzCardPercent(): mixed
    {
        return Round($this->szcard / ($this->revenue / 100), 0);
    }

    public function scopeGetCashPercent(): mixed
    {
        return Round($this->cash / ($this->revenue / 100), 0);
    }

    public function scopeGetPreviousRecord($query): mixed
    {
        return $query->where('id', '<', $this->id)->get()->last();
    }
}
