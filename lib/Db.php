<?php

class Datab extends PDO {

// Делаем через PDO - легче на др базы переделать
    public function __construct() {
        parent::__construct('mysql:host=localhost;dbname=work', 'root', 'adnnad09');
//можно было названия в конфиг вынести но для такого теста вроде не обязательно
    }

}

?>