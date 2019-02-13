<?php
spl_autoload_register(function ($class){
    include $_SERVER['DOCUMENT_ROOT'].'/eshopApi/class/'.$class.'.php';
});