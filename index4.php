<?php 
if(isset($_POST['submit'])) {  
include ("config.php");
   $name=$_POST['name'];
   $nic=$_POST['nic'];
   $address=$_POST['address'];
   $mobile=$_POST['mobile'];
   $email=$_POST['email'];
   $gender=$_POST['gender'];
   $territory=$_POST['territory'];
   $username=$_POST['username'];
   $password=$_POST['password']; 

   $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE nic = '$nic'");
        if(mysqli_num_rows($duplicate) > 0){
            echo
                "<script> alert('NIC Has Already Taken'); </script>";
            }
   else{
	$sql = "INSERT INTO user". "(name,nic,address,mobile,email,gender,territory,username,password) ". "VALUES ('$name','$nic','$address','$mobile','$email','$gender','$territory','$username','$password')";
	$results = mysqli_query($conn, $sql);
            if(!$results) {
               die('Could not enter data: ' . mysqli_error($conn));
            }
			else
			{
            echo 
                "<script> alert('User Added Successfuly'); </script>";
			}	
     } 
}
?>

<?php
    if(!isset($_SESSION)) 
    include ("config.php");
    error_reporting(0);
    $s = mysqli_query($conn,"select * from territory");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER REGISTRATION</title>
    <link rel="Stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
    <form action="" method="post">
        <h3>ADD USERS</h3>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>NIC</label>
            <input type="text" class="form-control" name="nic" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" required>
        </div>
        <div class="form-group">
            <label>Mobile</label>
            <input type="text" class="form-control" name="mobile" required>
        </div>
        <div class="form-group">
            <label>E-Mail</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control" id="gender" required>
                <option value="" disabled selected hidden>Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label>Territory</label>
            <select name="territory" class="form-control" id="territory" required>
                <?php
                    while($r = mysqli_fetch_array($s))
                    {
                        ?>
                        <option><?php echo $r['tcode']; ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>User Name</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <input type="submit" class="btn" name="submit" value="SAVE">
    </form>
    </div>
    </div>
</body>
</html>