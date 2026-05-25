<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\RegistrationHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response {
        return $this->render('home/index.html.twig');
    }

    #[Route('/product/details', name: 'app_product_details')]
    public function details(): Response {
        return $this->render('home/product_details.html.twig');
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        return $this->render('home/login.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, RegistrationHandler $registrationHandler): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registrationHandler->register($user);
            $this->addFlash('success', 'Your account has been created successfully!');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/login.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/profile', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function profile(): Response {
        return $this->render('home/profile.html.twig');
    }

    #[Route('/categories', name: 'app_categories')]
    public function categories(): Response {
        return $this->render('home/browse_categories.html.twig');
    }

    #[Route('/categories/products', name: 'app_products_by_category')]
    public function productsByCategory(): Response 
    {
        return $this->render('home/products_by_category.html.twig');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void {
    }
}
