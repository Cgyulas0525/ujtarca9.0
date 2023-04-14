<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Monthstacked
 * @package App\Models
 * @version April 14, 2023, 10:06 am CEST
 *
 * @property integer $year
 * @property integer $month
 * @property integer $revenue
 * @property integer $spend
 * @property integer $average
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
        'average'
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
        'average' => 'integer'
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
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
