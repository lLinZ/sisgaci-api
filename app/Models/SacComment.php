<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SacComment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function call()
    {
        return $this->belongsTo(Call::class);
    }
    protected $fillable = [
        'description',
        'author',
    ];
}
