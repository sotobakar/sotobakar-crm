<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['client', 'projectStatus'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'client_id', 'project_status_id', 'description', 'completed_at',
    ];

    /**
     * Get the client of the project.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the status of the project.
     */
    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    /**
     * Get the tasks of the status.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Scope a query to only include completed projects.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->whereHas('projectStatus', function (Builder $query) {
            $query->where('name', '=', 'Completed');
        });
    }

    /**
     * Scope a query to only include unfinished projects.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnfinished($query)
    {
        return $query->whereHas('projectStatus', function (Builder $query) {
            $query->whereNotIn('name', ['Completed']);
        });
    }
}
