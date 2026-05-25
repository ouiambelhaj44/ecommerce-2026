<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $categoriesData = ['Électronique', 'Livres', 'Vêtements'];
        
        foreach ($categoriesData as $catName) {
            $category = new Category();
            $category->setName($catName);
            $category->setCategory($catName); 
            $category->setImage("default_cat.png"); 
            $category->setString("slug-" . strtolower($catName));
            
            $manager->persist($category);

           
            for ($i = 1; $i <= 2; $i++) {
                $product = new Product();
                $product->setName("Produit " . $catName . " " . $i);
                $product->setPrice(10.99 * $i);
                $product->setDescription("Ceci est une description détaillée pour le produit " . $i . " de la catégorie " . $catName);
                $product->setProduct($product->getName()); 
                $product->setImage("default_prod.png");
                $product->setRelation(1.0);
                
               
                $product->setCategory($category);
                
                $manager->persist($product);
            }
        }

        
        $manager->flush();
    }
}