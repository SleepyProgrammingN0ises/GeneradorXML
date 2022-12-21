<html>
<head>
    <title>ATENCIÓN!</title>
</head>
<body>
    <form action="" method="post">
        <p>El fichero ya existe, ¿desea sobreescribirlo?</p>
        <button name="si" value="true">Si</button>
        <button name="canc" value="true">NO / CANCELAR</button>
    </form>
</body>
</html>

<?php
    if (isset($_REQUEST['si'])) {
        header('Location: ./creadorXML.php?confirm="true"');
    } elseif (isset($_REQUEST['canc'])) {
        echo "Operación cancelada.";
    }
?>