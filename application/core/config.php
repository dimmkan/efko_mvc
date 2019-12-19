<?php
$AppConfiguration = array();
$AppConfiguration["DB_DSN"] = "mysql:host=localhost;dbname=efko;charset=utf8;" ;
$AppConfiguration["DB_USERNAME"] = "root";
$AppConfiguration["DB_PASSWORD"] = "123";
defineConstants($AppConfiguration);

function defineConstants($constatsNameAndValues)
{
    foreach ($constatsNameAndValues as $constName => $constValue) {
        define($constName, $constValue);
    }
}