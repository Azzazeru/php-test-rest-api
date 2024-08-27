<?php

require_once '../database/connection/connection.php';
require_once 'auth.class.php';
require_once 'responses.class.php';

class tasks extends connection
{
    private $table = 'tasks';
    private $task_id = '';
    private $title = '';
    private $description = '';
    private $optional = '';
    private $image = '';
    private $token = '';

    public function getAllTasks()
    {
        $query = "SELECT * FROM tasks";
        return parent::getData($query);
    }

    public function getTaskById($task_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE task_id = '$task_id'";
        return parent::getData($query);
    }

    public function createTask($reqbody)
    {
        $_responses = new responses;
        $_auth = new auth;
        $data = json_decode($reqbody, true);

        if (!isset($data['token'])) {
            return $_responses->error_401();
        } else {
            $this->token = $data['token'];
            $tokenData = $_auth->validateSession($this->token);
            if ($tokenData) {
                if (!isset($data['title']) || !isset($data['description'])) {
                    header('Content-Type: application/json');
                    http_response_code(400);
                    return $_responses->error_400();
                } else {
                    $this->title = $data['title'];
                    $this->description = $data['description'];
                    if (isset($data['optional'])) $this->optional = $data['optional'];

                    if (isset($data['image'])) {
                        $res = $this->imageToBase64($data['image']);
                        $this->image = $res;
                    }
                }
                $query = "INSERT INTO " . $this->table . " (title, description, optional, image, user_id) VALUES ('$this->title', '$this->description', '$this->optional', '$this->image', 1)";
                $res = parent::nonQueryId($query);
                if ($res) {
                    $response = $_responses->response;
                    $response["result"] = array(
                        "task_id" => $res
                    );
                    return $response;
                } else {
                    return $_responses->error_500("Internal error");
                }
            } else {
                return $_responses->error_401('Invalid session');
            }
        }
    }

    public function updateTask($reqbody)
    {
        $_responses = new responses;
        $_auth = new auth;
        $data = json_decode($reqbody, true);
        if (!isset($data['token'])) {
            return $_responses->error_401();
        } else {
            $this->token = $data['token'];
            $tokenData = $_auth->validateSession($this->token);
            if ($tokenData) {
                if (!isset($data['task_id'])) {
                    return $_responses->error_400();
                } else {
                    $this->task_id = $data['task_id'];
                    if (isset($data['title'])) $this->title = $data['title'];
                    if (isset($data['description'])) $this->description = $data['description'];
                    if (isset($data['optional'])) $this->optional = $data['optional'];
                    $query = "UPDATE $this->table SET title = '$this->title', description = '$this->description', optional = '$this->optional' WHERE task_id = '$this->task_id'";
                    $res = parent::nonQueryId($query);
                    if ($res) {
                        $response = $_responses->response;
                        $response['result'] = array(
                            'task_id' => $this->task_id
                        );
                        return $response;
                    } else {
                        return $_responses->error_500();
                    }
                }
            } else {
                return $_responses->error_401();
            }
        }
    }

    public function deleteTask($reqbody)
    {
        $_responses = new responses;
        $_auth = new auth;
        $data = json_decode($reqbody, true);
        if (!isset($data['token'])) {
            return $_responses->error_401();
        } else {
            $this->token = $data['token'];
            $tokenData = $_auth->validateSession($this->token);
            if ($tokenData) {
                if (!isset($data['task_id'])) {
                    return $_responses->error_400();
                } else {
                    $this->task_id = $data['task_id'];
                    $query = "DELETE FROM $this->table WHERE task_id = '$this->task_id'";
                    $res = parent::nonQuery($query);
                    if ($res) {
                        $response = $_responses->response;
                        $response['result'] = array(
                            'task_id' => $this->task_id
                        );
                        return $response;
                    } else {
                        return $_responses->error_500();
                    }
                }
            } else {
                return $_responses->error_401();
            }
        }
    }

    private function imageToBase64($img)
    {
        $dir = dirname(__DIR__) . '\public\images\\';
        $parts = explode(";base64,", $img);
        $ext = explode('/', mime_content_type($img))[1];
        $imgb64 = base64_decode($parts[1]);
        $file = $dir . uniqid() . '.' . $ext;
        $newfile = str_replace('\\', '/', $file);
        file_put_contents($newfile, $imgb64);
        return $newfile;
    }
}
