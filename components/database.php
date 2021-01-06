<?php

class createDatabase{
    // public $serverName;
    // public $userName;
    // public $password;
    // public $tableName;
    // public $databaseName;
    // public $connection;
    //class constructor

    public function __construct($databaseName = "gadgetStore",
    $tableName = "productDatabase", $serverName = "localhost", $userName = "root", $password = ""
    )
    {
        $this->databaseName = $databaseName;
        $this->tableName = $tableName;
        $this->serverName = $serverName;
        $this->userName = $userName;
        $this->password = $password;

        //connection
        $this->connection = mysqli_connect($serverName, $userName, $password);

        //check connection
        if (!$this->connection){
            die("Connection Failde: ".mysqli_connect_error());
        }

        $createDatabase = "CREATE DATABASE IF NOT EXISTS $databaseName";

        //execute connection 
        if(mysqli_query($this->connection, $createDatabase)){
            $this->connection = mysqli_connect($serverName, $userName, $password, $databaseName);


            //create table

            $table = "CREATE TABLE IF NOT EXISTS $tableName (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR (25) NOT NULL,
            product_price FLOAT,
            product_image VARCHAR(100))";

            if (!mysqli_query($this->connection, $table)){
                echo "Error creating Tables: ". mysqli_error($this->connection);

            }
        }else {
            return false;
        }

    }

    //get product from the database
    public function getData(){
        $getproduct = "SELECT * FROM productDatabase";
        $productFromDatabase = mysqli_query($this->connection, $getproduct);

        if(mysqli_num_rows($productFromDatabase) > 0){
            return $productFromDatabase;
        }
    }
}