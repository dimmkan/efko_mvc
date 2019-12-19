<?php

class Controller_Main extends Controller
{

    function action_index()
    {
        session_start();
        if(isset($_SESSION['userData'])){
            header('Location: /list');
        }else{
            $this->view->generate('login_view.php', 'template_view.php');
        }
    }

    function action_errorLogin()
    {
        $data['errorMessage'] = "Неверное имя пользователя или пароль";
        $this->view->generate('login_view.php', 'template_view.php', $data);
    }

}