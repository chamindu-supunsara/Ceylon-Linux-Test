<?php 
if(isset($_POST['submit'])) {  
include ("config.php");
   $code=$_POST['code'];
   $rcode=$_POST['rcode'];
   $tcode=$_POST['tcode'];
   $tname=$_POST['tname'];  

   $duplicate = mysqli_query($conn, "SELECT * FROM territory WHERE tcode = '$tcode'");
        if(mysqli_num_rows($duplicate) > 0){
            echo
                "<script> alert('Territory Code Has Already Taken'); </script>";
            }
   else{
	$sql = "INSERT INTO territory". "(code,rcode,tcode,tname) ". "VALUES ('$code','$rcode','$tcode','$tname')";
	$results = mysqli_query($conn, $sql);
            if(!$results) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
			else
			{
            echo 
                "<script> alert('Territory Added Successfuly'); </script>";
			}	
     } 
}
?>

<?php
        if(!isset($_SESSION)) 
        include ("config.php");
        error_reporting(0);
        $query2 = "select * from territory order by tcode desc limit 1";
        $result2 = mysqli_query($conn,$query2);
        $row = mysqli_fetch_array($result2);
        $last_id = $row['tcode'];
        if ($last_id == "")
        {
            $customer_ID = "3001";
        }
        else
        {
            $customer_ID = substr($last_id, 3);
            $customer_ID = intval($customer_ID);
            $customer_ID = "300" . ($customer_ID + 1);
        }
?>

<?php
    if(!isset($_SESSION)) 
    include ("config.php");
    error_reporting(0);
    $s = mysqli_query($conn,"select * from zone");
?>

<?php
    if(!isset($_SESSION)) 
    include ("config.php");
    error_reporting(0);
    $ss = mysqli_query($conn,"select * from region");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERRITORY REGISTRATION</title>
    <link rel="Stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <form action="" method="post">
        <h3>ADD TERRITORY</h3>
        <div class="form-group">
            <label>Zone</label>
            <select name="code" class="form-control" id="code" required>
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
            <label>Region</label>
            <select name="rcode" class="form-control" id="rcode" required>
                <?php
                    while($r = mysqli_fetch_array($ss))
                    {
                        ?>
                        <option><?php echo $r['rcode']; ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Territory Code</label>
            <input type="text" class="form-control" name="tcode" value="<?php echo $customer_ID; ?>">
        </div>
        <div class="form-group">
            <label>Territory Name</label>
            <input type="text" class="form-control" placeholder="Ex. TERRITORY 01" name="tname" required>
        </div>
        <input type="submit" class="btn" name="submit" value="SAVE"><br><br>
    </form>
    <a href="//localhost/Test/index8.php" class="button">VIEW / EDIT</a>
    </div>
</body>
</html>