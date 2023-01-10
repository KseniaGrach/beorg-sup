<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Поля, запрещённые для массового присвоения
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->middlename;
    }

    /**
     * Связь Многие к одному с таблицей departments
     *
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Связь Один ко многим с таблицей meetings
     *
     * @return HasMany
     */
    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'user_id');
    }

    /**
     * Связь Один ко многим с таблицей meetings
     *
     * @return HasMany
     */
    public function clientMeetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'client_id');
    }

    /**
     * Связь многие ко многим с таблицей projects
     *
     * @return BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'users_projects', 'user_id', 'project_id');
    }

    /**
     * Связь Один ко многим с таблицей projects
     *
     * @return HasMany
     */
    public function clientProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    /**
     * Связь многие ко многим с таблицей roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'user_id', 'role_id');
    }

    /**
     * @param ...$roles
     * @return bool
     */
    public function hasRole(... $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('code', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasRoleFromString(string $roles): bool
    {
        $roles = explode(',', $roles);

        return $this->hasRole(... $roles);
    }
}
