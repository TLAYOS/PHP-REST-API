<?php

// Headers
header("Acces-Control-Allow-Origin: ");
header("Content-Type: aplication/json");

// Initialize the API
include_once("../core/initialize.php");

// Instantiate post
$post = new Post($db);

// Get Raw posted Data
$data = json_decode(file_get_contents("php://input"));

$post->id = isset($data->id) ? $data->id  : die();

$post->read_single();

$post_arr = array(
    "id"=> $post->id,
    "title"=> $post->title,
    "body"=> $post->body,
    "author"=> $post->author,
    "category_id"=> $post->category_id,
    "category_name"=> $post->category_name,
);

// Create a JSON

print_r(json_encode($post_arr));

?>