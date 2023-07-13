<?php

$host = "localhost";
$user = "root";
$password ="";
$database = "cstore";

$code = "";
$longd = "";
$shortd = "";

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
    $posts[1] = $_POST['longd'];
    $posts[2] = $_POST['shortd'];
    return $posts;
}

// Search
if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM zone WHERE code = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $code = $row['code'];
                $longd = $row['longd'];
                $shortd = $row['shortd'];
            }
        }else{
            echo 'No Data For This Id';
        }
    }else{
        echo 'Result Error';
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `zone` SET `longd`='$data[1]',`shortd`= '$data[2]' WHERE `code` = $data[0]";
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
        <title>VIEW & EDIT ZONE</title>
        <link rel="Stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
        <form action="" method="post">
        <h3>VIEW & EDIT ZONE</h3>
            <div class="form-group">
                <label>Zone Code</label>
                <input type="number" name="code" class="form-control" placeholder="Id" value="<?php echo $code;?>">
            </div>
            <div class="form-group">
                <label>Zone Long Descripton</label>
                <input type="text" name="longd" class="form-control" placeholder="First Name" value="<?php echo $longd;?>">
            </div>
            <div class="form-group">
                <label>Short Descripton</label>
                <input type="text" name="shortd" class="form-control" placeholder="Last Name" value="<?php echo $shortd;?>">
            </div>
            <div>
                <input type="submit" name="update" class="btn" value="Update"><br><br>
                <input type="submit" name="search" class="btn" value="Find">
            </div>
        </form>
        </div>
    </body>
</html>