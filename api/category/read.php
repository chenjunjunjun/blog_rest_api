<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-6-7
 * Time: 下午12:47
 */

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';


    //Instantiate DB & Connect
    $database  = new Database();
    $db = $database->connect();

    //Instantiate Category object
    $category = new Category($db);

    //Blog Category query
    $result = $category->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any category

    if($num>0){
        $category_arr = array();
        $category_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $category_item = array(
                'id' => $id,
                'name' => $name
            );

            $category_arr['data'][] = $category_item;
        }

        echo json_encode($category_arr);


    }else{
        echo json_encode(
            array('Message' => 'No Category.')
        );
    }