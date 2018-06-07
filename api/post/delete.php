<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-6-7
 * Time: 下午12:00
 */

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    //Delete post
    if($post->delete()){
        echo json_encode(
            array('Message'=> 'Post Delete')
        );
    }else{
        echo json_encode(
            array('Message'=>'Post Not Delete')
        );
    }
