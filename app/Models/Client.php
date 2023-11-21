<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
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
        'first_name',
        'middle_name',
        'lastname',
        'second_lastname',
        'birthday',
        'phone',
        'document',
        'email',
        'nationality',
        'marital_status',
        'gender',
        'origin',
    ];
}
