<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    /**
     * Поля, запрещённые для массового присвоения
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * Связь Один ко многим с таблицей users
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id');
    }
}
