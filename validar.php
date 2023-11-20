<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Respuesta</title>
</head>

<body>

    <?php
        if ($_POST["nombre"] != ''){
            $nombre = true;
        }else{
            $nombre = false;
        }
        if ($_POST["apellidos"] != ''){
            $apellidos = true;
        }else{
            $apellidos = false;
        }
        if ($_POST["libro"] != ''){
            $libro = true;
        }else{
            $libro = false;
        }
        if ($_POST["fecha"] != ''){
            $fechaHoy = date('d-m-Y');
            if(date('d-m-Y', strtotime($_POST["fecha"])) >= $fechaHoy){
                $fecha = true;
                $fechaDevolucion = date('d-m-Y', strtotime($_POST["fecha"]. '+ 10 days'));
            }
            else{
                $fecha = false;
            }
        }else{
            $fecha = false;
        }
        if ($_POST["dni"] != '' AND strlen($_POST["dni"]) == 9){
            $letra = obtenerLetra($_POST["dni"]);
            if ($letra == substr($_POST["dni"], -1)){
                $dni = true;
            }
            else{
                $dni = false;

            }
        }else{
            $dni = false;
        }
        if ($_POST["email"] != '' && validarEmail($_POST["email"])){
            $email = true;
        }else{
            $email = false;
        }
        if ($_POST["isbn"] == ''){
            $isbn = true;
        }else{
            $isbnNum = str_replace('-', '', $_POST["isbn"]);
            if((strlen($isbnNum) == 10) OR (strlen($isbnNum) == 13)){
                $numControl = numControl($isbnNum);
                $isbn = substr($isbnNum, -1) == $numControl;
            }
            else{
                $isbn = false;
            }
        }

        function obtenerLetra($dniP){
            $letras = array("T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B","N","J","Z","S","Q","V","H","L","C","K","E");
            $nums =  substr($dniP, 0, -1);
            $pos = (int)$nums % 23;
            return $letras[(int)$pos];
        }

        function validarEmail($email){
            $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
            if(preg_match($pattern, $email)){
                return true;
            }
            else{
                return false;
            }
        }

        function numControl($isbn){
            if(strlen($isbn) == 10){
                $recortado = substr($isbn,0,-1);
                $control = ((int)substr($recortado,0,1) * 1 + (int)substr($recortado,1,1) * 2 + (int)substr($recortado,2,1) * 3 + (int)substr($recortado,3,1) * 4 + (int)substr($recortado,4,1) * 5 + (int)substr($recortado,5,1) * 6 + (int)substr($recortado,6,1) * 7 + (int)substr($recortado,7,1) * 8 + (int)substr($recortado,8,1) * 9) % 11;
                if($control == 10){
                    return 'X';
                }else{
                    return $control;
                }
            }
            elseif(strlen($isbn) == 13){
                $recortado = substr($isbn,0,-1);
                $control = ((int)substr($recortado,0,1) * 1 + (int)substr($recortado,1,1) * 3 + (int)substr($recortado,2,1) * 1 + (int)substr($recortado,3,1) * 3 + (int)substr($recortado,4,1) * 1 + (int)substr($recortado,5,1) * 3 + (int)substr($recortado,6,1) * 1 + (int)substr($recortado,7,1) * 3 + (int)substr($recortado,8,1) * 1 + (int)substr($recortado,9,1) * 3 + (int)substr($recortado,10,1) * 1 + (int)substr($recortado,11,1) * 3) % 10;
                return 10 - $control;
            }
        }
        
    ?>

    <?php if($nombre == true AND $apellidos == true AND $libro == true AND $fecha == true AND $dni == true AND $email == true AND $isbn == true) : ?>
        <p>Nombre de usuario: <?=$_POST["nombre"]?> <?=$_POST["apellidos"] ?></p>
        <p>Fecha de devolucion: <?=$fechaDevolucion?></p>
        <p>DNI: <?=$_POST["dni"]?></p>
    <?php else : ?>
        <?php if($nombre == false) : ?>
            <p>El nombre está vacío</p>
        <?php endif;?>
        <?php if($apellidos == false) : ?>
            <p>Los apellidos están vacíos</p>
        <?php endif;?>
        <?php if($libro == false) : ?>
            <p>El libro está vacío</p>
        <?php endif;?>
        <?php if($fecha == false AND $_POST["fecha"] == '') : ?>
            <p>La fecha está vacía</p>
        <?php elseif($fecha == false) : ?>
            <p>La fecha es incorrecta, la fecha debe ser mayor o igual al dia actual</p>
        <?php endif;?>
        <?php if($dni == false AND $_POST["dni"] == '') : ?>
            <p>El dni está vacío</p>
        <?php elseif($dni == false AND $_POST["dni"] != '') : ?>
            <p>El dni es incorrecto, la letra correcta es <?=$letra?> </p>
        <?php endif;?>
        <?php if($email == false AND $_POST["email"] == '') : ?>
            <p>El email está vacío</p>
        <?php elseif($email == false) : ?>
            <p>El email es incorrecto: <?= $_POST["email"]?> </p>
        <?php endif;?>
        <?php if($isbn == false) : ?>
            <p>El isbn es incorrecto, el digito de control deberia ser <?=$numControl?></p>
        <?php endif;?>
    <?php endif;?>

</body>

</html>