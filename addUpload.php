<?
// File upload.php
// Если в $_FILES существует "images" и она не NULL
include_once 'addInsertToDb.php';

            addCarInfo($_POST['brand'],$_POST['price'],$_POST['hp'],$_POST['volume'],$_POST['fuel'],$_POST['distance'],$_POST['car_condition'],$_POST['description'],$_POST['model'],$_POST['year']);

if (isset($_FILES['images'])) {
    // Изменим структуру $_FILES
    foreach($_FILES['images'] as $key => $value) {
        foreach($value as $k => $v) {
            $_FILES['images'][$k][$key] = $v;
        }
        // Удалим старые ключи
        unset($_FILES['images'][$key]);
    }
    // Загружаем все картинки по порядку
    foreach ($_FILES['images'] as $k => $v) {
        // Загружаем по одному файлу
        $fileName = $_FILES['images'][$k]['name'];
        $fileTmpName = $_FILES['images'][$k]['tmp_name'];
        $fileType = $_FILES['images'][$k]['type'];
        $fileSize = $_FILES['images'][$k]['size'];
        $errorCode = $_FILES['images'][$k]['error'];

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
            // Массив с названиями ошибок
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];
            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            // Выведем название ошибки
            die($outputMessage);
        } else {
            // Создадим ресурс FileInfo
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            // Получим MIME-тип
            $mime = (string) finfo_file($fi, $fileTmpName);
            // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
            if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
            // Результат функции запишем в переменную
            $image = getimagesize($fileTmpName);


            // // Зададим ограничения для картинок
            // $limitBytes  = 1024 * 1024 * 5;
            // $limitWidth  = 1280;
            // $limitHeight = 768;
            // // Проверим нужные параметры
            // if (filesize($fileTmpName) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');
            // if ($image[1] > $limitHeight)             die('Высота изображения не должна превышать 768 точек.');
            // if ($image[0] > $limitWidth)              die('Ширина изображения не должна превышать 1280 точек.');
            // // Сгенерируем новое имя файла через функцию getRandomFileName()
            
            
            
            $name = getRandomFileName($fileTmpName);
            // Сгенерируем расширение файла на основе типа картинки
            $extension = image_type_to_extension($image[2]);
            // Сократим .jpeg до .jpg
            $format = str_replace('jpeg', 'jpg', $extension);
            // Переместим картинку с новым именем и расширением в папку /pics
           // $imgPach = __DIR__ . '/upload/' . $name . $format;
            if (!move_uploaded_file($fileTmpName, __DIR__ . '/upload/' . $name . $format)) {
                die('При записи изображения на диск произошла ошибка.');
            }
            //require_once('insertToDb.php');
            
            addCarPhoto('http://salo0n'. '/upload/' . $name . $format);//-----?

        }
    };
    echo 'Файли успішно завантажені!';
    $user = checkUser();
   //echo $user['user_id'];
};


// File functions.php
function getRandomFileName($path)
{
    $path = $path ? $path . '/' : '';

    do {
        $name = md5(microtime() . rand(0, 9999));
        $file = $path . $name;
    } while (file_exists($file));

    return $name;
}
?>

<div> Транзакцію проведено успішно! </div>