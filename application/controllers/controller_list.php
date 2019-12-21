<?php


class Controller_list extends Controller
{
    function __construct()
    {
        $this->model = new Model_list();
        $this->view = new View();
    }

    function action_index()
    {
        session_start();
        if(isset($_SESSION['userData'])){
            $data['listApps'] = $this->model->getListApps();
            if(isset($_SESSION['statusMessage'])){
                $data['statusMessage'] = $_SESSION['statusMessage'];
            }
            $this->view->generate("list_view.php", "template_view.php", $data);
        }else{
            header('Location: /');
        }

    }

    function action_new()
    {
        $this->view->generate('edit_view.php', 'template_view.php');
    }

    function action_logout()
    {
        session_start();
        unset($_COOKIE[session_name()]);
        unset($_COOKIE[session_id()]);
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }

    function action_edit($appId)
    {
        $data = $this->model->getById($appId);
        $this->view->generate('edit_view.php', 'template_view.php', $data);
    }

    function action_save()
    {
        session_start();
        if(empty($_POST['id'])){
            $_POST['id'] = null;
            $_POST['userid'] = (int)$_SESSION['userData']['id'];
            (int)$_POST['fixed'] = ($_POST['fixed'] == "on" ? 1 : 0);
            $this->model->insert($_POST);
            $_SESSION['statusMessage'] = "Новая заявка создана!";
            header('Location: /list');
        }else{
            (int)$_POST['fixed'] = ($_POST['fixed'] == "on" ? 1 : 0);
            $this->model->update($_POST);
            $_SESSION['statusMessage'] = "Заявка обновлена!";
            header('Location: /list');
        }
    }

    function action_cancel()
    {
        header('Location: /list');
    }

    function action_delete($id)
    {
        session_start();
        $this->model->delete($id);
        $_SESSION['statusMessage'] = "Заявка удалена!";
        header('Location: /list');
    }
}