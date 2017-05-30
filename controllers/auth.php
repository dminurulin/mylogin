<?php

class Auth extends Controller {

    public function __construct() {
        parent::__construct();
        if (isset($_SESSION['logged'])) {
            $this->change('');
            return false;
        }
    }
    public function enter() {
            $this->view->rend('templates/header');
            $this->view->rend('forms/login_form');
            $this->view->rend('templates/footer');  
    }

    public function go($nm) {
        // echo "GOGO"; 
        $this->model->run();
    }

    public function add() {
        $this->model->add();
    }

    public function addnewuser() {
        session_unset();
        $this->view->rend('addnewuser');
    }

    public function logout() {
        session_unset();
        $this->view->rend('index');
    }

    public function change() {
        $this->model->change();
        $this->view->rend('change');
    }

}

?>