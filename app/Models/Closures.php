<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Closures
 *
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 * @property string $closuredate
 * @property integer $card
 * @property integer $szcard
 * @property integer $dayduring
 * @property int $id
 * @property int|null $dailysum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ClosureCimlets> $closurecimlets
 * @property-read int|null $closurecimlets_count
 * @property-read int $cash
 * @property-read int $result
 * @method static \Database\Factories\ClosuresFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Closures newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures query()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures thisYear($year)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures thisYearMonth($year, $month)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures thisYearSumResult($year)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereClosuredate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereDailysum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereDayduring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereSzcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Closures withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Closures withoutTrashed()
 * @mixin Model
 */
class Closures extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'closures';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'closuredate',
        'card',
        'szcard',
        'dayduring',
        'dailysum'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'closuredate' => 'date',
        'card' => 'integer',
        'szcard' => 'integer',
        'dayduring' => 'integer',
        'dailysum' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'closuredate' => 'required',
        'card' => 'required|integer',
        'szcard' => 'required|integer',
        'dayduring' => 'required|integer',
        'dailysum' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = [
        'cash',
        'result'
    ];

    public function closurecimlets(): string|HasMany
    {
        return $this->hasMany(ClosureCimlets::class);
    }

    public function getResultAttribute(): int
    {
        return $this->dailysum - 20000;
    }

    public function getCashAttribute(): int
    {
        return $this->dailysum - ($this->card + $this->szcard + 20000);
    }

    public function scopeThisYear($query, $year): mixed
    {
        return $query->whereYear('closuredate', '=', $year);
    }

    public function scopeThisYearMonth($query, $year, $month): mixed
    {
        return $query->whereYear('closuredate', '=', $year)->whereMonth('closuredate', '=', $month);
    }

    public function scopeThisYearSumResult($query, $year): mixed
    {
        return $query->ThisYear($year)->get()->sum('result');
    }


}
