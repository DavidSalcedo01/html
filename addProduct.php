
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/addProduct.css">
    <link rel="shortcut icon" href="Images/logoIcon.png" />
    <title>Agregar - Saloc</title>
</head>
<body>
<header>
        <div class="logoBar">
            <a href="index.html"><img src="Images/logoSaloc2.png" alt="Saloc"/></a>
        </div>
        <nav>
            <ul>
                <li><a href="../public_html/saloc/index.html">Inicio</a></li>
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
        <form action="saveProducts.php" method="post" enctype="multipart/form-data">
            <h1>Registre nuevo producto</h1>
            <div class="divForms">

                <?php 
                    if($_GET['type'] == "clothes")
                    { 
                        ?>
                        <style>
                            #showC{
                                display: block;
                            }
                        </style>
                        <?php
                    }
                    elseif($_GET['type'] == "shoes")
                    {
                        ?>
                        <style>
                            #showS{
                                display: block;
                            }
                            .divForms{
                                margin-left: 3vw;
                            }
                        </style>
                        <?php
                    }
                ?>

                <label for="name">Nombre: </label>
                <input type="text" name="name" id="name" required>
    
                <label for="price">Precio: </label>
                <input type="number" name="price" id="price" required>

                <label for="description">Descripción: </label>
                <textarea rows="5" name="description" id="description" required></textarea>

                <label for="amount">En existencia: </label>
                <input type="number" name="amount" id="amount" required>

                <label id="showC">Tallas disponibles: </label>
                <div id="showC" class="sizeDiv">
                    <label for="XS">XS</label>
                    <input type="checkbox" name="sizeC[]" id="XS" value="XS">

                    <label for="S">S</label>
                    <input type="checkbox" name="sizeC[]" id="S" value="S">

                    <label for="M">M</label>
                    <input type="checkbox" name="sizeC[]" id="M" value="M">

                    <label for="L">L</label>
                    <input type="checkbox" name="sizeC[]" id="L" value="L">

                    <label for="XL">XL</label>
                    <input type="checkbox" name="sizeC[]" id="XL" value="XL">
                </div>

                <label id="showS">Tallas disponibles: </label>
                <div id="showS" class="sizesDiv">
                    <label for="22">22 cm</label>
                    <input type="checkbox" name="sizeS[]" id="22" value="22">

                    <label for="22.5">22.5 cm</label>
                    <input type="checkbox" name="sizeS[]" id="22.5" value="22.5">

                    <label for="23">23 cm</label>
                    <input type="checkbox" name="sizeS[]" id="23" value="23">

                    <label for="23.5">23.5 cm</label>
                    <input type="checkbox" name="sizeS[]" id="23.5" value="23.5">

                    <label for="24">24 cm</label>
                    <input type="checkbox" name="sizeS[]" id="24" value="24">

                    <label for="24.5">24.5 cm</label>
                    <input type="checkbox" name="sizeS[]" id="24.5" value="24.5">

                    <label for="25">25 cm</label>
                    <input type="checkbox" name="sizeS[]" id="25" value="25">

                    <label for="25.5">25.5 cm</label>
                    <input type="checkbox" name="sizeS[]" id="25.5" value="25.5">

                    <label for="26">26 cm</label>
                    <input type="checkbox" name="sizeS[]" id="26" value="26">
                </div>

                <label for="picture">Imagen: </label>
                <input type="file" name="picture" id="picture" accept="image/*" required>
            </div>
            <div>
                <button type="submit" name="btnSubmit">Ingresar</button>
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
    <script src="alerts.js"></script>
</body>
</html>