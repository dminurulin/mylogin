<?php

class View {

    public function __construct() {
        // Echo "View";
    }

    public function rend($name) {
        //      echo 'views/'.$name.'.php';
        require 'views/' . $name . '.php';
    }

}

?>
