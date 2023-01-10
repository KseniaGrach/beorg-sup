<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
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
     * Связь Один ко многим с таблицей meetings
     *
     * @return HasMany
     */
    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'project_id');
    }

    /**
     * Связь Один ко многим с таблицей reporting_instructions
     *
     * @return HasMany
     */
    public function instructions(): HasMany
    {
        return $this->hasMany(ReportingInstruction::class, 'project_id');
    }

    /**
     * Связь Один ко многим с таблицей statistics
     *
     * @return HasMany
     */
    public function statistic(): HasMany
    {
        return $this->hasMany(Statistic::class, 'project_id');
    }

    /**
     * Связь Многие к одному с таблицей clients
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Связь Многие к одному с таблицей types
     *
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * Связь Многие к одному с таблицей durations
     *
     * @return BelongsTo
     */
    public function duration(): BelongsTo
    {
        return $this->belongsTo(Duration::class, 'duration_id');
    }

    /**
     * Связь многие ко многим с таблицей users
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_projects', 'project_id', 'user_id');
    }
}
