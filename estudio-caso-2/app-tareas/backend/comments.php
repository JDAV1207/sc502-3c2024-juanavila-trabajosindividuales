<?php
require_once 'db.php';

function agregarComentario($task_id, $comment) {
    global $pdo;
    $sql = "INSERT INTO comments (task_id, comment) VALUES (:task_id, :comment)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->bindParam(':comment', $comment);
    $stmt->execute();
}

function obtenerComentarios($task_id) {
    global $pdo;
    $sql = "SELECT * FROM comments WHERE task_id = :task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function eliminarComentario($comment_id) {
    global $pdo;
    $sql = "DELETE FROM comments WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $comment_id);
    $stmt->execute();
}

session_start();
require_once 'message_log.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Acceso no autorizado"]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
    if (isset($_GET['task_id'])) {
        $task_id = $_GET['task_id'];
        $comments = obtenerComentarios($task_id);
        echo json_encode($comments ? $comments : []);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Falta el ID de la tarea"]);
    }
    break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['task_id'], $input['comment'])) {
            agregarComentario($input['task_id'], $input['comment']);
            echo json_encode(["message" => "Comentario agregado"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Faltan datos"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['task_id'], $_GET['comment_id'])) {
            eliminarComentario($_GET['comment_id']);
            echo json_encode(["message" => "Comentario eliminado"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Faltan datos"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
?>
