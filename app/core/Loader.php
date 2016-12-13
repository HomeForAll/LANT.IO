<?php

class Loader
{
    private static $paths = array();
    private static $directories = array();
    
    /*
     * Подключает файл класса по пути полученному из файла /app/config/paths.php,
     * если его нет, производит поиск, подключает и записывает путь к файлу в paths.php
     */
    public static function classLoad($class)
    {
        if (isset(static::$paths[$class])) {
            include_once static::$paths[$class];
        } else {
            self::getDirPaths(ROOT_DIR);
            
            foreach (static::$directories as $directory) {
                $path = $directory . '/' . $class . '.php';
                
                if (file_exists($path)) {
                    include_once $path;
                    self::setClassPath($class, $path);
                    self::putPathsToFile(static::$paths);
                    break;
                }
            }
        }
    }
    
    /*
     * Получает список директроий по указанному пути
     */
    private static function getDirectories($path)
    {
        chdir($path);
        
        $directories = array();
        $dirContent  = scandir($path);
        
        for ($i = 0; isset($dirContent[$i]); $i++) {
            if ($dirContent[$i] !== '.' && $dirContent[$i] !== '..' && is_dir($dirContent[$i])) {
                array_push($directories, $dirContent[$i]);
            }
        }
        
        return $directories;
    }
    
    /*
     * Генерирует пути папок которые находятся в заданной директории $path
     */
    private static function getDirPaths($path)
    {
        $path = str_replace('\\', '/', $path);
        
        array_push(static::$directories, (string)$path);
        
        $directories = self::getDirectories($path);
        
        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $dirPath = $path . '/' . $directory;
                self::getDirPaths($dirPath);
            }
        }
    }
    
    private static function setClassPath($className, $path)
    {
        static::$paths[$className] = (string)$path;
    }
    
    private static function putPathsToFile(Array $array)
    {
        file_put_contents(ROOT_DIR . '/app/config/paths.php', serialize($array));
    }
    
    public static function getPaths()
    {
        static::$paths = unserialize(file_get_contents(ROOT_DIR . '/app/config/paths.php'));
    }
}

