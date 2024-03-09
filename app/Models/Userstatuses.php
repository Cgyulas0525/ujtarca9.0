<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Userstatuses
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $commit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\UserstatusesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses query()
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses whereCommit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Userstatuses withoutTrashed()
 * @mixin Model
 */
class Userstatuses extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'userstatuses';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'commit',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'commit' => 'string',
    ];

    public static array $rules = [
        'name' => 'required|string|max:100',
        'Commit' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',

    ];

    public function users(): string|HasMany
    {
        return $this->hasMany(User::class, 'userstatus_id');
    }
}


