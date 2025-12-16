<?php 
$password = "1";
$user = "1";

    if ($user == $_POST['user'] && $password == $_POST['password']) {
        session_start();
        $_SESSION['nombre'] = $_POST['user'];
        header("Location: bienvenida.php");
                
    }
    else {
        echo "el usuario no es correcto";
    }

?>