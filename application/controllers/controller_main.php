<?php


class Controller_Main extends Controller
{
    function action_index()
    {
        $this->view->generate('login_view.php', 'template_view.php');
    }

    function action_login(){
        if(isset($_POST['login']) && isset($_POST['password'])){
            if(Model_user::isAuthorizedUser($_POST['login'], $_POST['password'])){
                $this->view->generate('list_view.php', 'template_view.php');
            }else{
                $data['errorMessage'] = "Неверный логин или пароль!";
                $this->view->generate('login_view.php', 'template_view.php', $data);
            }
        }else{
            $this->view->generate('login_view.php', 'template_view.php');
        }
    }
}