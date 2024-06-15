<?php

use app\library\Cart;

require '../vendor/autoload.php';

session_start();

$cart = new Cart;
$productsInCart = $cart->getCart();

if (isset($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $cart->remove($id);
    header('Location: Mycart.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="index.php">Ir para a página inicial</a>
    <ul>
        <?php if (count($productsInCart) <= 0) : ?>
            <p>Nenhum produto no carrinho :(</p>
        <?php endif; ?>

        <?php foreach ($productsInCart as $product) : ?>
            <li>
                <p><?php echo $product->getName(); ?>
                Quantidade: <?php echo $product->getQuantity(); ?> 
                <a href="?id=<?php echo $product->getId(); ?>">remover</a> </p>
                Preço: R$<?php echo number_format($product->getPrice(), 2, ',', '.'); ?>

                <li>
                    <p>SubTotal: R$<?php echo number_format($product->getPrice() * $product->getQuantity(), 2, ',', '.'); ?></p>
                </li>    
                
            </li>
        <?php endforeach; ?>
        <li>Total: <?php echo 'R$' . number_format($cart->getTotal(), 2, ',', '.'); ?></li>
    </ul>

    <hr>

    <div class="payment">
        <a href="/checkout.php">Checkout</a>
    </div>
</body>

</html>