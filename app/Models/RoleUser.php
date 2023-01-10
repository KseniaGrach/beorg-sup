<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleUser extends Model
{
    protected $table = "roles_users";

    public $timestamps = false;

    /**
     * Связь один ко многим с таблицей users
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_id');
    }

    /**
     * Связь один ко многим с таблицей roles
     *
     * @return HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'role_id');
    }
}
