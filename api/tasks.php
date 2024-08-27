<?php

require_once '../classes/responses.class.php';
require_once '../classes/tasks.class.php';

$_responses = new responses;
$_tasks = new tasks;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['task_id'])) {
        $task_id = $_GET['task_id'];
        $taskData = $_tasks->getTaskById($task_id);
        if (empty($taskData)) {
            echo json_encode($_responses->error_404());
            http_response_code(404);
            return;
        }
        echo json_encode($taskData);
        http_response_code(200);
    } else {
        // header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($_tasks->getAllTasks());
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $headers = getallheaders();
    if (isset($headers['token'])) {
        $send = [
            'token' => $headers['token']
        ];
        $body = json_encode($send);
    } else {
        $reqbody = file_get_contents('php://input');
    }

    $response = $_tasks->createTask($reqbody);
    header('Content-Type: application/json');
    if (isset($response['result']['error_id'])) {
        $responseCode = $response['result']['error_id'];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($response);
} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    $reqbody = file_get_contents('php://input');
    $data = $_tasks->updateTask($reqbody);
    header('Content-Type: application/json');
    if (isset($data['result']['error_id'])) {
        $responseCode = $data['result']['error_id'];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo json_encode($data);
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $task_id = $_GET['task_id'];
    $headers = getallheaders();

    if (!$task_id) {
        echo json_encode($_responses->error_400("Need a task_id parameter"));
        http_response_code(400);
        return;
    }

    if (isset($headers['token'])) {
        $data = [
            'token' => $headers['token'],
            'task_id' => $task_id,
        ];
    } else {
        echo json_encode($_responses->error_401());
        http_response_code(401);
        return;
    }

    $body = json_encode($data);

    $data = $_tasks->deleteTask($body);
    if (isset($data['result']['error_id'])) {
        $responseCode = $data['result']['error_id'];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
} else {
    header('Content-Type: application/json');
    $data = $_responses->error_405();
    http_response_code(405);
    echo json_encode($data);
}
