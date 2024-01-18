<?php

namespace App\Controller;

use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    private $gateway;
    public function __construct()
    {
        $this->gateway = new StripeClient($_ENV['STRIPE_SECRET_KEY']);
    }

    #[Route('/checkout', name: 'app_stripe_checkout')]
    public function checkout(): Response
    {
        header('Content-Type: application/json');
        $SITE_URL = 'https://127.0.0.1:8000';

        try {
            $checkout = $this->gateway->checkout->sessions->create([
                'success_url' => $SITE_URL . '/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $SITE_URL . '/cancel',
                'payment_method_types' => ['card'],
                'mode' => 'payment',
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => 2000,
                        'product_data' => [
                            'name' => 'mon produit',
                        ],
                    ],
                    'quantity' => 1,
                ]],
            ]);
        } catch (ApiErrorException $e) {
            dd($e);
        }
        return $this->redirect($checkout->url);
    }
    
    #[Route('/success', name: 'app_stripe_success')]
    public function succes(): Response
    {
        return $this->render('stripe/success.html.twig');
    }
    #[Route('/cancel', name: 'app_stripe_cancel')]
    public function cancel(): Response
    {
        return $this->render('stripe/cancel.html.twig');
    }

}
