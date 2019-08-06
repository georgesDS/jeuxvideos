<?php

$password = 'leblanc';
$hash_password = hash('sha256', $password); //Password encryption;
echo $password .' devient: </br>'.$hash_password;