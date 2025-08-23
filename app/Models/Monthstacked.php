<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Monthstacked
 *
 * @package App\Models
 * @version April 14, 2023, 10:46 am CEST
 * @property integer $year
 * @property integer $month
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
 * @property-read string $year_month
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked getPreviousRecord()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked query()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereSpend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereSzcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Monthstacked withoutTrashed()
 * @mixin Model
 */
class Monthstacked extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'monthstackeds';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'year',
        'month',
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
        'month' => 'integer',
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
        'month' => 'required|integer',
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

    protected $appends = [
        'result',
        'yearmonth',
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

    public function getYearMonthAttribute(): string
    {
        return $this->year . "." . str_pad($this->month, 2, '0', STR_PAD_LEFT);
    }

    public function scopeGetPreviousRecord($query): mixed
    {
        return $query->where('id', '<', $this->id)->get()->last();
    }
}
