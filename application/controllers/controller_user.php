<?php


class Controller_user extends Controller
{
    function __construct()
    {
        $this->model = new Model_user();
        $this->view = new View();
    }

    function action_login()
    {
        if($this->model->isAuthorizedUser($_POST['login'], $_POST['password'])){
            session_start();
            $_SESSION['userData'] = $this->model->getUserData($_POST['login']);
            header('Location: /list');
        }else{
            header('Location: /Main/errorLogin');
        }
    }
}