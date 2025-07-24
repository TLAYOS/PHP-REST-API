<?php

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: aplication/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
header('Content-Type: application/json');


// Initialize the API
include_once("../core/initialize.php");

// Instantiate post
$post = new Post($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->id)   
) {
    $post->id = $data->id;

    if ($post->delete()) {
        echo json_encode(["msg" => "Post deleted."]);
    } else {
        echo json_encode(["msg" => "Failed to delete post."]);
    }
} else {
    echo json_encode(["msg" => "Missing required fields."]);
}

?>