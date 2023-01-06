<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\ClosureCimlets;
use App\Models\Cimlets;

/**
 * Class Closures
 * @package App\Models
 * @version January 2, 2023, 4:01 pm UTC
 *
 * @property string $closuredate
 * @property integer $card
 * @property integer $szcard
 * @property integer $dayduring
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
        'dayduring'
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
        'dayduring' => 'integer'
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
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    protected $append = [
        'closureValue',
    ];


    public function closurecimlets() {
        return $this->hasMany(ClosureCimlets::class);
    }

    public function getClosureValueAttribute() {

        $value = 0;
        $closurecimlets = ClosureCimlets::where('closures_id', $this->id)->get();
        foreach ($closurecimlets as $closurecimlet) {
            $value += ($closurecimlet->value * $closurecimlet->cimlets->value);
        }
        $value +=  $this->card + $this->szcard + $this->dayduring - 20000;
        return $value;
    }



}
