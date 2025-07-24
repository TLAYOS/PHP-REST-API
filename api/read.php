<?php

// Headers
header("Access-Control-Allow-Origin: ");
header("Content-Type: application/json");

// Initialize the API
include_once("../core/initialize.php");

// Instantiate post
$post = new Post($db);

// Blog post query
$result = $post->read();

// Get the row count
$posts = $result->fetchAll(PDO::FETCH_ASSOC);
if (count($posts) > 0) {
    $post_arr = ["data" => []];

    foreach ($posts as $row) {
        extract($row);
        $post_item = [
            "id" => $id,
            "title" => $title,
            "body" => $body,
            "author" => $author,
            "category_id" => $category_id,
            "category_name" => $category_name
        ];
        array_push($post_arr["data"], $post_item);
    }

    echo json_encode($post_arr);
} else {
    echo json_encode(["msg" => "No post found."]);
}
?>