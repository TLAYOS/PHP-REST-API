<?php

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: aplication/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
header('Content-Type: application/json');


// Initialize the API
include_once("../core/initialize.php");

// Instantiate post
$post = new Post($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->title) &&
    isset($data->body) &&
    isset($data->author) &&
    isset($data->category_id)
) {
    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    if ($post->create()) {
        echo json_encode(["msg" => "Post created."]);
    } else {
        echo json_encode(["msg" => "Failed to create post."]);
    }
} else {
    echo json_encode(["msg" => "Missing required fields."]);
}

?>