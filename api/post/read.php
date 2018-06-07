<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-6-6
 * Time: 下午5:54
 */

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog Post Project

    $post = new Post($db);

    //Blog post query
    $result = $post->read();

    //Get row count
    $num = $result->rowCount();


    //Check if any posts
    if($num>0){
        //Post array
        $post_array = array();
        $post_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);


            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );


            //Push to 'data'
//            array_push($posts_array['data'], $post_item);
            $post_array['data'][] = $post_item;
        }

        echo json_encode($post_array);
    }
    else{
        //No posts
        echo json_encode(array('message'=>'No Posts Found'));
    }