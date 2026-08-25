<?php


class CreateDb
{
        public $servername;
        public $username;
        public $password;
        public $dbname;
        public $tablename;
        public $con;


        // class constructor
    public function __construct(
        $dbname = "group_17",
        $tablename = "chinese_album",
        $servername = "localhost",
        $username = "root",
        $password = null
    )
    {
      $this->dbname = $dbname;
      $this->tablename = $tablename;
      $this->servername = $servername;
      $this->username = $username;
      $password = $password ?? (getenv('DB_PASSWORD') ?: '');
      $this->password = $password;

      // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // Check connection
        if (!$this->con){
            die("Connection failed : " . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if(mysqli_query($this->con, $sql)){

            // $this->con = mysqli_connect($servername, $username, $password, $dbname);

            // // sql to create new table
            // $sql = " CREATE TABLE IF NOT EXISTS $tablename
            //                 (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            //                  product_name VARCHAR (25) NOT NULL,
            //                  product_price FLOAT,
            //                  product_image VARCHAR (100)
            //                 );";

            if (!mysqli_query($this->con, $sql)){
                echo "Error creating table : " . mysqli_error($this->con);
            }

        }else{
            // return false;
            return;
        }
    }

    // get product from the database
    public function getData(){
        mysqli_select_db($this->con, $this->dbname);
        mysqli_set_charset($this->con, "utf8");

        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if (!$result) {
            die('Query Error: ' . mysqli_error($this->con));
        }

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}


