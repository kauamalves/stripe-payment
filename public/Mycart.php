<?php

use Spatie\Ignition\Ignition;
use app\library\Cart;

require '../vendor/autoload.php';

session_start();
Ignition::make()->register();

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
    <title>Meu carrinho</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/global.css">
</head>

<body>
    <div class="headerMyCart">
        <a href="index.php"><i class="fa-solid fa-house"></i></a>
    </div>

    <hr>

    <main>
        <ul>
            <div class="productsInCart">
                <?php if (count($productsInCart) <= 0) : ?>
                    <p>Nenhum produto no carrinho :(</p>
                <?php endif; ?>

                <?php foreach ($productsInCart as $product) : ?>
                    <div class="productInCart">
                        <p>
                            <?php echo $product->getName(); ?>
                            Quantidade: <?php echo $product->getQuantity(); ?>
                            <a href="?id=<?php echo $product->getId(); ?>">remover</a>
                        </p>
                        <p class="price">Preço: R$<?php echo number_format($product->getPrice(), 2, ',', '.'); ?></p>
                        <p>SubTotal: R$<?php echo number_format($product->getPrice() * $product->getQuantity(), 2, ',', '.'); ?></p>
                    </div>
                <?php endforeach; ?>
                <li>Total: <?php echo 'R$' . number_format($cart->getTotal(), 2, ',', '.'); ?></li>
            </div>

        </ul>

    </main>
    <div class="payment">
        <a href="/checkout.php">Efetuar pagamento</a>
    </div>

</body>

</html>