<?php

namespace App\Models;

use Barryvdh\DomPDF\Tests\TestCase;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Products
 * @package App\Models
 * @version February 2, 2023, 8:58 am UTC
 *
 * @property string $name
 * @property integer $quantities_id
 * @property integer $price
 * @property string $description
 */
class Products extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'quantities_id',
        'price',
        'supplierprice',
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
        'quantities_id' => 'integer',
        'price' => 'integer',
        'supplierprice' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100',
        'quantities_id' => 'required|integer',
        'price' => 'required|integer',
        'supplierprice' => 'nullable|integer',
        'description' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function quantities(): string|BelongsTo
    {
        return $this->belongsTo(Quantities::class, 'quantities_id');
    }

    public function offerdetails(): string|HasMany
    {
        return $this->hasMany(Offerdetails::class, 'products_id');
    }
}
