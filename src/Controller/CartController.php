<?php

namespace App\Controller;

use App\Entity\Product;
use App\Model\Cart;
use App\Model\CartItem;
use App\Service\CartHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route; 

class CartController extends AbstractController
{
    private CartHandler $cartHandler;

    public function __construct(CartHandler $cartHandler)
    {
        $this->cartHandler = $cartHandler;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        $cart = $this->cartHandler->handle(new Cart('main_cart'));

        return $this->render('home/cart.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
public function add(Product $product): Response
{
    $cart = $this->cartHandler->handle(new Cart('main_cart'));
    $cartItem = new CartItem($product, 1);

    $strategy = new \App\Service\ApiCart(); 
    $strategy->add($cartItem, $cart);

    $this->addFlash('success', 'Product added to cart successfully!');
    return $this->redirectToRoute('app_cart');
}
}