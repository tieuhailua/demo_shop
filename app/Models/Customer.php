<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=['username', 'password', 'email', 'phone', 'fullname'];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
