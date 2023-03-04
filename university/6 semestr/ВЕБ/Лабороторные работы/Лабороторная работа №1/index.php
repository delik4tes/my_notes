<html>
<head lang="en">
    <meta charset="UTF-8">
</head>
<body>
<h1 align="center">Ваш заказ оформлен:</h1>
<h2>Детали заказа:</h2>
<?php
    if($_GET['first_count']!=0)
        echo "Вы заказали карандаши цвета:".$_GET['first_color']." Количество:".$_GET['first_count']."<br>";
    if($_GET['second_count']!=0)
        echo "Вы заказали карандаши цвета:".$_GET['second_color']." Количество:".$_GET['second_count']."<br>";
    if($_GET['third_count']!=0)
        echo "Вы заказали карандаши цвета:".$_GET['third_color']." Количество:".$_GET['third_count']."<br>";
    echo "Формат холста:".$_GET['format']."<br>";

    if($_GET['first_count']!=0 && $_GET['second_count']!=0 && $_GET['third_count']!=0)
        echo "Карандаши вы не заказывали"."<br>";
    echo "Дополнительные акссесураы:<br>";
    if(isset($_GET['paints']))
        foreach ($_GET['paints'] as &$value)
            echo $value."<br>";
    if(isset($_GET['wishes']))
        echo "Дополнительные пожелания:".$_GET['wishes']."<br>";
    else
        echo "Дополнительные пожелания: нет<<br>";
    if(isset($_GET['phone']))
        echo "Ваш номер телефона:".$_GET['phone']."<br>";
    else
        echo "Ваш номер телефона: не указан<br>";
    if (isset($_GET['promotion']))
        echo "Получение дополнительных акций: согласен<br>";
    else
        echo "Получение дополнительных акций: не согласен<br>";
    if($_GET['delivery'] = "Курьер")
        echo "Вы выбрали доставку курьером по адресу:".$_GET['address']."<br>";
    else
        echo "Способ получения: самовывоз<br>";
?>
</body>
</html>





