<?php

$file_path = 'db.php';
if (file_exists($file_path)) {
    include $file_path;
} else {
    die("Файл db.php не найден");
}


$sql = "SELECT name, image, price, rating, old_price, discount FROM products WHERE new = 1";
$result = $conn->query($sql);

if ($result === false) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Новинки</h2>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $productName = htmlspecialchars($row['name']);
                $productImage = htmlspecialchars($row['image']);
                $productPrice = htmlspecialchars($row['price']);
                $productOldPrice = htmlspecialchars($row['old_price']); 
                $productDiscount = htmlspecialchars($row['discount']); 
                $productRating = intval($row['rating']);
                ?>
                <div class="col-md-4 product-card">
                    <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid mb-2">
                    <h5 class="product-title"><?php echo $productName; ?></h5>
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <div class="text-warning">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $productRating ? '&#9733;' : '&#9734;'; 
                            }
                            ?>
                        </div>
                        <span class="ms-2"><?php echo $productRating; ?>/5</span>
                    </div>
                    <h4>
                        <?php echo $productPrice; ?>$
                        <?php if (!empty($productOldPrice) && !empty($productDiscount)) { ?>
                            <span class="price-old"><?php echo $productOldPrice; ?>$</span>
                            <span class="discount">-<?php echo $productDiscount; ?>%</span>
                        <?php } ?>
                    </h4>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>Нет новинок.</p>";
        }

        $conn->close();
        ?>
    </div>
    <div class="text-center mt-4">
        <button class="btn btn-outline-dark">Показать всё</button>
    </div>
</div>
