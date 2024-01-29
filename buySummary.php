<?php
    require_once "Connection.php";
    session_start();
    global $subTotal, $total;
    if(!isset($_SESSION['user'])){
        header("Location: login.html");
    }
    else{
        if(isset($_POST['btnSubmit']))
        {   
            $user = $_SESSION['user'];
            $subTotal = $_POST['subtotal'];
            $total = $_POST['total'];

            $sql = mysqli_query($connection, "SELECT * FROM `users` WHERE email='$user'");
            $data = mysqli_fetch_assoc($sql);
        
            $sqlProduct = mysqli_query($connection, "SELECT * FROM sales WHERE costumerUser='$user'");
            ob_start();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Dosis', sans-serif;
        }

        header, footer{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 3.5em;
            background-color: #694B34;
        }

        header img{
            margin: 0.5em;
            height: 60%;
            width: 8em;
        }

        main{
            margin-top: 1em;
            margin-left: 5em;
            margin-right: 5em;
        }

        section p{
            text-align: justify;
            font-size: 1.3em;
        }

        section h1{
            text-align: center;
            margin-top: 1em;
            color: #694B34;
        }

        section h2{
            text-align: left;
            color: #004346;
            margin-top: 1em;
        }

        section ul{
            list-style: none;
            margin-top: 0.5em;
            margin-left: 0.5em;
        }

        section span{
            font-weight: bold;
        }

        table{
            border-collapse: collapse;
            margin: 0.5em 0 1em 0.5em;
        }

        th{
            background-color: #004346;
            color: white;
            padding: 0.4em 1.5em 0.4em 1.5em;
            border-right: 0.15em solid #694B34;
        }

        td{
            padding: 0.3em 1.5em 0.3em 0.5em;
            background-color: #d3d3d3;
            border-right: 0.15em solid #694B34;
        }

        #blnk1{
            border: none;
            background-color: white;
        }

        #blnk2{
            background-color: white;
        }

        #brd{
            border: none;
        }
    </style>
</head>
<body>
    <header>
        <!--<img src="localhost/GlobalWeb/Images/logoSaloc2.png" alt="Saloc">!-->
    </header>
    <main>
        <section>
            <p>Agradecemos sinceramente su compra y confianza en nuestros productos. 
                Estamos encantados de que haya elegido nuestro producto y esperamos que satisfaga todas sus necesidades. 
                Siempre nos esforzamos por ofrecer la mejor calidad y servicio, y su apoyo nos motiva a seguir mejorando. 
                ¡Gracias de nuevo por ser parte de nuestra comunidad de clientes!</p>
        </section>
        <section>
            <h1>Resumen de compra</h1>
            <h2>Datos personales</h2>
            <ul>
                <li><span>Nombre:</span> <?php echo $data['name'];?>&nbsp;<?php echo $data['lastname'];?></li>
                <li><span>Correo:</span> <?php echo $data['email']; ?></li>
                <li><span>Teléfono:</span> <?php echo $data['phone']; ?></li>
                <li><span>Estado:</span> <?php echo $data['state']; ?></li>
                <li><span>Calle:</span> <?php echo $data['addressStreet']; ?></li>
                <li><span>Ciudad:</span> <?php echo $data['city']; ?></li>
            </ul>
        </section>
        <section>
            <h2>Productos comprados</h2>
            <table>
                <tr>
                    <th>Nombre producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th id="brd">Subtotal</th>

                </tr>
                <?php
                    while ($dataP = mysqli_fetch_assoc($sqlProduct)) { ?>
                        <tr>
                            <td><?php echo $dataP['productName']; ?></td>
                            <td><?php echo $dataP['price']; ?> <span>MXN</span></td>
                            <td><?php echo $dataP['amount']; ?></td>
                            <td id="brd"><?php echo $dataP['amount']*$dataP['price']; ?> <span>MXN</span></td>
                        </tr>
                    <?php
                    }?>
                <tr>
                    <td id="blnk1"></td>
                    <td id="blnk2"></td>
                    <td>Total: </td>
                    <td id="brd"><?php echo $total; ?> <span>MXN</span></td>
                </tr>
            </table>
        </section>
    </main>
    <footer></footer>
</body>
</html>

<?php
    $html = ob_get_clean();

    require_once 'Library/dompdf/autoload.inc.php';
    include 'emailSender.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnable' => true));

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $pdfOutput = $dompdf->output();
    $pdfFile = 'ComprobanteSaloc.pdf';
    file_put_contents($pdfFile, $pdfOutput);
    //$dompdf->stream("ComprobanteSaloc.pdf", array("Attachment" => false));

    sendEmail($pdfFile);
    mysqli_close($connection);
?>