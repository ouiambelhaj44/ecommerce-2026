<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/category/{id}/products', name: 'products_by_category')]
    public function productsByCategory(Category $category): Response
    {
        $products = $category->getProducts(); 

        return $this->render('home/products_by_category.html.twig', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    #[Route('/product/{id}', name: 'product_details')]
    public function productDetails(Product $product): Response
    {
       
        return $this->render('home/product_details.html.twig', [
            'product' => $product,
        ]);
    }
}
