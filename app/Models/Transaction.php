<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'form_user_id',
        'to_user_id',
        'type'
    ];
    public function from()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
    public function to()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
