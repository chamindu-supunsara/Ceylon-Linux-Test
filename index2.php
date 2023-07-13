<?php 
if(isset($_POST['submit'])) {  
include ("config.php");
   $zone=$_POST['zone'];
   $rcode=$_POST['rcode'];
   $rname=$_POST['rname']; 

   $duplicate = mysqli_query($conn, "SELECT * FROM region WHERE rcode = '$rcode'");
        if(mysqli_num_rows($duplicate) > 0){
            echo
                "<script> alert('REGION Code Has Already Taken'); </script>";
            }
   else{
	$sql = "INSERT INTO region". "(zone,rcode,rname) ". "VALUES ('$zone','$rcode','$rname')";
	$results = mysqli_query($conn, $sql);
            if(!$results) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
			else
			{
            echo 
                "<script> alert('Region Added Successfuly'); </script>";
			}	
     } 
}
?>

<?php
        if(!isset($_SESSION)) 
        include ("config.php");
        error_reporting(0);
        $query2 = "select * from region order by rcode desc limit 1";
        $result2 = mysqli_query($conn,$query2);
        $row = mysqli_fetch_array($result2);
        $last_id = $row['rcode'];
        if ($last_id == "")
        {
            $customer_ID = "2001";
        }
        else
        {
            $customer_ID = substr($last_id, 3);
            $customer_ID = intval($customer_ID);
            $customer_ID = "200" . ($customer_ID + 1);
        }
?>

<?php
    if(!isset($_SESSION)) 
    include ("config.php");
    error_reporting(0);
    $s = mysqli_query($conn,"select * from zone");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGION REGISTRATION</title>
    <link rel="Stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <form action="" method="post">
        <h3>ADD REGION</h3>
        <div class="form-group">
            <label>Zone</label>
            <select name="zone" class="form-control" id="zone" required>
                <?php
                    while($r = mysqli_fetch_array($s))
                    {
                        ?>
                        <option><?php echo $r['code']; ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Region Code</label>
            <input type="text" class="form-control" name="rcode" value="<?php echo $customer_ID; ?>" >
        </div>
        <div class="form-group">
            <label>Region Name</label>
            <input type="text" class="form-control" placeholder="Ex. REGION 1" name="rname" required>
        </div>
        <input type="submit" class="btn" name="submit" value="SAVE"><br><br>
    </form>
    <a href="//localhost/Test/index7.php" class="button">VIEW / EDIT</a>
    </div>
</body>
</html>