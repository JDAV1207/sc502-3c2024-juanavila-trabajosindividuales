<?php
session_start();
require_once 'conexion.php';
require_once 'comentarios.php';
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
            $comentarios = obtenerComentarios($task_id);
            echo json_encode($comentarios ? $comentarios : []);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Falta el ID de la tarea"]);
        }
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['task_id'], $input['comment'])) {
            if (agregarComentario($input['task_id'], $input['comment'])) {
                http_response_code(201);
                echo json_encode(["message" => "Comentario agregado exitosamente"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al agregar el comentario"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Datos insuficientes"]);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        if (isset($_PUT['comment_id'], $_PUT['new_comment'])) {
            if (actualizarComentario($_PUT['comment_id'], $_PUT['new_comment'])) {
                http_response_code(200);
                echo json_encode(["message" => "Comentario actualizado exitosamente"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al actualizar el comentario"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Datos insuficientes"]);
        }
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);
        if (isset($_DELETE['comment_id'])) {
            if (eliminarComentario($_DELETE['comment_id'])) {
                http_response_code(200);
                echo json_encode(["message" => "Comentario eliminado exitosamente"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al eliminar el comentario"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Datos insuficientes"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
