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
        $data['listApps'] = $this->model->getListApps();
        $this->view->generate("list_view.php", "template_view.php", $data);
    }

    function action_new()
    {
        echo "NEW APP";
    }

    function action_logout()
    {
        unset($_SESSION);
        header('Location: /');
    }

    function action_edit($appId)
    {
        echo $appId;
    }
}