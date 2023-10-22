<?php

use app\models\Goods;

/** @var Goods[] $goods */
//var_dump($goods);
?>

<!--<h1>Товары</h1>-->
<!--<p style="font-size:20px; color:red;">Этот текст будет отображаться крупным и красным.</p>-->
<!---->
<!--<ul>-->
<!--    <li>Первый элемент</li>-->
<!--    <li>Второй элемент</li>-->
<!--    <li>Третий элемент</li>-->
<!--</ul>-->
<!---->
<!--<p>Это текст со <span style="color:red">выделенным красным цветом</span>.</p>-->
<!---->
<!--<table>-->
<!--    <tr>-->
<!--        <th>Имя</th>-->
<!--        <th>Фамилия</th>-->
<!--        <th>Возраст</th>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Иван</td>-->
<!--        <td>Иванов</td>-->
<!--        <td>25</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Петр</td>-->
<!--        <td>Петров</td>-->
<!--        <td>30</td>-->
<!--    </tr>-->
<!--</table>-->
<!---->
<!--<a href="https://www.example.com/">Это ссылка на example.com</a>-->
<!---->
<!--<div class="shadowbox">-->
<!--    <p>Вот очень интересная заметка в прекрасном прямоугольнике с тенью.</p>-->
<!--</div>-->
<!---->


<table class="table">
<tr><th>id</th><th>Название</th><th>Описание</th><th>Цена</th></tr>

<?php //foreach ($goods as $good) { ?>
<!--    <p>--><?php //= $good->id . ' ' . $good->title . ' ' . $good->description . ' ' . $good->price  ?><!--</p>-->
<?php //} ?>


<?php
    foreach ($goods as $good){
        echo "<tr><th>{$good['id']}</th><th>{$good['title']}</th><th>{$good['description']}</th><th>{$good['price']}</th></tr>";
    }
?>
</table>
