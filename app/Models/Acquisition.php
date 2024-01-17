<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acquisition extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function property_type()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function property_transaction_type()
    {
        return $this->belongsTo(PropertyTransactionType::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    protected $fillable = [
        'name',
        'price',
        'short_address',
        'web_description',
        'code',
        'main_pic'
    ];
}
