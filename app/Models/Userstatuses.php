<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


