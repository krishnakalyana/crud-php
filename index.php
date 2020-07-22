<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once 'process.php';?>
<?php
    if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
        </div>
        <?php endif ?>

<?php
 $mysqli = new mysqli('localhost','root','','crud') or die (mysqli_error($mysqli));
 $result = $mysqli->query('SELECT* from data') or die($mysqli->error);
 //pre_r($result);
//  pre_r($result->fetch_assoc());
//  pre_r($result->fetch_assoc());
?>

<div class="container-fluid">
    <table class="table">
    <thead>
    <tr>
    <th>Type of Request </th>
    <th>Software making request</th>
    <th>Owner</th>
    <th>Description</th>
    <th>Inputs </th>
    <th>Outputs  </th>
    <th>Remarks</th>
    <th colspan='2'>Edit / Delete</th>
    </tr>
    
    </thead>
    <?php
    while ($row=$result->fetch_assoc()): ?>
    <tr>
    <td><?php echo addslashes($row['type']);?></td>
    <td><?php echo $row['software'];?></td>
    <td><?php echo $row['owner'];?></td>
    <td><?php echo $row['description'];?></td>
    <td><?php echo $row['input'];?></td>
    <td><?php echo $row['output'];?></td>
    <td><?php echo $row['remarks'];?></td>
    <td>
    <a href="index.php?edit=<?php echo $row['id'];?>"
    class="btn btn-info">Edit</a>
    <a href="process.php?delete=<?php echo $row['id'];?>"
    class="btn btn-danger">Delete</a>
    </td>
    </tr>
    <?php endwhile;?>

    </table>
</div>
<?php
 function pre_r($array){
     echo'<pre>';
     print_r($array);
     echo'</pre>';
 }
?>

<div class="container-fluid">
<h3 class="center">Add Requirements</h3>
<form action="process.php" method='POST'>
  <div class="form-group col-7">
    <label for="type">Type</label>
    <input type="text" class="form-control" name="type" id="type" 
    value="<?php echo $type;?>" placeholder="Type">
  </div>
  <div class="form-group col-7">
    <label for="software">Software</label>
    <input type="text" class="form-control" name="software" id="software" 
    value="<?php echo $software;?>"placeholder="Software">
  </div>
  <div class="form-group col-7">
    <label for="owner">Owner</label>
    <input type="text" class="form-control" name="owner" id="owner"
    value="<?php echo $owner;?>" placeholder="Owner">
  </div>
  <div class="form-group col-7">
    <label for="description">Description</label>
    <input type="text" class="form-control" name="description" id="description"
    value="<?php echo $description;?>" placeholder="Description">
  </div>
  <div class="form-group col-7">
    <label for="input">Input</label>
    <input type="text" class="form-control" name="input" id="input"
    value="<?php echo $input;?>" placeholder="Input">
  </div>
  <div class="form-group col-7">
    <label for="output">Output</label>
    <input type="text" class="form-control" name="output" id="output"
    value="<?php echo $output;?>" placeholder="Output">
  </div>
  <div class="form-group col-7">
    <label for="remarks">Remarks</label>
    <textarea class="form-control" name="remarks" id="remarks"
    value="<?php echo $remarks;?>" rows="3"></textarea>
  </div>
  <div class="form-group col-7">
  <button type="submit" class="btn btn-primary  btn-lg btn-block" name="add">Add</button>
  </div>
</form>
</div>

</body>
</html>