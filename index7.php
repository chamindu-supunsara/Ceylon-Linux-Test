<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "cstore";

$zone = "";
$rcode = "";
$rname = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['zone'];
    $posts[1] = $_POST['rcode'];
    $posts[2] = $_POST['rname'];
    return $posts;
}

// Search
if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM region WHERE zone = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $zone = $row['zone'];
                $rcode = $row['rcode'];
                $rname = $row['rname'];
            }
        }else{
            echo "<script> alert('No Data with this ID'); </script>";
        }
    }else{
        echo 'Result Error';
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `region` SET `rcode`='$data[1]',`rname`= '$data[2]' WHERE `zone` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo "<script> alert('Update Successfuly'); </script>";
            }else{
                echo "<script> alert('Update Not Successfuly'); </script>";
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>


<!DOCTYPE Html>
<html>
    <head>
        <title>VIEW & EDIT REGION</title>
        <link rel="Stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
        <form action="" method="post">
        <h3>VIEW & EDIT REGION</h3>
            <div class="form-group">
                <label>Zone </label>
                <input type="number" name="zone" class="form-control" placeholder="Ex. 1001" value="<?php echo $zone;?>">
            </div>
            <div class="form-group">
                <label>Region Code</label>
                <input type="text" name="rcode" class="form-control" placeholder="Ex. 2001" value="<?php echo $rcode;?>">
            </div>
            <div class="form-group">
                <label>Region Name</label>
                <input type="text" name="rname" class="form-control" placeholder="EX. REGION1" value="<?php echo $rname;?>">
            </div>
            <div>
                <input type="submit" name="update" class="btn" value="Update"><br><br>
                <input type="submit" name="search" class="btn" value="Find">
            </div>
        </form>
        </div>
    </body>
</html>