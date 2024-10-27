<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['txtID']); 
    if ($id > 0) {
        try {
            require_once('../conexion.php');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $SQL = 'DELETE FROM productos WHERE id_productos = :id';
            $stmt = $conexion->prepare($SQL);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 

            if ($stmt->execute()) {
                
                header('Location: consultar.php?status=success');
                exit(); 
            } else {
                header('Location: consultar.php?status=error');
                exit();
            }

            $stmt = null; 
            $conexion = null; 
        } catch (PDOException $e) {
            header('Location: consultar.php?status=error');
            exit();
        }
    } else {
        header('Location: consultar.php?status=invalid');
        exit();
    }
}