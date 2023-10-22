<?php
    include_once('assets/php/operaciones.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de notas</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-info rounded-5">
        <div class="container-fluid">
            <button type="button" class="btn btn-info btn-lg text-wrap fw-bolder col col-sm-2 col-2" data-bs-toggle="modal" data-bs-target="#crearArchivo">Crear archivo</button>
            <button type="button" class="btn btn-info btn-lg text-wrap fw-bolder col col-sm-2 col-2" data-bs-toggle="modal" data-bs-target="#borrarArchivo">Borrar archivo</button>
            <button type="button" class="btn btn-info btn-lg text-wrap fw-bolder col col-sm-2 col-2" data-bs-toggle="modal" data-bs-target="#moverArchivo">Mover archivo</button>
            <button type="button" class="btn btn-info btn-lg text-wrap fw-bolder col col-sm-2 col-2" data-bs-toggle="modal" data-bs-target="#crearCarpeta">Crear carpeta</button>
            <button type="button" class="btn btn-info btn-lg text-wrap fw-bolder col col-sm-2 col-2" data-bs-toggle="modal" data-bs-target="#borrarCarpeta">Borrar carpeta</button>
        </div>
    </nav>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" data-bs-theme="dark" id="crearArchivo" tabindex="-1" aria-labelledby="crearArchivo" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="crearArchivo">Archivo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" name="txtArchivo" placeholder="Título del archivo" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-success" value="Crear archivo" name="CA">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" data-bs-theme="dark" data-bs-theme="dark" id="borrarArchivo" tabindex="-1" aria-labelledby="borrarArchivoLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="borrarArchivoLabel">Archivo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <?php  
                                    $files = array_diff(scandir($d), array('..', '.'));
                                ?>
                                <select class="form-select" name="selectArchivoBorrar" required>
                                    <option selected hidden disabled>Seleccione el archivo</option>
                                    <?php 
                                        foreach($files as $file){
                                            if(!is_dir($file)){
                                            	$file = str_replace("_", " ", $file);
                                    ?>
                                    <option value="<?php echo substr($file, 0, strrpos($file, '.')); ?>"><?php echo substr($file, 0, strrpos($file, '.')); ?></option>
                                    <?php } else{ 
                                        $ff = array_diff(scandir($file), array('..', '.'));
                                        foreach($ff as $f){
                                        	$f = str_replace("_", " ", $f);
                                    ?>
                                    <option value="<?php echo substr($f, 0, strrpos($f, '.')); ?>"><?php echo substr($f, 0, strrpos($f, '.')); ?></option>
                                    <?php }}} ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-success" value="Borrar archivo" name="BA">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" data-bs-theme="dark" id="moverArchivo" tabindex="-1" aria-labelledby="moverArchivoLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="moverArchivoLabel">Seleccione el archivo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <?php
                                    $files = array_diff(scandir($d), array('..', '.'));
                                ?>
                                <select class="form-select" name="selectArchivo" required>
                                    <option selected hidden disabled>Seleccione el archivo</option>
                                    <?php 
                                        foreach($files as $file){
                                            if(!is_dir($file)){
                                            	$file = str_replace("_", " ", $file);
                                    ?>
                                    <option value="<?php echo substr($file, 0, strrpos($file, '.')); ?>"><?php echo substr($file, 0, strrpos($file, '.')); ?></option>
                                    <?php } else{
                                        $ff = array_diff(scandir($file), array('..', '.'));
                                        foreach($ff as $f){
                                        	$f = str_replace("_", " ", $f);
                                    ?>
                                    <option value="<?php echo substr($f, 0, strrpos($f, '.')); ?>"><?php echo substr($f, 0, strrpos($f, '.')); ?></option>
                                    <?php }}} ?>
                                </select><br>
                                <select class="form-select" name="selectCarpeta" required>
                                    <option selected hidden disabled>Seleccione la carpeta</option>
                                    <option value="archivos">Archivos Principales</option>
                                    <?php
                                        foreach($files as $file){
                                            if(is_dir($file)){
                                            	$file = str_replace("_", " ", $file);
                                    ?>
                                    <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-success" value="Mover archivo" name="MA">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" data-bs-theme="dark" id="crearCarpeta" tabindex="-1" aria-labelledby="crearCarpetaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="crearCarpetaLabel">Carpeta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" name="txtCarpeta" placeholder="Título de la carpeta" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-success" value="Crear carpeta" name="CC">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="modal fade" data-bs-theme="dark" id="borrarCarpeta" tabindex="-1" aria-labelledby="borrarCarpetaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="borrarCarpetaLabel">Carpeta</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group flex-nowrap">
                                <?php  
                                    $files = array_diff(scandir($d), array('..', '.'));
                                ?>
                                <select class="form-select" name="selectCarpetaBorrar" required>
                                    <option selected hidden disabled>Seleccione la carpeta</option>
                                    <?php 
                                        foreach($files as $file){
                                            if(is_dir($file)){
                                            	$file = str_replace("_", " ", $file);
                                    ?>
                                    <option value="<?php echo $file; ?>"><?php echo $file; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-success" value="Borrar carpeta" name="BC">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="my-5">
        <div class="container">
            <div class="row">
            <?php
                $archivos = array_diff(scandir($d), array('..', '.'));
                if(!empty($archivos)){
            ?>
                <div class="card col col-12 col-sm-12">
                <?php 
                    foreach($archivos as $archivo){
                        if(!is_dir($archivo)){
                ?>
                    <div class="card-body">
                        <div class="form-floating">
                            <textarea class="form-control" id="archivo<?php echo substr($archivo, 0, strrpos($archivo, '.')); ?>" name="<?php echo substr($archivo, 0, strrpos($archivo, '.')); ?>" style="height: 100px"><?php $fp = fopen($archivo, "a+"); if(filesize($archivo) > 0){ $contenido = fread($fp, filesize($archivo)); echo $contenido; } ?></textarea>
                            <label for="archivo<?php echo substr($archivo, 0, strrpos($archivo, '.')); ?>"> <?php echo substr(str_replace("_", " ", $archivo), 0, strrpos(str_replace("_", " ", $archivo), '.')); ?> </label>
                        </div><br>
                        <div class="text-center">
                            <button class="btn btn-success" type="submit" name="GA" value="<?php echo substr($archivo, 0, strrpos($archivo, '.')); ?>">Guardar</button>
                        </div>
                    </div>
                <?php } else{
                    $arch = array_diff(scandir($archivo), array('..', '.'));
                    if(!empty($arch)){
                ?>
                    <div class="card col col-10 col-sm-10 offset-1 offset-sm-1 my-5">
                    <h5 class="card-title text-center"> <?php echo str_replace("_", " ", $archivo); ?> </h5>
                    <?php foreach($arch as $a){ ?>
                        <div class="card-body">
                            <div class="form-floating">
                                <textarea class="form-control" id="archivo<?php echo substr($a, 0, strrpos($a, '.')); ?>" name="<?php echo substr($a, 0, strrpos($a, '.')); ?>" style="height: 100px"><?php $fp = fopen($a, "a+"); if(filesize($a) > 0){ $contenido = fread($fp, filesize($a)); echo $contenido; } ?></textarea>
                                <label for="archivo<?php echo substr($a, 0, strrpos($a, '.')); ?>"> <?php echo substr(str_replace("_", " ", $a), 0, strrpos(str_replace("_", " ", $a), '.')); ?> </label>
                            </div><br>
                            <div class="text-center">
                                <button class="btn btn-success" type="submit" name="GA" value="<?php echo substr($a, 0, strrpos($a, '.')); ?>">Guardar</button>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                <?php } else{ ?>
                    <div class="card col col-12 col-sm-12">
                        <h5 class="card-title text-center"><?php echo str_replace("_", " ", $archivo); ?> (Carpeta vacía)</h5>
                    </div>
                <?php } ?>
                </div>
            <?php }}} ?>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
</body>
</html>