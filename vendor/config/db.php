<?php

$connect = mysqli_connect('localhost', 'root', 'root', 'voile');

if (!$connect) {
    die('Ошибка подключения к базе данных');
}