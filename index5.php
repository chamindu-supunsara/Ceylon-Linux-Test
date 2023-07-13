<?php 
if(isset($_POST['submit'])) {  
include ("config.php");
   $id=$_POST['id'];
   $code=$_POST['code'];
   $name=$_POST['name'];
   $mrp=$_POST['mrp'];
   $price=$_POST['price'];
   $wv=$_POST['wv'];  
   $wv2=$_POST['wv2'];  
   
   $duplicate = mysqli_query($conn, "SELECT * FROM product WHERE id = '$id'");
        if(mysqli_num_rows($duplicate) > 0){
            echo
                "<script> alert('SKU ID or SKU Code Has Already Taken'); </script>";
            }

   else{
	$sql = "INSERT INTO product". "(id,code,name,mrp,price,wv,wv2) ". "VALUES ('$id','$code','$name','$mrp','$price','$wv','$wv2')";
	$results = mysqli_query($conn, $sql);
            if(!$results) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
			else
			{
            echo 
                "<script> alert('Product Registration Successfuly'); </script>";
			}	
     }   
}
?>

<?php
        if(!isset($_SESSION)) 
        include ("config.php");
        error_reporting(0);
        $query2 = "select * from product order by id desc limit 1";
        $result2 = mysqli_query($conn,$query2);
        $row = mysqli_fetch_array($result2);
        $last_id = $row['id'];
        if ($last_id == "")
        {
            $customer_ID = "SKU1";
        }
        else
        {
            $customer_ID = substr($last_id, 3);
            $customer_ID = intval($customer_ID);
            $customer_ID = "SUK" . ($customer_ID + 1);
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCT REGISTRATION</title>
    <link rel="Stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
    <form action="" method="post">
        <h3>ADD SKU</h3>
        <div class="form-group">
            <label>SKU ID</label>
            <input type="text" class="form-control" name="id" value="<?php echo $customer_ID; ?>" readonly>
        </div>
        <div class="form-group">
            <label>SKU Code</label>
            <input type="text" class="form-control" name="code" required>
        </div>
        <div class="form-group">
            <label>SKU Name</label>
            <input type="text" class="form-control" placeholder="Main Product Name/auto" name="name" required>
        </div>
        <div class="form-group">
            <label>MRP</label>
            <input type="text" class="form-control" name="mrp" required>
        </div>
        <div class="form-group">
            <label>Distributor Price</label>
            <input type="text" class="form-control" name="price" required>
        </div>
        <div class="form-group">
            <label>Weight/Volume</label>
            <input type="text" class="form-control" name="wv" required>
        </div>
        <div class="form-group">
            <select name="wv2" class="form-control" id="wv2" required>
                <option value="" disabled selected hidden></option>
                <option value="weight">Weight</option>
                <option value="volume">Volume</option>
            </select>
        </div>
        <input type="submit" class="btn" name="submit" value="SAVE">
    </form>
    </div>
</body>
</html>