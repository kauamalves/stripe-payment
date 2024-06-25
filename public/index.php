<?php

use app\library\Cart;
use app\library\Product;

require '../vendor/autoload.php';

session_start();

if (!isset($_SESSION['cart']['total'])) {
    $_SESSION['cart']['total'] = 0;
}

$products = [
    1 => ['id' => 1, 'name' => 'Geladeira', 'price' => 1200.00, 'quantity' => 1],
    2 => ['id' => 2, 'name' => 'Teclado', 'price' => 350.00, 'quantity' => 1],
    3 => ['id' => 3, 'name' => 'Mouse', 'price' => 100.00, 'quantity' => 1],
    4 => ['id' => 4, 'name' => 'Monitor', 'price' => 500.00, 'quantity' => 1],
];

if (isset($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $productInfo = $products[$id];
    $product = new Product;
    $product->setId($productInfo['id']);
    $product->setName($productInfo['name']);
    $product->setPrice($productInfo['price']);
    $product->setQuantity($productInfo['quantity']);

    $cart = new Cart;
    $cart->add($product);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Gosth</title>
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="header">
        <a href="Mycart.php"><i class="fa-solid fa-cart-shopping"></i></a>
    </div>

    <hr>

    <main>
        <ul>
            <?php foreach ($products as $product) : ?>
                <li>
                    <?php echo ucfirst($product['name']) ?> |
                    <a href="?id=<?php echo $product['id'] ?>">Add</a> |
                    <?php echo 'Preço: R$' . number_format($product['price'], 2, ',', '.') ?>
                </li>
            <?php endforeach ?>
        </ul>
    </main>


</body>

</html>