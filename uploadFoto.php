<form action="upload.php" method="post" enctype="multipart/form-data">
  <input type="file" name="images[]" multiple>

  <table border="0" >

  <tr><td>Бренд</td> <td> <input type="text" name="brand" ><td></tr>
  <tr><td>Модель</td> <td> <input type="text" name="model" ><td></tr>
  <tr><td>Ціна</td> <td><input type="text" name="price" ><td></tr>
  <tr><td>Рік</td> <td><input type="text" name="year" ><td></tr>
  <tr><td>Потужність</td> <td><input type="text" name="hp" ><td></tr>
  <tr><td>Об'єм</td> <td><input type="text" name="volume" ><td></tr>

  <tr><td>Пробіг</td> <td><input type="text" name="distance" ><td></tr>
 

  <tr><td>Стан</td> <td><select name='car_condition' >
  <option value="Б/У">Б/У</option> 
  <option value="Нова">Нова</option>
  </select><td></tr>

  
  <tr><td>Тип пального</td> <td><select name='fuel' >
  <option value="Бензин">Бензин</option> 
  <option value="Дизель">Дизель</option>
  <option value="Електро">Електро</option>
  </select><td></tr>

  <tr><td>Опис</td> <td><input type="text" name="description" ><td></tr>

  </table>
  <button type="submit">Загрузить</button>
</form>

<?
include_once 'carPreview.php';
previewCar(0);
previewCar(1);
previewCar(2);

include_once 'searchform.php';
?>