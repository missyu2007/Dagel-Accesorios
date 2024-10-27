<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['txtID']); 
    if ($id > 0) {
        try {
            require_once('../conexion.php');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $SQL = 'DELETE FROM pedidos WHERE id_pedidos = :id';
            $stmt = $conexion->prepare($SQL);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); 

            if ($stmt->execute()) {
                
                header('Location: consul_ped.php?status=success');
                exit(); 
            } else {
                header('Location: consul_ped.php?status=error');
                exit();
            }

            $stmt = null; 
            $conexion = null; 
        } catch (PDOException $e) {
            header('Location: consul_ped.php?status=error');
            exit();
        }
    } else {
        header('Location: consul_ped.php?status=invalid');
        exit();
    }
}