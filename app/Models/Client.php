<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['clientType', 'clientStatus'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'phone_number', 'client_type_id', 'client_status_id', 'title', 'address', 'description', 'email',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if (is_null($this->middle_name)) {
            return "{$this->first_name} {$this->last_name}";
        }
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    /**
     * Get the type of the client.
     */
    public function clientType()
    {
        return $this->belongsTo(ClientType::class);
    }

    /**
     * Get the status of the client.
     */
    public function clientStatus()
    {
        return $this->belongsTo(ClientStatus::class);
    }

    /**
     * Get the opportunities of the client.
     */
    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

    /**
     * Get the projects of the client.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->whereHas('clientStatus', function (Builder $query) {
            $query->where('name', '=', 'active');
        });
    }

    /**
     * Scope a query to only include clients with customer client type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCustomer($query)
    {
        return $query->whereHas('clientType', function (Builder $query) {
            $query->where('name', '=', 'Customer');
        });
    }

    /**
     * Scope a query to only include clients of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->whereHas('clientType', function (Builder $query) use ($type) {
            $query->where('name', $type);
        });
    }
}
