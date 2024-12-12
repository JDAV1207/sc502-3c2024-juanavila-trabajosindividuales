<?php
require_once 'conexion.php';

function agregarComentario($task_id, $comment) {
    global $pdo;
    $sql = "INSERT INTO comments (task_id, comment) VALUES (:task_id, :comment)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->bindParam(':comment', $comment);
    $stmt->execute();
    echo "Comentario agregado con éxito.";
}

function obtenerComentarios($task_id) {
    global $pdo;
    $sql = "SELECT * FROM comments WHERE task_id = :task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($comments);
}

function actualizarComentario($comment_id, $new_comment) {
    global $pdo;
    $sql = "UPDATE comments SET comment = :comment WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $comment_id);
    $stmt->bindParam(':comment', $new_comment);
    $stmt->execute();
    echo "Comentario actualizado con éxito.";
}

function eliminarComentario($comment_id) {
    global $pdo;
    $sql = "DELETE FROM comments WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $comment_id);
    $stmt->execute();
    echo "Comentario eliminado con éxito.";
}
