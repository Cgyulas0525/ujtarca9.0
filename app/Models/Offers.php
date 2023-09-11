<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

/**
 * Class Offers
 * @package App\Models
 * @version February 3, 2023, 11:19 am UTC
 *
 * @property string $offernumber
 * @property string $offerdate
 * @property integer $partners_id
 * @property string $description
 */
class Offers extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'offers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'offernumber',
        'offerdate',
        'partners_id',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'offernumber' => 'string',
        'offerdate' => 'date',
        'partners_id' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'offernumber' => 'required|string|max:25',
        'offerdate' => 'required',
        'partners_id' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function partners(): string|BelongsTo
    {
        return $this->belongsTo(Partners::class, 'partners_id');
    }

    public function offerdetails(): string|HasMany
    {
        return $this->hasMany(Offerdetails::class, 'offers_id');
    }

}
