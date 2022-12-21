<?php
include_once "conexionBD.php";
$fileName = "./fichero.xml";
$manejo_fich = fopen($fileName, 'a'); //TODO: cambiar a append+ para leer y mostrar el contenido
//modo a -- APPEND añadir al fichero xml

try {
    $conexion = conexionBD::getConexion();
    $sql = "SELECT * FROM discos ORDER BY 1";
    $test = $conexion->query($sql);

    if ($test->rowCount() > 0) {
        if (file_exists($fileName) && file_get_contents($fileName) != "") {
        header('Location: ./confirmacion.php');
        die();
        }
        if (isset($_GET['confirm'])) {
            if ($_GET['confirm'] == true) { //Si venimos de aceptar la confirmacion.php, borramos el fichero
                unlink($fileName);
                header('Location: ./index.php');
            }
        }

        if (file_get_contents($fileName) == "") {
            fwrite($manejo_fich, "<?xml version='1.0' encoding='UTF-8'?>" . "\n");
            $root1 = "<bbddDiscos>\n";
            fwrite($manejo_fich, $root1);
            while ($res = $test->fetch(PDO::FETCH_ASSOC)) {
                $linea1 = "\t<disco>\n";
                fwrite($manejo_fich, $linea1);
                foreach ($res as $c => $valor) {
                    $linea = "\t\t<" . $c . ">" . $valor . "</" . $c . "> \n";
                    fwrite($manejo_fich, $linea);
                }
                $linea2 = "\t</disco>\n";
                fwrite($manejo_fich, $linea2);
            }
            $root2 = "</bbddDiscos>\n";
            fwrite($manejo_fich, $root2);
        }


        if (fclose($manejo_fich)) {
            print "CREADO CORRECTAMENTE!";

            //TODO: mostrar contenido
        } else {
            print "ERROR";
        }
    }
} catch (PDOException $pdoe) {
    echo $pdoe->getMessage();
}


