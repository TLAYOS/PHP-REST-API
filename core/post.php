<?php

class Post {
    private $conn;
    private $table = "post";


    // Post properties
    public $id;
    public $title;
    public $category_id;
    public $category_name;
    public $body;
    public $author;
    public $created_at;

    // Constructor with db connection 
    public function __construct($db) {
        $this->conn = $db;
        $this->table = "post";
    }

    // Getting posts from the database 
    public function read(){
        // Create query
        $query = 'SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM
            '.$this->table.' p
            LEFT JOIN
                categories c ON p.category_id = c.id
                ORDER BY p.created_at DESC
        ';

    // Prepare the statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
    }

    public function read_single(){
        $query = 'SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM
            '.$this->table.' p
            LEFT JOIN
                categories c ON p.category_id = c.id
                WHERE p.id = ? LIMIT 1
        ';
        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        //Binding
        $stmt->bindParam(1, $this->id);
        // Execute
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->title = $row['title'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        $this->body = $row['body'];
        $this->author = $row['author'];
    }

    public function create(){
        //Create Query
        $query = 'INSERT INTO ' .$this->table. '(title, body, author, category_id)
          VALUES (:title, :body, :author, :category_id)
        ';
        //Prepare Statement
        $stmt = $this->conn->prepare($query);
        //Clean data
        $this->title       = htmlspecialchars(strip_tags($this->title));
        $this->body        = htmlspecialchars(strip_tags($this->body));
        $this->author      = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        //Binding Params
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);

         return $stmt->execute();
    }

    // Update
     public function update(){
        //Create Query
        $query = 'UPDATE ' .$this->table. '
        SET 
        title = :title,
        body = :body,
        author= :author,
        category_id = :category_id
        WHERE id = :id
        ';
        //Prepare Statement
        $stmt = $this->conn->prepare($query);
        //Clean data
        $this->title       = htmlspecialchars(strip_tags($this->title));
        $this->body        = htmlspecialchars(strip_tags($this->body));
        $this->author      = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id          = htmlspecialchars(strip_tags($this->id));
        //Binding Params
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

         return $stmt->execute();
    }
    
    
    // Delete
    public function delete(){
        $query = 'DELETE FROM ' .$this->table. ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

}


?>