<?php 
session_start();
    $type='';
    $software='';
    $owner='';
    $description='';
    $input='';
    $output='';
    $remarks='';

$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));

if(isset($_POST['add'])){
    $type=addslashes($_POST['type']);
    $software=addslashes($_POST['software']);
    $owner=addslashes($_POST['owner']);
    $description=addslashes($_POST['description']);
    $input=addslashes($_POST['input']);
    $output=addslashes($_POST['output']);
    $remarks=addslashes($_POST['remarks']);

    $mysqli->query("INSERT INTO data (type,software,owner,description,input,output,remarks) VALUES('$type','$software','$owner','$description','$input','$output','$remarks')") or
    die($mysqli->error);

    $_SESSION['message']="Requirement has been added.";
    $_SESSION['msg_type']="success";
    header('location:index.php');
}


if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error()); 
    $_SESSION['message']="Requirement has been Deleted.";
    $_SESSION['msg_type']="danger";
    header('location:index.php');

}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $result=$mysqli->query("SELECT* FROM data WHERE id=$id") or die($mysqli->error());
    if ($result->num_rows){
        $row = $result->fetch_array();
        $type=$row['type'];
        $software=$row['software'];
        $owner=$row['owner'];
        $description=$row['description'];
        $input=$row['input'];
        $output=$row['output'];
        $remarks=$row['remarks'];

    }
}

?>