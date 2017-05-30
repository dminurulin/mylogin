<?php

class Err extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function errorlogin() {
        $this->view->msg = 'Неверный логин или пароль';
        $this->view->rend('error');
        $this->view->rend('templates/menu');
        $this->view->rend('templates/footer'); 
    }

    public function nofile() {
        $this->view->msg = 'Ошибка: файл не существует';
        $this->view->rend('error');
        $this->view->rend('templates/footer');            
    }

    public function adderror($errortype) {
        $this->view->msg = 'Ошибка добавления (неизвестная)';
        if ($errortype == 'password') {
            $this->view->msg = 'Ошибка добавления: пароли не совпадаюn';
        } if ($errortype == 'wrongpassword') {
            $this->view->msg = 'Неверный пароль';
        }
        if ($errortype == 'alreadyexists') {
            $this->view->msg = 'Ошибка добавления: пользователь уже существует';
        }
        $this->view->rend('error');
        $this->view->rend('templates/menu');
        $this->view->rend('templates/footer'); 
    }

}

?>