
<?php
include_once "../HtmlParts/SiteHeader.php";

if ($user_info['role'] != "admin")
{

    $textForUser = "Відсутні права доступу до цієї сторінки";
    include_once '../Views/InfoForUserView.php';
}
else {
    echo '<div class="contentSearchPage regandlog uploadfotocontent pageheight" > <br><br><br><br><br><br><br><br><br>
    <form action="../Controllers/InsertControler.php" method="post" enctype="multipart/form-data">
        <span>Виберіть фото: </span><input type="file" name="images[]" multiple required>

        <table border="0" >

            <tr><td>Бренд</td> <td> <input type="text" name="brand" required><td></tr>
            <tr><td>Модель</td> <td> <input type="text" name="model" required><td></tr>
            <tr><td>Ціна</td> <td><input type="number" name="price" required><td></tr>
            <tr><td>Рік</td> <td><input type="number" name="year" required ><td></tr>
            <tr><td>Потужність</td> <td><input type="number" name="horsePower" required><td></tr>
            <tr><td>Об`єм</td> <td><input type="number" name="volume"  min="0" max="100" step="0.01" required><td></tr>

            <tr><td>Пробіг</td> <td><input type="number" name="carMileage" required><td></tr>



            <tr><td>Тип пального</td> <td><select name="fuelType" >
                        <option value="petrol">Бензин</option>
                        <option value="diesel">Дизель</option>
                        <option value="electric">Електро</option>
                    </select><td></tr>

            <tr><td>Опис</td> <td><textarea name="description"></textarea><td></tr>
            <!-- <input type="text" name="description" > -->

        </table>
        <button type="submit">Надіслати</button>
    </form>
</div>';
}

 include_once '../HtmlParts/Footer.php';
?>