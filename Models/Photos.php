<?php

require_once "../models/connectDb.php";
require_once "../models/TraitDb.php";

class Photos
{
    use CarShop;

    private $photoNames = array();

    public function __construct($itemId)
    {
        $dataBase = $this->prepareConnectionDb();
        $smth = $dataBase->dbh->prepare("SELECT name FROM photos WHERE photos.fk_goods_id = :itemId");
        $smth->bindParam(':itemId', $itemId);
        if ($smth->execute())
        {
            while ($row = $smth->fetch())
            {
                array_push($this->photoNames, $row['name']);
            }
        }
    }

    public function getPhotoNames()
    {
        return $this->photoNames;
    }
}

class Photo
{
    use CarShop;

    private $name;
    private $category;
    private $dataBase;
    private $newGoodsId;

    public function __construct($category)
    {
        $this->category = $category;
        $dataBase = $this->prepareConnectionDb();
        $this->newGoodsId = $this->getGoodsMaxId($dataBase);
    }

    public function uploadImage($FILES)
    {
        $_FILES = $FILES;
        if (isset($_FILES['images']))
        {
            foreach($_FILES['images'] as $key => $value)
            {
                foreach($value as $k => $v)
                {
                    $_FILES['images'][$k][$key] = $v;
                }

                unset($_FILES['images'][$key]);
            }
            foreach ($_FILES['images'] as $k => $v)
            {
                // Загружаем по одному файлу
                $fileName = $_FILES['images'][$k]['name'];
                $fileTmpName = $_FILES['images'][$k]['tmp_name'];
                $fileType = $_FILES['images'][$k]['type'];
                $fileSize = $_FILES['images'][$k]['size'];
                $errorCode = $_FILES['images'][$k]['error'];
                if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName))
                {
                    $errorMessages = [
                        UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                        UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                        UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
                        UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
                        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                        UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
                    ];
                    // Зададим неизвестную ошибку
                    $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
                    // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
                    $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
                    // Выведем название ошибки
                    die($outputMessage);
                }
                else
                {
                    $fi = finfo_open(FILEINFO_MIME_TYPE);
                    $mime = (string)finfo_file($fi, $fileTmpName);
                    if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

                    $image = getimagesize($fileTmpName);

                    $name = $this->getRandomFileName($fileTmpName);
                    $extension = image_type_to_extension($image[2]);
                    $format = str_replace('jpeg', 'jpg', $extension);

                    if (!move_uploaded_file($fileTmpName,   '..' .'/upload/' . $name . $format))
                    {
                        die('Error while file upload ');
                    }
                    $this->name = $name . $format;
                    $this->insertPhotoName($this->name);
                }
            }
        }
    }

    private function getRandomFileName($path)
    {
        $path = $path ? $path . '/' : '';
        do
        {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name;
        } while (file_exists($file));

        return $name;
    }

    private function insertPhotoName()
    {
        $dataBase = $this->prepareConnectionDb();
        $smth=$dataBase->dbh->prepare("INSERT INTO `goods` (`id`, `category`) VALUES ( '".($this->newGoodsId[0]+1)."','$this->category')");
        $smth->execute();

        $smth=$dataBase->dbh->prepare("INSERT INTO `photos` (`id`, `fk_goods_id`, `name`) VALUES (NULL, '".($this->newGoodsId[0]+1)."', '$this->name')");
        $smth->execute();
    }
}
