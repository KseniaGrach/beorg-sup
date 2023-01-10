<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * Поля, запрещённые для массового присвоения
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;

    /**
     * Связь многие ко многим с таблицей users
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'roles_users', 'role_id', 'user_id');
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function getByCode($code): mixed
    {
        return self::where('code', '=', $code)->first();
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function getIdByCode($code): mixed
    {
        return self::getByCode($code)->id;
    }
}
