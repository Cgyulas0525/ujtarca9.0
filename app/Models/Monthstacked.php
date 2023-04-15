<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Monthstacked
 * @package App\Models
 * @version April 14, 2023, 10:46 am CEST
 *
 * @property integer $year
 * @property integer $month
 * @property integer $revenue
 * @property integer $spend
 * @property integer $average
 * @property integer $card
 * @property integer $szcard
 * @property integer $cash
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

    protected $append = [
        'result'
    ];


    public function getResultAttribute() {
        return $this->revenue - $this->spend;
    }

}
