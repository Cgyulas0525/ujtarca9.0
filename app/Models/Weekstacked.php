<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * Class Weekstacked
 *
 * @package App\Models
 * @version April 14, 2023, 10:46 am CEST
 * @property integer $year
 * @property integer $week
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
 * @property-read string $week_of_m_onth
 * @property-read string $year_week
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked getPreviousRecord()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked query()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereSpend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereSzcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Weekstacked withoutTrashed()
 * @mixin Model
 */
class Weekstacked extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'weekstackeds';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'year',
        'week',
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
        'week' => 'integer',
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
        'week' => 'required|integer',
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
        'yearweek',
        'weekofmonth'
    ];


    public function getResultAttribute(): int
    {
        return $this->revenue - $this->spend;
    }

    public function getYearWeekAttribute(): string
    {
        return $this->year . "." . str_pad($this->week, 2, '0', STR_PAD_LEFT);
    }

    public function getWeekOfMOnthAttribute(): string
    {
        return Carbon::create(date('Y-m-d', strtotime($this->year . 'W' . str_pad($this->week, 2, '0', STR_PAD_LEFT))))->weekOfMonth;
    }

    public function scopeGetPreviousRecord($query): mixed
    {
        return $query->where('id', '<', $this->id)->get()->last();
    }
}
