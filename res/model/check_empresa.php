<?php
 
require_once 'init.php';
 
if (!isLoggedInEmpresa())
{
    header('Location: ../../../login.php');
}