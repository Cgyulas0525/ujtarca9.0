<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PaymentMethods
 *
 * @package App\Models
 * @version January 2, 2023, 3:43 pm UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoices> $invoices
 * @property-read int|null $invoices_count
 * @method static \Database\Factories\PaymentMethodsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethods withoutTrashed()
 * @mixin Model
 */
class PaymentMethods extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'paymentmethods';

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

    public function invoices(): string|HasMany
    {
        return $this->hasMany(Invoices::class, 'paymentmethod_id');
    }
}
