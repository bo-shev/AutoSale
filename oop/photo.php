<?
    class photo 
    {
        public $name;
        public $path:

        function __construct($name, $path)
        {
            $this->name = $name;
            $this->path = $path;
        }

        function getRandomFileName($path)
        {
            $path = $path ? $path . '/' : '';

            do {
                $name = md5(microtime() . rand(0, 9999));
                $file = $path . $name;
            } while (file_exists($file));

            return $name;
        }
    }

?>