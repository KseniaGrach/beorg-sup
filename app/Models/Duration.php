<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Duration extends Model
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
     * Связь Один ко многим с таблицей projects
     *
     * @return HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'duration_id');
    }
}
