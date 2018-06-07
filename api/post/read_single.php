<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-6-6
 * Time: 下午7:41
 */

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();


    //Instantiate blog Post Project

    $post = new Post($db);

    //Get ID
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get post
    $post->read_single();

    //Create array

    $single_post = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name,
        'created_at'=> $post->created_at
    );


    //echo json
//    print_r(json_encode($single_post));
    echo json_encode($single_post);