<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "cstore";

$code = "";
$rcode = "";
$tcode = "";
$tname = "";

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
    $posts[0] = $_POST['code'];
    $posts[1] = $_POST['rcode'];
    $posts[2] = $_POST['tcode'];
    $posts[3] = $_POST['tname'];
    return $posts;
}

// Search
if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM territory WHERE code = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $code = $row['code'];
                $rcode = $row['rcode'];
                $tcode = $row['tcode'];
                $tname = $row['tname'];
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
    $update_Query = "UPDATE `territory` SET `rcode`='$data[1]',`tcode`= '$data[2]',`tname`= '$data[3]' WHERE `code` = $data[0]";
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
        <title>PHP INSERT UPDATE DELETE SEARCH</title>
        <link rel="Stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
        <form action="" method="post">
        <h3>VIEW & EDIT TERRITORY</h3>
            <div class="form-group">
                <label>Zone </label>
                <input type="number" name="code" class="form-control" placeholder="Ex. 1001" value="<?php echo $code;?>">
            </div>
            <div class="form-group">
                <label>Region</label>
                <input type="text" name="rcode" class="form-control" placeholder="Ex. 2001" value="<?php echo $rcode;?>">
            </div>
            <div class="form-group">
                <label>Territory Code</label>
                <input type="text" name="tcode" class="form-control" placeholder="EX. REGION1" value="<?php echo $tcode;?>">
            </div>
            <div class="form-group">
                <label>Territory Name</label>
                <input type="text" name="tname" class="form-control" placeholder="EX. TERRRITORY1" value="<?php echo $tname;?>">
            </div>
            <div>
                <input type="submit" name="update" class="btn" value="Update"><br><br>
                <input type="submit" name="search" class="btn" value="Find">
            </div>
        </form>
        </div>
    </body>
</html>