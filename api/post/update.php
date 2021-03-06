<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-6-7
 * Time: 上午11:38
 */

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
        Access-Control-Allow-Methods, Authorization, X-Requested-With');


    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog Post Project

    $post = new Post($db);

    //Get data
    $data = json_decode(file_get_contents('php://input'));

    $post->id = $data->id;
    $post->title = $data->title;
    $post->body = $data->body;
    $post->category_id = $data->category_id;
    $post->author = $data->author;

    //Update post

    if($post->update()){
        echo json_encode(
            array('Message'=> 'Post Updated')
        );
    }else{
        echo json_encode(
            array('Message'=>'Post Not Update')
        );
    }
