<?php

namespace App\Model;

use DateTime;

class Cart
{
    private string $id; // identifier
    private DateTime $createdAt;
    /** @var CartItem[] */
    private array $cartItems = [];

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->createdAt = new DateTime();
    }

    public function getId(): string { return $this->id; }

    public function getCreatedAt(): DateTime { return $this->createdAt; }

    /** @return CartItem[] */
    public function getCartItems(): array { return $this->cartItems; }

    public function addCartItem(CartItem $item): void
    {
        $this->cartItems[] = $item;
    }

    public function setCartItems(array $items): void
    {
        $this->cartItems = $items;
    }

    
    public function total(): float
    {
        $total = 0.0;
        foreach ($this->cartItems as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }
        return $total;
    }

   
    public function getTotal(): float
    {
        return $this->total();
    }
}