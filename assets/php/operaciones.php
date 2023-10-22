<?php
    chdir("assets");
    if(!file_exists("archivos")){
        mkdir("archivos");
    } chdir("archivos");
    $d = getcwd();
    chmod($d, 0777);
    $arr = array_diff(scandir($d), array('..', '.'));
    $archivos = array();
    foreach($arr as $c){
        if(is_dir($c)){
            $cc = array_diff(scandir($d."/".$c), array('..', '.'));
            foreach($cc as $c){
                $archivos[] = $c;
            }
        } else{
            $archivos[] = $c;
        }
    }

    if(isset($_POST['CA']) && $_POST['CA'] == 'Crear archivo'){
        $archivo = $_POST['txtArchivo'];
        $archivo = str_replace(" ", "_", $archivo);
        if(!file_exists($archivo.".txt")){
            $fp = fopen($archivo.".txt", "w");
            fclose($fp);
        }
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['CC']) && $_POST['CC'] == 'Crear carpeta'){
        $carpeta = $_POST['txtCarpeta'];
        $carpeta = str_replace(" ", "_", $carpeta);
        if(!file_exists($d."/".$carpeta)){
            mkdir($carpeta);
        }
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['BA']) && $_POST['BA'] == 'Borrar archivo'){
        $archivo = $_POST['selectArchivoBorrar'];
        $archivo = str_replace(" ", "_", $archivo).".txt";
        
        if(!unlink($d."/".$archivo)){
            $arr = array_diff(scandir($d), array('..', '.'));
            foreach($arr as $c){
                if(is_dir($c)){
                    unlink($d."/".$c."/".$archivo);
                }
            }
        }
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['BC']) && $_POST['BC'] == 'Borrar carpeta'){
        $carpeta = $_POST['selectCarpetaBorrar'];
        $carpeta = str_replace(" ", "_", $carpeta);
        $cd = array_diff(scandir($carpeta), array('..', '.'));
        foreach($cd as $c){
            unlink($d."/".$carpeta."/".$c);
        }
        rmdir($carpeta);
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['MA']) && $_POST['MA'] == 'Mover archivo'){
        $archivo = $_POST['selectArchivo'];
        $carpeta = $_POST['selectCarpeta'];
        $archivo = str_replace(" ", "_", $archivo).".txt";
        $carpeta = str_replace(" ", "_", $carpeta);
        if($carpeta == "archivos"){
            foreach($arr as $c){
                if(is_dir($c)){
                    rename($c."/".$archivo, $archivo);
                    // echo 'copiado';
                    // unlink($c."/".$archivo);
                }
            }
        } else{
            foreach($arr as $c){
                if(is_dir($c)){
                    if(copy($c."/".$archivo, $carpeta."/".$archivo)){
                        // echo 'copiado';
                        unlink($c."/".$archivo);
                    }
                    // rename($c."/".$archivo, $carpeta."/".$archivo);
                    // unlink($c."/".$archivo);
                } else{
                    if(copy($archivo, $carpeta."/".$archivo)){
                        // echo 'copiado';
                        unlink($archivo);
                    }
                    // rename($archivo, $carpeta."/".$archivo);
                    // unlink($archivo);
                }
            }
        }
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    if(isset($_POST['GA'])){
        foreach($archivos as $a){
            if($_POST['GA'] == substr($a, 0, strrpos($a, '.'))){
                foreach($arr as $c){
                    if(is_dir($c)){
                        chdir($c);
                        if(!empty(realpath($a))){
                            $contenido = $_POST[substr($a, 0, strrpos($a, '.'))];
                            $fp = fopen($a, "w");
                            fwrite($fp, $contenido);
                            fclose($fp);
                            chdir("../");
                            return;
                        }
                        chdir("../");
                    } 
                }
                $contenido = $_POST[substr($a, 0, strrpos($a, '.'))];
                $fp = fopen($a, "w");
                fwrite($fp, $contenido);
                fclose($fp);
            }
        }
        // header("Location: ".$_SERVER['REQUEST_URI']);
        // exit();
    }
?>