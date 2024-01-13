<?php 
    require_once "Connection.php";
    
    $sqlB = mysqli_query($connection, "SELECT * FROM bitacora_usuarios");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/binnaclesStyle.css">
    <link rel="shortcut icon" href="Images/logoIcon.png" />
    <title>Bitacora - Saloc</title>
</head>
<body>
    <header>
        <div class="logoBar">
            <a href="index.html"><img src="Images/logoSaloc2.png" alt="Saloc"/></a>
        </div>
    </header>
    <main>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Sentencia</th>
                <th id="brd">Contra sentencia</th>
            </tr>
                <?php
                    while ($data = mysqli_fetch_assoc($sqlB)) {
                        echo '<tr>
                                <td>'
                                    .$data['Fecha'].'
                                </td>
                                <td>
                                    '.$data['Sentencia'].'
                                </td>
                                <td id="brd">
                                    '.$data['Contrasentencia'].'
                                </td>
                              </tr>';
                    }
                ?>
        </table>
        <?php mysqli_close($connection);?>
    </main>
    <footer>
        <div class="divContact">
            <img src="Images/logoSaloc2.png" alt="Saloc">
            <p><span>Nombre: </span>Salcedo Monroy Joshua David 22110109 4P</p>
            <p><span>Correo: </span>a22110109@ceti.mx</p>
            <p><span>Materia: </span>Programación WEB - Bases de datos</p>
            <p><span>Ubicación: </span><a href="https://goo.gl/maps/JqHEX1eEVCcDfjn58">Jalisco Mexico</a></p>
        </div>
        <div class="divInfo">
            <p>Esta es una pagina para el proyecto integrador de Programación web I y Base de datos I que comprender
                la creación del frontEnd y BackEnd sin la ayuda de ninguno framework o librería que facilite ninguno de
                estos ámbitos.
                Para el aparatado de frontEnd se utilizo html y css solamente, para el apartado de backEnd se utilizo
                php y como base de datos mysql. PROYECTO SIN FINES LE LUCRO</p>
        </div>
    </footer>
</body>
</html>