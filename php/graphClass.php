<?php

//creating a class to collect data in arrays
class Graph{

    public $label = '';
    public $data = '';

    public function getData($table){
        global $conn;
        //query to get data from the table
        $sql = "SELECT * FROM `$table` ORDER BY `id` DESC LIMIT 10";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //loop through the returned data
        while ($row = mysqli_fetch_array($result)) {

            $this->label = $this->label . "'". $row['stamp']."',";
            $this->data = $this->data."'". $row['data'] ."',";
        }
        $this->data = trim($this->data,",");
        $this->label = trim($this->label,",");
    }
}

?>