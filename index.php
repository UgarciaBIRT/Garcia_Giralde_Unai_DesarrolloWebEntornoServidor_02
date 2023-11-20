<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Web Tema 2</title>
</head>

<body>

    <form action="validar.php" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" placeholder="Nombre" id="nombre" name="nombre">
        <br>
        <label for="apellidos">Apellidos</label>
        <input type="text" placeholder="Apellidos" id="apellidos" name="apellidos">
        <br>
        <label for="libro">Libro</label>
        <input type="text" placeholder="Libro" id="libro" name="libro">
        <br>
        <label for="email">Email</label>
        <input type="text" placeholder="Email" id="email" name="email">
        <br>
        <label for="fecha">Fecha de alquiler</label>
        <input type="date" id="fecha" name="fecha">
        <br>
        <label for="dni">DNI</label>
        <input type="text" id="dni" name="dni">
        <br>
        <label for="isbn">ISBN</label>
        <input type="text" id="isbn" name="isbn">
        <br>
        <input type="submit" value="enviar">

    </form>

</body>

</html>