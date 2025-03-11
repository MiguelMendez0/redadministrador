<?php

if (isset($_SESSION['user_id'])) {
    
  $stmt = $pdo->prepare('SELECT AsesorId, AsesorUsuario, AsesorAdmin, AsesorNombre, AsesorApellidoPaterno, AsesorApellidoMaterno FROM asesores WHERE AsesorId = :id');
  $stmt->bindParam(':id', $_SESSION['user_id']);
  $stmt->execute();
  $results = $stmt->fetch(PDO::FETCH_ASSOC);

  $sesion = null;

  if (count($results) > 0) {
    $sesion = $results;
  }
  //var_dump($results);
}

?>