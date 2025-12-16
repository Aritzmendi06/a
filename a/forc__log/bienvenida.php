<?php
include "funciones.php";
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["paso"])) { echo $_SESSION["nombre"] ;
    if ($_POST["paso"] == 1) {
        procesar_paso1();
    } elseif ($_POST["paso"] == 2) {
        procesar_paso2();
    } elseif ($_POST["paso"] == 3) {
        procesar_paso3();
    } else {
        procesar_paso4();
    }
} else {
    ver_paso1();
}
