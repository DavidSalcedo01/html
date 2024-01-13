<?php
    require_once "Connection.php";

    if(isset($_POST['btnSubmit'])){
        $name = $_POST['name'];
        $price = $_POST['price'];

        if($_GET['type'] == "clothes"){
            $sql = mysqli_query($connection, "SELECT * FROM clothes WHERE productName='$name' AND price='$price'");
            $sqlDelete = mysqli_query($connection, "DELETE FROM clothes WHERE productName='$name' AND price='$price'");
        }
        elseif($_GET['type'] == "shoes"){
            $sql = mysqli_query($connection, "SELECT * FROM shoes WHERE productName='$name' AND price='$price'");
            $sqlDelete = mysqli_query($connection, "DELETE FROM shoes WHERE productName='$name' AND price='$price'");
        }
        elseif($_GET['type'] == "jewelry"){
            $sql = mysqli_query($connection, "SELECT * FROM jewelry WHERE productName='$name' AND price='$price'");
            $sqlDelete = mysqli_query($connection, "DELETE FROM jewelry WHERE productName='$name' AND price='$price'");
            /*$sql2 = mysqli_query($connection, "CREATE TRIGGER bitacora_productoDelete
                AFTER DELETE ON jewelry
                FOR EACH ROW
                BEGIN
                INSERT INTO bitacora_productos (Fecha, Sentencia, Contrasentencia)
                VALUES (NOW(), 
                        CONCAT('DELETE FROM jewelry WHERE productName = ', OLD.productName),
                        CONCAT('INSERT INTO jewelry (productName,price,description) VALUES (\'', OLD.productName, '\', \'', OLD.price, '\', ', OLD.description, ');', OLD.productName)
                );
                    IF ROW_COUNT() = 0 THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_productoDelete';
                    END IF;
                END;
                ");*/
        }

        $res = mysqli_num_rows($sql);

        if($res != 1)
        {
            echo '<h1 style="color: red; font-weight: bold; text-align: center;">El producto seleccionado no fue encontrado</h1>';
        }
        else{
            header("Location: adminDashBoard.html");
        }

    }
    mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/addProduct.css">
    <link rel="shortcut icon" href="Images/logoIcon.png" />
    <title>Eliminar - Saloc</title>
</head>
<body>
<header>
        <div class="logoBar">
            <a href="index.html"><img src="Images/logoSaloc2.png" alt="Saloc"/></a>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="Registration.html">Registro</a></li>
                <li><a href="#">Productos</a>
                    <ul>
                        <li><a href="Clothes.html">Ropa</a></li>
                        <li><a href="Shoes.html">Zapatos</a></li>
                        <li><a href="Jewelry.html">Joyería</a></li>
                    </ul>
                </li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Salir</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="" method="post">
            <h1>Elimine un producto</h1>
            <div class="divForms">

                <label for="name">Nombre: </label>
                <input type="text" name="name" id="name" require>
    
                <label for="price">Precio: </label>
                <input type="number" name="price" id="price" require>
                
            </div>
            <div>
                <button type="submit" name="btnSubmit">Eliminar</button>
            </div>
        </form>
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
                la creación del frontEnd y BackEnd sin la ayuda de ninguno framework o librería que facilite ninguno de estos ámbitos. 
                Para el aparatado de frontEnd se utilizo html y css solamente, para el apartado de backEnd se utilizo php y como base de datos mysql</p>
        </div>
    </footer>
</body>
</html>

