<?php
// Inicia la sesión
session_start();

// Establece una variable de sesión
$_SESSION['login'] = 'Logeado';

// Imprime un mensaje de éxito
echo 'Variable de sesión establecida con éxito.';
?>