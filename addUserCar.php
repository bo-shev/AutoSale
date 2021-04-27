<?
    include_once 'siteParts/usercheck.php';
    $user = checkUser();

    if ($user == false)
    {
    header('Location: http://salo0n/login.php');
    }
    include_once 'siteparts/siteHeader.php';
?>
<div class="contentSearchPage regandlog"> <br><br><br>
<form action="addUpload.php" method="post" enctype="multipart/form-data">
  <span>Виберіть фото: </span><input type="file" name="images[]" multiple>

  <table border="0" >

  <tr><td>Бренд</td> <td> <input type="text" name="brand" ><td></tr>
  <tr><td>Модель</td> <td> <input type="text" name="model" ><td></tr>
  <tr><td>Ціна</td> <td><input type="number" name="price" ><td></tr>
  <tr><td>Рік</td> <td><input type="number" name="year" ><td></tr>
  <tr><td>Потужність</td> <td><input type="number" name="hp" ><td></tr>
  <tr><td>Об'єм</td> <td><input type="number" name="volume"  min="0" max="100" step="0.01" ><td></tr>

  <tr><td>Пробіг</td> <td><input type="number" name="distance" ><td></tr>
 

  <tr><td>Стан</td> <td><select name='car_condition' >
  <option value="used">Б/У</option> 
  <option value="new">Нова</option>
  </select><td></tr>

  
  <tr><td>Тип пального</td> <td><select name='fuel' >
  <option value="petrol">Бензин</option> 
  <option value="diesel">Дизель</option>
  <option value="electric">Електро</option>
  </select><td></tr>

  <tr><td>Опис</td> <td><textarea name="description"></textarea><td></tr>
  <!-- <input type="text" name="description" > -->

  </table>
  <button type="submit">Надіслати</button>
</form>
</div>

