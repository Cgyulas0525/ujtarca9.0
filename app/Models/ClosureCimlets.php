<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ClosureCimlets
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 *
 * @property integer $closures_id
 * @property integer $cimlets_id
 * @property integer $value
 */
class ClosureCimlets extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'closurecimlets';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'closures_id',
        'cimlets_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'closures_id' => 'integer',
        'cimlets_id' => 'integer',
        'value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'closures_id' => 'required|integer',
        'cimlets_id' => 'required|integer',
        'value' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function closures() {
        return $this->belongsTo(Closures::class);
    }

    public function cimlets() {
        return $this->belongsTo(Cimlets::class);
    }

}
