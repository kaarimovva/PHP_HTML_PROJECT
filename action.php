<?php


    $conn = new mysqli('localhost','root','','ravpanda');

IF(!$conn){
    die(mysqli_error($conn));
}

  if(isset($_POST['save'])){
      
     $data1 = $_POST['Input1'];
    
     $data2 = $_POST['Input2'];
    
     $data3 = $_POST['Input3'];

    $sql = "INSERT INTO table_a (DATA) values ($data1)
                    INSERT INTO table_b (DATA) values ($data2)
                    INSERT INTO table_c (DATA) values ($data3)";
    $result = mysqli_query($conn, $sql);
    if ($result){
        echo "INSERTED";

    }else{
        die(mysqli_error($conn));
    }
 }
 

?>