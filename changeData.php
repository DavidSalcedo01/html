<?php
    require_once "Connection.php";
    global $type, $productName, $price, $ProductAmount, $sizes, $date, $description, $sql;

    
    //*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
    if(isset($_POST['btnSubmit'])){
        $prName = $_POST['name'];
        $prPrice = $_POST['price'];
        $type = $_POST['type'];

        if($type == "clothes"){
            $sql = mysqli_query($connection, "SELECT * FROM clothes WHERE productName='$prName' AND price='$prPrice'");
            while ($data = mysqli_fetch_assoc($sql)) {
                $productName = $data['productName'];
                $price = $data['price'];
                $ProductAmount = $data['ProductAmount'];
                $sizes = $data['sizes'];
                $date = $data['date'];
                $description = $data['description'];
            }
        }
        elseif($type == "shoes"){
            $sql = mysqli_query($connection, "SELECT * FROM shoes WHERE productName='$prName' AND price='$prPrice'");
            while ($data = mysqli_fetch_assoc($sql)) {
                $productName = $data['productName'];
                $price = $data['price'];
                $ProductAmount = $data['ProductAmount'];
                $sizes = $data['sizes'];
                $date = $data['date'];
                $description = $data['description'];
            }
        }
        elseif($type == "jewelry"){
            $sql = mysqli_query($connection, "SELECT * FROM jewelry WHERE productName='$prName' AND price='$prPrice'");
            while ($data = mysqli_fetch_assoc($sql)) {
                $productName = $data['productName'];
                $price = $data['price'];
                $ProductAmount = $data['ProductAmount'];
                $date = $data['date'];
                $description = $data['description'];
            }
        }
        
        $res = mysqli_num_rows($sql);

        if($res != 1)
        {
            echo '<h1 style="color: red; font-weight: bold; text-align: center;">El producto seleccionado no fue encontrado</h1>';
        }
        else{
            //header("Location: changeData.php");
        }
    }
    //*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*

    if(isset($_POST['btnChange'])){
        
        date_default_timezone_set('America/Mexico_city');
        $NewName = $_POST['name'];
        $NewPrice = $_POST['price'];
        $NewDescription = $_POST['description'];
        $NewAmount = $_POST['amount'];
        $NewDate = date("Y-m-d H:i:s");
        $oldName = $_POST['oldName'];
        global $sizesC, $sizeS, $flagC, $flagS, $imageNewName;

        if(isset($_POST['sizeC']))
        {
             foreach($_POST['sizeC'] as $value)
             {
                $sizesC = $sizesC.' '.$value;
             }
             $flagC = 1;
        }
        
        if(isset($_POST['sizeS']))
        {
             foreach($_POST['sizeS'] as $value)
             {
                $sizeS = $sizeS.' '.$value;
             }
             $flagS = 1;
        }

        $image = $_FILES['picture'];
        $imageName = $_FILES['picture']['name'];
        $imageTmpName = $_FILES['picture']['tmp_name'];
        $imageSize = $_FILES['picture']['size'];
        $imageError = $_FILES['picture']['error'];
        $imageType = $_FILES['picture']['type'];

        $imageExt = explode('.', $imageName);
        $imageActualExt = strtolower(end($imageExt));
        $allowedExt = array('jpg','jpeg','png');
        
        if(in_array($imageActualExt, $allowedExt)){
            if($imageError === 0){
                if($imageSize < 1000000){
                    $imageNewName = uniqid('', true).".".$imageActualExt;
                    if($flagC == 1){
                        $imageDest = 'Images/Clothes/'.$imageNewName;
                        move_uploaded_file($imageTmpName, $imageDest);
                        echo '<h1 style="color: green; font-weight: bold; text-align: center;">imagen subida en ropa</h1>';
                    }
                    elseif($flagS == 1){
                        $imageDest = 'Images/Shoes/'.$imageNewName;
                        move_uploaded_file($imageTmpName, $imageDest);
                        echo '<h1 style="color: green; font-weight: bold; text-align: center;">imagen subida en zapatos</h1>';
                    }
                    else{
                        $imageDest = 'Images/Jewelry/'.$imageNewName;
                        move_uploaded_file($imageTmpName, $imageDest);
                        echo '<h1 style="color: green; font-weight: bold; text-align: center;">imagen subida en joyería</h1>';
                    }
                }
                else{
                    echo '<h1 style="color: red; font-weight: bold; text-align: center;">El archivo es demasiado pesado</h1>';
                }
            }
            else{
                echo '<h1 style="color: red; font-weight: bold; text-align: center;">Ocurrió un error al subir el archivo</h1>';
            }
        }
        else{
            echo '<h1 style="color: red; font-weight: bold; text-align: center;">No se puede subir un archivo de este tipo</h1>';
        }

        
        if($flagC == 1)
        {
            $sqlInsert = mysqli_query($connection, "UPDATE clothes SET productName='$NewName', price='$NewPrice', ProductAmount='$NewAmount', sizes='$sizesC', date='$NewDate', description='$NewDescription', image='$imageNewName' WHERE productName='$oldName'");
            header("Location: adminDashBoard.html");
        }
        elseif($flagS == 1)
        {
            echo "Entro al UPDATE de shoes";
            $sqlInsert = mysqli_query($connection, "UPDATE shoes SET productName='$NewName', price='$NewPrice', ProductAmount='$NewAmount', sizes='$sizeS', date='$NewDate', description='$NewDescription', image='$imageNewName' WHERE productName='$oldName'");
            header("Location: adminDashBoard.html");
        }
        else
        {
            echo "Entro al UPDATE de jewelry";
            $sqlInsert = mysqli_query($connection, "UPDATE jewelry SET productName='$NewName', price='$NewPrice', ProductAmount ='$NewAmount', date ='$NewDate', description ='$NewDescription', image ='$imageNewName' WHERE  productName ='$oldName'");
            /*$sql2 = mysqli_query($connection, "CREATE TRIGGER bitacora_productoUPDATE
                AFTER UPDATE ON jewelry
                FOR EACH ROW
                BEGIN
                INSERT INTO bitacora_productos (Fecha, Sentencia, Contrasentencia)
                VALUES (NOW(), 
                        CONCAT('UPDATE jewelry SET productName = \'',NEW.productName, '\',price = ',NEW.price,'\',description=\'',NEW.description,'\';'),
                        CONCAT('DELETE FROM jewelry WHERE productName = ', NEW.productName)
                );
                    IF ROW_COUNT() = 0 THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_productoUPDATE';
                    END IF;
                END;
                ");*/
            //header("Location: adminDashBoard.html");
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/addProduct.css">
    <link rel="shortcut icon" href="Images/logoIcon.png" />
    <title>Modificar - Saloc</title>
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
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Modifique un producto</h1>
            <div class="divForms">

                <?php 
                    if($type == "clothes")
                    { 
                        ?>
                        <style>
                            #showC{
                                display: block;
                            }
                        </style>
                        <?php
                    }
                    elseif($type == "shoes")
                    {
                        ?>
                        <style>
                            #showS{
                                display: block;
                            }
                        </style>
                        <?php
                    }
                ?>
                <label for="name">Nombre: </label>
                <input type="text" name="name" id="name" value="<?php echo $productName; ?>" required>
    
                <label for="price">Precio: </label>
                <input type="number" name="price" id="price" value="<?php echo $price;?>" required>

                    <label for="description">Descripción: </label>
                    <textarea rows="5" name="description" id="description"><?php echo $description;?></textarea>

                    <label for="amount">En existencia: </label>
                    <input type="number" name="amount" id="amount" value="<?php echo $ProductAmount;?>">

                    <label id="showC">Tallas disponibles: </label>
                    <div id="showC" class="sizeDiv">
                        <label for="XS">XS</label>
                        <input type="checkbox" name="sizeC[]" id="XS" value="XS" <?php if(str_contains($sizes, 'XS')){echo "checked";} ?>>

                        <label for="S">S</label>
                        <input type="checkbox" name="sizeC[]" id="S" value="S" <?php if(str_contains($sizes, 'S')){echo "checked";} ?>>

                        <label for="M">M</label>
                        <input type="checkbox" name="sizeC[]" id="M" value="M" <?php if(str_contains($sizes, 'M')){echo "checked";} ?>>

                        <label for="L">L</label>
                        <input type="checkbox" name="sizeC[]" id="L" value="L" <?php if(str_contains($sizes, 'L')){echo "checked";} ?>>

                        <label for="XL">XL</label>
                        <input type="checkbox" name="sizeC[]" id="XL" value="XL" <?php if(str_contains($sizes, 'XL')){echo "checked";} ?>>
                    </div>

                    <label id="showS">Tallas disponibles: </label>
                    <div id="showS" class="sizesDiv" style="padding-left: 2vw;">
                        <label for="22">22 cm</label>
                        <input type="checkbox" name="sizeS[]" id="22" value="22" <?php if(str_contains($sizes, '22')){echo "checked";} ?>>

                        <label for="22.5">22.5 cm</label>
                        <input type="checkbox" name="sizeS[]" id="22.5" value="22.5" <?php if(str_contains($sizes, '22.5')){echo "checked";} ?>>

                        <label for="23">23 cm</label>
                        <input type="checkbox" name="sizeS[]" id="23" value="23" <?php if(str_contains($sizes, '23')){echo "checked";} ?>>

                        <label for="23.5">23.5 cm</label>
                        <input type="checkbox" name="sizeS[]" id="23.5" value="23.5" <?php if(str_contains($sizes, '23.5')){echo "checked";} ?>>

                        <label for="24">24 cm</label>
                        <input type="checkbox" name="sizeS[]" id="24" value="24" <?php if(str_contains($sizes, '24')){echo "checked";} ?>>

                        <label for="24.5">24.5 cm</label>
                        <input type="checkbox" name="sizeS[]" id="24.5" value="24.5" <?php if(str_contains($sizes, '24.5')){echo "checked";} ?>>

                        <label for="25">25 cm</label>
                        <input type="checkbox" name="sizeS[]" id="25" value="25" <?php if(str_contains($sizes, '25')){echo "checked";} ?>>

                        <label for="25.5">25.5 cm</label>
                        <input type="checkbox" name="sizeS[]" id="25.5" value="25.5" <?php if(str_contains($sizes, '25.5')){echo "checked";} ?>>

                        <label for="26">26 cm</label>
                        <input type="checkbox" name="sizeS[]" id="26" value="26" <?php if(str_contains($sizes, '26')){echo "checked";} ?>>
                    </div>

                    <label for="picture">Imagen: </label>
                    <input type="file" name="picture" id="picture" accept="image/*" >
                    <input type="text" name="oldName" id="oldName" value="<?php echo $productName; ?>" style="display: none;">
            </div>
            <div>
                <button type="submit" name="btnChange">Modificar</button>
            </div>
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
                la creación del frontEnd y BackEnd sin la ayuda de ninguno framework o librería que facilite ninguno de estos ámbitos. 
                Para el aparatado de frontEnd se utilizo html y css solamente, para el apartado de backEnd se utilizo php y como base de datos mysql</p>
        </div>
    </footer>
</body>
</html>