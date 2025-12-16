<?php
function cabecera($texto, $css) { 
    ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title><?php echo $texto; ?></title>
            <meta charset="UTF-8" />
            <meta name="keywords" content="tus palabras clave, aqui" />
            <meta name="description" content="breve descripcion del sitio" />
            <meta name="author" content="autor del documento" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <?php if ($css !== ''): ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $css; ?>" />
            <?php endif; ?>
        </head>
        <body>
            <h1><?php echo $texto; ?></h1>
            <?php if (isset($_SESSION['nombre'])) {
                echo "User: " . ($_SESSION['nombre']);}
            ?>
        <a href="logout.php">Cerrar sesión</a>
    </p>
<?php
}
function ver_paso1() {
    cabecera('Registrar socio: Paso 1', 'estilos.css');
    ?>
        
        <form action="bienvenida.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                    <input type="hidden" name="paso" value="1" >

                    <input type="hidden" name="boletin" value="<?php poner_valor("boletin") ?>">
                    <input type="hidden" name="comentario" value="<?php poner_valor("comentario") ?>">
                    <input type="hidden" name="sexo" value="<?php poner_valor("sexo") ?>">
                    <input type="hidden" name="widget" value="<?php poner_valor("widget") ?>">
                    
                    <label for="nombre">Nombre:(*)</label>
                    <input type="text" name="nombre" id="nombre" value="<?php poner_valor("nombre") ?>"required></br></br>
                    
                    <label for="apellido">Apellido:(*)</label>
                    <input type="text" name="apellido" id="apellido" value="<?php poner_valor("apellido") ?>"required></br></br>

                   
                <input type="submit" name="siguiente" value="siguiente">
            </fieldset>
            </form>
 <?php
}

function ver_paso2() {
    cabecera('Registrar socio: Paso 2', 'estilos.css');
    ?>
        
        <form action="bienvenida.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <input type="hidden" name="paso" value="2" >
                <input type="hidden" name="nombre" value="<?php poner_valor("nombre") ?>">
                <input type="hidden" name="apellido" value="<?php poner_valor("apellido") ?>">
                <input type="hidden" name="boletin" value="<?php poner_valor("boletin") ?>">
                <input type="hidden" name="comentario" value="<?php poner_valor("comentario") ?>">
                <h3>Tu sexo:</h3>
                <label>Hombre <input type="radio" name="sexo" value="Hombre" <?php poner_checked("sexo","Hombre");?> required /></label><br/>
                <label>Mujer <input type="radio" name="sexo" value="Mujer" <?php poner_checked("sexo","Mujer");?>></label>
                
                <label for="widget"><h3>¿Cual es tu Widget favorito?</h3></label>
                <select name="widget" id="widget">
                    <option value="The MegaWidget" <?php poner_selected("widget","The MegaWidget")?>>The MegaWidget</option>
                    <option value="The MiniWidget" <?php poner_selected("widget","The MiniWidget")?>>The MiniWidget</option>
                </select>
                <br/><br/>
              

                <input type="submit" name="siguiente" value="siguiente">
                <input type="submit" name="anterior" value="anterior">

            </fieldset>
            </form>
    <?php
}

function ver_paso3() {
    cabecera('Registrar socio: Paso 3', 'estilos.css');
    ?>
        
        <form action="bienvenida.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <input type="hidden" name="paso" value="3" >
                <input type="hidden" name="nombre" value="<?php poner_valor("nombre") ?>">
                    <input type="hidden" name="apellido" value="<?php poner_valor("apellido") ?>">
                    <input type="hidden" name="sexo" value="<?php poner_valor("sexo") ?>">
                    <input type="hidden" name="widget" value="<?php poner_valor("widget") ?>">
                
                <h3>¿Quieres recibir nuestro boletín de noticias?</h3>
                <input type="checkbox" name="boletin" value="Si" <?php poner_checked("boletin","Si")?>/>
                
                <h3>Algún comentario?</h3>
                <textarea name="comentario" rows="5" cols="40"><?php poner_valor("comentario")?></textarea>
                <br/><br/>
            </fieldset>
            <input type="submit" name="siguiente" value="siguiente">
            <input type="submit" name="anterior" value="anterior">
        </form>

    <?php
}

