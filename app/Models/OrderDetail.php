<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable=['price', 'quantity', 'order_id', 'product_id'];

    public function order() {
        return $this->belongTo(Order::class);
    } 

    public function product() {
        return $this->belongTo(Product::class);
    } 
}
