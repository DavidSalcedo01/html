<?php
    require_once "Connection.php";
    date_default_timezone_set('America/Mexico_city');
    session_start();
    $prName = $_GET['prName'];
    $type = $_GET['type'];
    if(!isset($_SESSION['user'])){
        header("Location: login.html");
    }
    else{
        $user = $_SESSION['user'];
    }

    $sql = mysqli_query($connection, "SELECT * FROM `users` WHERE email='$user'");
    $data = mysqli_fetch_assoc($sql);

    $sqlProduct = mysqli_query($connection, "SELECT * FROM `$type` WHERE productName='$prName'");
    $summ = mysqli_fetch_assoc($sqlProduct);
    if ($type != "Jewelry") {
        $sizes = $summ['sizes'];
    }


    if(isset($_POST['btnSubmit'])){
        if(!isset($_SESSION['user'])){
            header("Location: login.html");
        }
        else{
            $user = $_SESSION['user'];
            $prName = $_POST['prName'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];
            $date = date("Y-m-d H:i:s");
            $sizes = $_POST["sizes"];
            $image = $_POST["image"];

            $sqlInsert = mysqli_query($connection, "INSERT INTO sales (productName, amount, sizes, price, costumerUser, date, image, type) VALUES ('$prName','$amount','$sizes','$price','$user','$date','$image', '$type')");
            header("Location: index.html");
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/detailsSyle.css">
    <link rel="shortcut icon" href="Images/logoIcon.png" />
    <title>Producto - Saloc</title>
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
        <div class="divProduct">
            <img src="Images/<?php echo $type; ?>/<?php echo $summ['image']; ?>" alt="Clothes">
            <div class="divCont">
                <h1><?php echo $summ['productName']; ?></h1>
                <p id="description"><?php echo $summ['description']; ?></p>
                <p id="price">MXN <?php echo $summ['price']; ?></p>
                <form action="" method="post">
                    <?php
                        if ($type != "Jewelry") { ?>
                            <label for="sizes">Tallas:</label>
                            <select name="sizes" id="sizes" required>
                            <?php 
                                if ($type == "Clothes") {
                                    if(str_contains($sizes, 'XS')){
                                        echo '<option value="XS">XS</option>';
                                    }
                                    if(str_contains($sizes, 'S')){
                                        echo '<option value="S">S</option>';
                                    }
                                    if(str_contains($sizes, 'M')){
                                        echo '<option value="M">M</option>';
                                    } 
                                    if(str_contains($sizes, 'L')){
                                    echo '<option value="L">L</option>';
                                    }
                                    if(str_contains($sizes, 'XL')){
                                        echo '<option value="XL">XL</option>';
                                    }
                                }
                                if ($type == "Shoes") {
                                    if(str_contains($sizes, '22')){
                                        echo '<option value="22">22</option>';
                                    }
                                    if(str_contains($sizes, '22.5')){
                                        echo '<option value="22.5">22.5</option>';
                                    }
                                    if(str_contains($sizes, '23')){
                                        echo '<option value="23">23</option>';
                                    } 
                                    if(str_contains($sizes, '23.5')){
                                    echo '<option value="23.5">23.5</option>';
                                    }
                                    if(str_contains($sizes, '24')){
                                        echo '<option value="24">24</option>';
                                    }
                                    if(str_contains($sizes, '24.5')){
                                        echo '<option value="24.5">24.5</option>';
                                    }
                                    if(str_contains($sizes, '25')){
                                        echo '<option value="25">25</option>';
                                    }
                                    if(str_contains($sizes, '25.5')){
                                        echo '<option value="25.5">25.5</option>';
                                    }
                                    if(str_contains($sizes, '26')){
                                        echo '<option value="26">26</option>';
                                    }
                                }
                            ?>
                            </select><br>
                        <?php } ?>
                    <label for="amount">Cantidad:</label>
                    <input type="number" id="amount" name="amount" required><br>

                    <input type="text" id="image" name="image" value="<?php echo $summ['image']; ?>" style="display: none;">
                    <input type="number" id="price" name="price" value="<?php echo $summ['price']; ?>" style="display: none;">
                    <input type="text" id="prName" name="prName" value="<?php echo $summ['productName']; ?>" style="display: none;">
                    <input type="text" id="type" name="type" value="<?php echo $type; ?>" style="display: none;">
                    <button type="submit" name="btnSubmit">Añadir a carrito</button>
                </form>
            </div>
        </div>
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