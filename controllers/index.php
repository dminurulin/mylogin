<?php

class Index extends Controller {

    public function __construct() {
        parent::__construct();
        $this->view->rend('index');       
    }
    public function regsuccess() {
        $this->view->rend('forms/regsuccess_form');
      
    }
    public function changesuccess() {
        $this->view->rend('forms/changesuccess_form');        
    }
}

?>