<?php

class BootUp {

    public function __construct() {
        if (!(isset($_GET['route']))) {
            $route = 'index';
//нет параметров - идем в контроллер index, по тестовому заданию можно было сразу в auth, но так логичнее чтобы потом что-то сюда прикручивать
// роутер мой, более менее годится для развития во чтото большее:  /cont/method/param вызывает method контроллера cont с параметром param
        } else {
            $route = $_GET['route'];
        }
        session_name("Auth");
        session_start();
        $route = rtrim($route, '/');
        $route = explode('/', $route);
        $ControllerFile = 'controllers/' . $route[0] . '.php';
        //  echo $ControllerFile;
        if (file_exists($ControllerFile)) {
            //    echo "идем в контроллер";
            require $ControllerFile;
        } else {
            require 'controllers/err.php';
            $controller = new Err();
            $controller->nofile();
            return false;
        }
        $controller = new $route[0];
        $controller->ModelLoad($route[0]);
        if (isset($route[2])) {
            $method = $route[1];
            $par = $route[2];
            $controller->$method($par);
        } else {
            if (isset($route[1])) {
                //echo $route[1];
                $method = $route[1];
                $controller->$method('');
            }
        }
    }

}

?>
