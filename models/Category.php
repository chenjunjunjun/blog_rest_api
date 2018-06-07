<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-6-7
 * Time: 下午12:39
 */

    class Category {
        //DB stuff
        private $conn;
        private $table = 'categories';

        //DB properties
        public $id;
        public $name;
        public $created_at;


        public function __construct($db)
        {
            $this->conn = $db;
        }


        //Get Category
        public function read(){
            //create query
            $query = 'SELECT 
              id,
              name,
              created_at
              FROM ' .$this->table.' 
              ORDER BY 
                created_at DESC';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Query execute
            $stmt->execute();

            return $stmt;
        }
    }