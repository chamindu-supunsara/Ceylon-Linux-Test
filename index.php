<?php 
if(isset($_POST['submit'])) {  
include ("config.php");
   $code=$_POST['code'];
   $longd=$_POST['longd'];
   $shortd=$_POST['shortd']; 

   $duplicate = mysqli_query($conn, "SELECT * FROM zone WHERE code = '$code'");
        if(mysqli_num_rows($duplicate) > 0){
            echo
                "<script> alert('SKU ID or SKU Code Has Already Taken'); </script>";
            }
   else{
	$sql = "INSERT INTO zone". "(code,longd,shortd) ". "VALUES ('$code','$longd','$shortd')";
	$results = mysqli_query($conn, $sql);
            if(!$results) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
			else
			{
            echo 
                "<script> alert('Zone Added Successfuly'); </script>";
			}	
     } 
}
?>

<?php
        if(!isset($_SESSION)) 
        include ("config.php");
        error_reporting(0);
        $query2 = "select * from zone order by code desc limit 1";
        $result2 = mysqli_query($conn,$query2);
        $row = mysqli_fetch_array($result2);
        $last_id = $row['code'];
        if ($last_id == "")
        {
            $customer_ID = "1001";
        }
        else
        {
            $customer_ID = substr($last_id, 3);
            $customer_ID = intval($customer_ID);
            $customer_ID = "100" . ($customer_ID + 1);
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZONE REGISTRATION</title>
    <link rel="Stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <form action="" method="post">
        <h3>ADD ZONE</h3>
        <div class="form-group">
            <label>Zone Code</label>
            <input type="text" class="form-control" name="code" value="<?php echo $customer_ID; ?>">
        </div>
        <div class="form-group">
            <label>Zone Long Descripton</label>
            <input type="text" class="form-control" placeholder="Ex. ZONE 1" name="longd" required>
        </div>
        <div class="form-group">
            <label>Short Descripton</label>
            <input type="text" class="form-control" placeholder="Ex. Z01" name="shortd"required>
        </div>
        <input type="submit" class="btn" value="SAVE" name="submit"><br><br>
    </form>
    <a href="//localhost/Test/index6.php" class="button">VIEW / EDIT</a>
    </div>
</body>
</html>