<?php
namespace App\Models;

class CartItem {
    public $product;
    public $quantity;

    public function __construct($product, $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function incrementQuantity($quantity) {
        $this->quantity += $quantity;
    }
}