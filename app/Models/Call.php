<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'call_purpose',
        'zone',
        'origin',
        'feedback',
        'property',
        'property_type',
    ];
}
