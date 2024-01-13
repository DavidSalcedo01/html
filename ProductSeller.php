<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Images/logoIcon.png"/>
    <link rel="stylesheet" href="Styles/sellerStyle.css">
    <title>Saloc - Zapatos</title>
</head>

<body>
    <header>
        <div class="logoBar">
            <a href="index.html"><img src="Images/logoSaloc2.png" alt="Saloc"/></a>
        </div>
        <div class="serchBar">
            <div class="shapeInput">
                <form action="" method="get" class="serchForm">
                    <input type="text" placeholder="Buscar" />
                    <button type="submit"><img class="serchButton" src="Images/serchIcon.ico"/></button>
                </form>
            </div>
        </div>
    </header>
    <main>
        <?php 
            require_once "Connection.php";
            if($_GET['type'] == "clothes"){
                //<a href="buySummary.php?type=clothes&prName=<?php echo $data['productName'];
                $sql = mysqli_query($connection, "SELECT * FROM `clothes`");
                while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                        <div class="contProducts">
                            <a href="productDetails.php?type=Clothes&prName=<?php echo $data['productName'];?>">
                                <div class="products">
                                    <img src="Images/Clothes/<?php echo $data['image']; ?>" alt="ProductImage">
                                    <h1><?php echo $data['productName'];?></h1>
                                    <p><?php echo $data['price'];?></p>
                                </div>
                            </a>
                        </div>
                    <?php
                }
            }
            elseif($_GET['type'] == "shoes"){

                $sql = mysqli_query($connection, "SELECT * FROM `shoes`");
                while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                        <div class="contProducts">
                            <a href="productDetails.php?type=Shoes&prName=<?php echo $data['productName'];?>">
                                <div class="products">
                                    <img src="Images/Shoes/<?php echo $data['image']; ?>" alt="ProductImage">
                                    <h1><?php echo $data['productName']; ?></h1>
                                    <p><?php echo $data['price'];?></p>
                                </div>
                            </a>
                        </div>
                    <?php
                }
            }
            elseif($_GET['type'] == "jewelry"){
                $sql = mysqli_query($connection, "SELECT * FROM `jewelry`");
                while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                        <div class="contProducts">
                            <a href="productDetails.php?type=Jewelry&prName=<?php echo $data['productName'];?>">
                                <div class="products">
                                    <img src="Images/Jewelry/<?php echo $data['image']; ?>" alt="ProductImage">
                                    <h1><?php echo $data['productName']; ?></h1>
                                    <p><?php echo $data['price'];?></p>
                                </div>
                            </a>
                        </div>
                    <?php
                }
            }
        mysqli_close($connection);
        ?>
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
</"html>