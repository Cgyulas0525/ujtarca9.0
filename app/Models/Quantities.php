<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Quantities
 * @package App\Models
 * @version February 2, 2023, 8:57 am UTC
 *
 * @property string $name
 * @property string $description
 */
class Quantities extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'quantities';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function products() {
        return $this->hasMany(Products::class, 'quantities_id');
    }

    public function offerdetails() {
        return $this->hasMany(Offerdetails::class, 'quantities_id');
    }

}
