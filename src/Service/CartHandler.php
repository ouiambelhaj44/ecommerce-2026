<?php

namespace App\Service;

use App\Model\Cart;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CartHandler
{
    private CartInterface $strategy;

    public function __construct(
        #[Autowire(service: SessionCart::class)] CartInterface $strategy
    ) {
        $this->strategy = $strategy;
    }

    
    public function handle(Cart $cart, CartInterface $strategy = null): Cart
    {
        $currentStrategy = $strategy ?? $this->strategy;
        
        return $currentStrategy->getCart($cart->getId());
    }

    public function getStrategy(): CartInterface
    {
        return $this->strategy;
    }
}