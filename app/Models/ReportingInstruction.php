<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportingInstruction extends Model
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
     * Даты, которые будут преобразованы в объект класса Carbon
     *
     * @var string[]
     */
    protected $dates = ['report_date'];

    /**
     * Связь Многие к одному с таблицей users
     *
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
