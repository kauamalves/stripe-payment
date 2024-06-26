<?php

require '../vendor/autoload.php';

use Spatie\Ignition\Ignition;
use app\library\Cart;
use Stripe\StripeClient;

session_start();

Ignition::make()->register();

$private_key = '';
$stripe = new StripeClient($private_key);

$cart = new Cart;
$productsInCart = $cart->getCart();

$items = [
    'mode' => 'payment',
    'success_url' => 'http://localhost:8000/success.php',
    'cancel_url' => 'http://localhost:8000/cancel.php',
];

foreach($productsInCart as $product){
    $items['line_items'][] = [
        'price_data' => [
            'currency' => 'brl',
            'product_data' => [
                'name' => $product->getName()
            ],
            'unit_amount' => $product->getPrice() * 100
        ],
        'quantity' => $product->getQuantity()
    ];
}

$checkout_session = $stripe->checkout->sessions->create($items);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
