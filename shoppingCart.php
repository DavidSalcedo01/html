<?php
    require_once "Connection.php";
    session_start();
    global $total, $subTotal, $user;
    if(!isset($_SESSION['user'])){
        header("Location: login.html");
    }
    else{
        $user = $_SESSION['user'];
        $sql = mysqli_query($connection, "SELECT * FROM sales WHERE costumerUser='$user'");
        $sqlS = mysqli_query($connection, "SELECT price,amount FROM sales WHERE costumerUser='$user'");
        while ($sub = mysqli_fetch_assoc($sqlS)) {
            $subTotal += $sub['price']*$sub['amount'];
        }
        $total = $subTotal + 120;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/cartStyle.css">
    <link rel="shortcut icon" href="Images/logoIcon.png" />
    <title>Carrito - Saloc</title>
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
        <table class="products">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th id="brd">Cantidad</th>
            </tr>
                <?php
                while ($data = mysqli_fetch_assoc($sql)) {
                ?>
                    <tr>
                        <td><img src="Images/<?php echo $data['type'];?>/<?php echo $data['image']; ?>" alt="Producto"></td>
                        <td><?php echo $data['productName']; ?></td>
                        <td><?php echo $data['price']; ?></td>
                        <td id="brd"><?php echo $data['amount']; ?></td>
                        <td id="blnk1">
                            <a href="deleteSale.php?userName=<?php echo $user;?>&prdName=<?php echo $data['productName'];?>&price=<?php echo $data['price']; ?>&amount=<?php echo $data['amount']; ?>">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                                        <path fill="#7e0101" d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
                                    </svg>
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php
                }?>
        </table>
        <form action="pdf.php" method="post" class="divSumm">
            <table class="summary">
                <tr>
                    <th>Resumen</th>
                    <th></th>
                </tr>
                <tr>
                    <td id="spacing">Subtotal:</td>
                    <td>MXN$ <?php echo $subTotal;?></td>
                </tr>
                <tr>
                    <td id="spacing">Gastos de envió:</td>
                    <td>MXN$ 120</td>
                </tr>
                <tr>
                    <td id="spacing">Total a pagar:</td>
                    <td>MXN$ <?php echo $total;?></td>
                </tr>
            </table>
            <input type="text" id="subtotal" name="subtotal" value="<?php echo $subTotal; ?>" style="display: none;">
            <input type="text" id="total" name="total" value="<?php echo $total; ?>" style="display: none;">
            <button type="submit" name="btnSubmit">Pagar</button>
        </form>
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