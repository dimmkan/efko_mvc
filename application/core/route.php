<?php


class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/',$_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }

        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path))
        {
            try{
                include "application/models/".$model_file;
            }catch (Exception $e){
                Route::ErrorPage404();
            }
        }

        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            try{
                include "application/controllers/".$controller_file;
            }catch (Exception $e){
                Route::ErrorPage404();
            }

        }
        else
        {
            Route::ErrorPage404();
        }


        $controller = new $controller_name;
        $action = $action_name;
        if(!empty($routes[3])){
            if (method_exists($controller, $action)) {
                $controller->$action($routes[3]);
            } else {
                Route::ErrorPage404();
            }
        }else {
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                Route::ErrorPage404();
            }
        }

    }

    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location:'.$host.'404');
    }
}