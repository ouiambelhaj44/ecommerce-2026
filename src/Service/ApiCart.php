<?php

namespace App\Service;

use App\Model\Cart;
use App\Model\CartItem;

class ApiCart implements CartInterface
{
    public function getCart(string $identifier): Cart
    {
        dd("API Strategy: Fetching cart " . $identifier);
    }

    public function add(CartItem $item, Cart $cart): Cart
    {
        dd("API Strategy: Adding item to API cart");
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        dd("API Strategy: Removing item from API cart");
    }

    public function clearCart(string $identifier): void
    {
        dd("API Strategy: Clearing API cart");
    }
}