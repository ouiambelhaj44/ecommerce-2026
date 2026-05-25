<?php

namespace App\Model;

use App\Entity\Product;

class CartItem
{
    private ?int $id = null;
    private Product $product;
    private float $price;
    private int $quantity;

    public function __construct(Product $product, int $quantity = 1)
    {
        $this->product = $product;
        $this->price = $product->getPrice();
        $this->quantity = $quantity;
    }

    public function getId(): ?int { return $this->id; }
    
    public function getProduct(): Product { return $this->product; }
    public function setProduct(Product $product): void { $this->product = $product; }

    public function getPrice(): float { return $this->price; }
    public function setPrice(float $price): void { $this->price = $price; }

    public function getQuantity(): int { return $this->quantity; }
    public function setQuantity(int $quantity): void { $this->quantity = $quantity; }

    public function incrementQuantity(int $qty = 1): void { $this->quantity += $qty; }
}