<?php
session_start();
$phone = $_POST['phone'];
$password = $_POST['password'];

$conn = new mysqli("localhost","root","","app");
if($conn->connect_error)
{
    die("connection failed:-" .$conn->connect_error);
}       
else
{
    $stmt = $conn->prepare("select * from register where phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0)
    {
        $data = $stmt_result->fetch_assoc();

        if($data['password']==$password)
        {
            echo"login successfully";
            header("location:zeitplan\index.html"); 

        }
        else
        {
            echo"invalid phone no. or password";
        }
        
    }
    else
    {
        echo " !!! invalid phone no. or password !!!";
    }
}
?>