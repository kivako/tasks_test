<?php
namespace Core;

/*
 * Базовый класс приложения
 */

class App
{
    public $controller = 'Site';
    public $action = 'Index';
    public static $db;
    public static $isAdmin = false;

    public function __construct($config)
    {
        if (isset($config['db']['dsn']))
        {
            self::$db = new \PDO($config['db']['dsn']);
            $this->createTables();
        }

        session_start();

        if (isset($_SESSION['isAdmin'])) self::$isAdmin = true;
    }

    /*
     * Запуск приложения
     */
    public function run()
    {
        $this->loadParams();
        $controllerClassName = $this->controller.'Controller';
        require "protected/controllers/{$controllerClassName}.php" ;
        $controller = new $controllerClassName();
        $actionClassName = 'action'.$this->action;
        $controller->$actionClassName();
    }

    /*
     * Парсим параметры Url
     */
    public function loadParams()
    {
        if (isset($_GET['r']))
        {
            list($this->controller, $this->action) = explode("/", $_GET['r']);
        }
    }

    /*
     * Создаем таблицы в случае их отсутствия
     */
    public function createTables() {
        $sql =
            'CREATE TABLE IF NOT EXISTS tasks (
                    id INTEGER PRIMARY KEY,
                    name  VARCHAR (50),
                    email  VARCHAR (150),
                    text TEXT,                                   
                    completed  INTEGER DEFAULT 0,
                    text_modified INTEGER DEFAULT 0                                  
                    )';

        self::$db->exec($sql);
    }
}