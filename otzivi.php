<?php
$file_path = 'db.php';
if (file_exists($file_path)) {
    include $file_path;
} else {
    die("Файл db.php не найден");
}

// Выполняем запрос для получения данных
$sql = "SELECT name, disc, rating FROM reviews"; // Запрос на выборку
$result = $conn->query($sql); // Выполняем запрос

?>
<div class="container mt-5">
    <h2 class="text-center mb-4">НАШИ СЧАСТЛИВЫЕ ПОКУПАТЕЛИ</h2>
    
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4">
                        <div class="review-card">
                            <div class="star-rating">';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $row['rating']) {
                        echo '&#9733;'; 
                    } else {
                        echo '&#9734;';
                    }
                }
                echo '         </div>
                            <div class="customer-name">' . htmlspecialchars($row['name']) . '</div>
                            <p>' . htmlspecialchars($row['disc']) . '</p>
                        </div>
                    </div>';
            }
        } else {
            echo "Нет отзывов.";
        }
        $conn->close(); // Закрываем соединение
        ?>
    </div>
</div>
