<?php

namespace App\Service;

use App\Model\Cart;
use App\Model\CartItem;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    private function getSession()
    {
        return $this->requestStack->getSession();
    }

    public function getCart(string $identifier): Cart
    {
        $session = $this->getSession();
        $cart = $session->get('cart_' . $identifier);

        if (!$cart) {
            $cart = new Cart($identifier);
            $session->set('cart_' . $identifier, $cart);
        }

        return $cart;
    }

    public function add(CartItem $item, Cart $cart): Cart
    {
        $session = $this->getSession();
        
        $exists = false;
        foreach ($cart->getCartItems() as $cartItem) {
            if ($cartItem->getProduct()->getId() === $item->getProduct()->getId()) {
                $cartItem->incrementQuantity($item->getQuantity());
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $cart->addCartItem($item);
        }

        $session->set('cart_' . $cart->getId(), $cart);
        return $cart;
    }

    public function remove(CartItem $item, Cart $cart): Cart
    {
        $session = $this->getSession();
        $items = $cart->getCartItems();

        foreach ($items as $key => $cartItem) {
            if ($cartItem->getProduct()->getId() === $item->getProduct()->getId()) {
                unset($items[$key]);
                break;
            }
        }

        $cart->setCartItems(array_values($items));
        $session->set('cart_' . $cart->getId(), $cart);
        
        return $cart;
    }

    public function clearCart(string $identifier): void
    {
        $this->getSession()->remove('cart_' . $identifier);
    }
}