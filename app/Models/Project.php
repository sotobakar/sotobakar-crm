<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes, HasFactory;

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
    public function status()
    {
        return $this->belongsTo(ProjectStatus::class);
    }
}