function ver_paso4(){
    cabecera('Registrar socio: Paso 4', 'estilos.css');
    ?>

    <form action="bienvenida.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <input type="hidden" name="paso" value="4" >
                    <input type="hidden" name="nombre" value="<?php poner_valor("nombre") ?>">
                    <input type="hidden" name="apellido" value="<?php poner_valor("apellido") ?>">
                    <input type="hidden" name="sexo" value="<?php poner_valor("sexo") ?>">
                    <input type="hidden" name="widget" value="<?php poner_valor("widget") ?>">
                    <input type="hidden" name="comentario" value="<?php poner_valor("comentario") ?>">
                    <input type="hidden" name="boletin" value="<?php poner_valor("boletin")?>">



                    <label for="foto">Adjunta una imagen a tu gusto:</label>
            <input type="file" name="foto" id="foto" accept="image/jpeg" required><br><br>

            <input type="submit" name="enviar" value="enviar">
            <input type="submit" name="anterior" value="anterior">


        </fieldset>



<?php
}

function procesar_paso1() {
ver_paso2();
}

function procesar_paso2() {
    if (isset($_POST["anterior"])) {
        ver_paso1();
    }
    else {
        ver_paso3();
    }
}

function procesar_paso3() {
    if (isset($_POST["anterior"])) {
        ver_paso2();
    }
    else {
        ver_paso4();
    }
}


function procesar_paso4() {
    if (isset($_POST["anterior"]) )  {
        ver_paso3();
    }
    else {
  
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
       
        // Comprobar que el archivo es JPEG
        if ( $_FILES['foto']['type']!='image/jpeg') {
           echo "Solo fotos JPEG, gracias!";
           
        }
        elseif ( !move_uploaded_file($_FILES['foto']['tmp_name'],"FOTOS/" . basename($_FILES['foto']['name'])))
          {
            echo "no se ha podido mover el archivo.";
          }
        else {
          ver_gracias();
        }

        
    } else {
        // Manejo de errores de subida
        $error = $_FILES['foto']['error'];
        switch ($error) {
            case 1:
                $mensaje = "La foto es mayor de lo que permite el servidor.";
                break;
            case 2:
                $mensaje = "La foto es mayor de lo que permite el script.";
                break;
            case 4:
                $mensaje = "No se ha subido ningún fichero.";
                break;
            default:
                $mensaje = "Por favor, contacte con el administrador.";
        }
        echo $mensaje;
    }
}
}

function poner_valor($campo){
    if(isset($_POST["$campo"])) echo $_POST[$campo];
}

function poner_checked($campo,$valor){
    if (isset($_POST[$campo]) && $_POST[$campo]==$valor) 
        echo "checked";
}


function poner_selected($campo,$valor){
    if (isset($_POST[$campo]) && $_POST[$campo]==$valor)
        echo "selected";
}

    


function ver_gracias() {
    ?>

    <h1>Gracias, has quedado registrado </h1>
    <p>Nombre: <?php poner_valor("nombre")?></p>
    <p>Apellido: <?php poner_valor("apellido")?></p>
    <p>Sexo:  <?php poner_valor("sexo")?></p>
    <p>WidgetFavorito:  <?php poner_valor("widget")?></p>
    <p>Deseas recibir boletin? <?php poner_valor("boletin")?></p>
    <p>Comentarios:     <?php poner_valor("comentario")?></p>
    <p> Imagen: <img src="FOTOS/<?php echo $_FILES["foto"]["name"]; ?>" alt="imagen"></p>
<?php
}
