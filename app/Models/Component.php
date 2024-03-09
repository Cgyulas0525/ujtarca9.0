<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Component
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Products> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\ComponentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Component newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Component newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Component onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Component query()
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Component withoutTrashed()
 * @mixin \Eloquent
 */
class Component extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'components';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'description'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string',
        'description' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function products(): array|belongsToMany
    {
        return $this->belongsToMany(Products::class, 'component_product')
            ->withPivot('value');
    }
}
