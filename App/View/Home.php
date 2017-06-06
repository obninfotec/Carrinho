<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <title>Carrinho de compras - Home</title>
        <link rel="stylesheet" href="<?php echo LOCAL . ESTILO; ?>bootstrap-min.css" />
    </head>
    <body>
        <div class="container">
            <nav class="menu">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="<?php echo LOCAL; ?>">Home</a></li>
                    <li role="presentation"><a href="<?php echo LOCAL?>?page=cart">Carrinho</a></li>
                    <li role="presentation"><a href="<?php echo LOCAL?>?page=login">Login</a></li>
                </ul>
            </nav>
            <div class="page-header">
                <h1>Home</h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($Products as $Product) : ?>
                <tbody>
                    <tr>
                        <td><?php echo $Product->getId();?></td>
                        <td><?php echo $Product->getName();?></td>
                        <td>R$ <?php echo number_format($Product->getPrice(), 2, ',', '.');?></td>
                        <td></td>
                    </tr>
                </tbody>
                <?php endforeach ?>
            </table>
            <p><a href="<?php echo LOCAL . JQUERY; ?>jquery.js">Local Jquery</a></p>
        </div>

    </body>
</html>