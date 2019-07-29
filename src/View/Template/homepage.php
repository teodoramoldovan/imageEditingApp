<!DOCTYPE html>

<html>

<head>
    <title>Home Page</title>
</head>

<body>
    <?php echo "HOMEPAGE"; ?>

    <div style="color:white">I have: <?=$numberOfProducts?> products</div>

    <ul>
            <?php foreach ($this->products as $product){?>
                <li>
                <a href="/product/show" style="color:white"> Product name: <?= $product->getTitle()?></a>
                </li>
            <?php } ?>
    </ul>
</body>

</html>
