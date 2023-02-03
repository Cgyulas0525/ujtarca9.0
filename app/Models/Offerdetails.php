<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Offerdetails
 * @package App\Models
 * @version February 3, 2023, 11:21 am UTC
 *
 * @property integer $offers_id
 * @property integer $products_id
 * @property integer $quantities_id
 * @property integer $value
 */
class Offerdetails extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'offerdetails';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'offers_id',
        'products_id',
        'quantities_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'offers_id' => 'integer',
        'products_id' => 'integer',
        'quantities_id' => 'integer',
        'value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'offers_id' => 'required|integer',
        'products_id' => 'required|integer',
        'quantities_id' => 'required|integer',
        'value' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function quantities() {
        return $this->belongsTo(Quantities::class);
    }

    public function products() {
        return $this->belongsTo(Products::class);
    }


}
