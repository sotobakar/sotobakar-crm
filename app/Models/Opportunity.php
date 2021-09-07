<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'client_id', 'opportunity_status_id', 'description',
    ];

    /**
     * Get the status of the opportunity.
     */
    public function opportunityStatus()
    {
        return $this->belongsTo(OpportunityStatus::class);
    }

    /**
     * Get the client of the opportunity.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
