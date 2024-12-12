<?php
require 'login.php';

if(login('juanito2@gmail.com', '123456')){
    echo 'Login Correcto' . PHP_EOL;
}else{
    echo 'Login incorrecto' . PHP_EOL;
}