<?php 
if(isset($_POST['submit_post'])){
    require ("includes/dbConnection.php");
    $insert_query = '';
    $uploadOk = 1;
    $fileName = $_FILES['fileToUpload']['name'];
    $errorMessage = "";
    
    if($fileName != ""){
        $targetDir = "json/";
        $fileName = $targetDir.uniqid().basename($fileName);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
        if($_FILES['fileToUpload']['size'] > 10000000){
            $errorMessage = "Sorry ! file size exceeds 10 MB";
            $uploadOk = 0;
        }
        if(strtolower($fileType) != "json"){
            $errorMessage = "File should be JSON !";
            $uploadOk = 0;
        }
        
        if($uploadOk){
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $fileName)){
    
            }
            else{
                $uploadOk = 0;
            }
        }
    }
    if($uploadOk){
        // Read the JSON file in PHP
        $data = file_get_contents($fileName);
            
        // Convert the JSON String into PHP Array
        $array = json_decode($data, true); 

        foreach($array as $row) {
            $insert_query .= mysqli_multi_query($sqlcon, "INSERT INTO datatable VALUES (NULL, '".$row["userId"]."', '".$row["title"]."', '".$row["body"]."'); ");
        }
        if($query){
        echo '<h2 style="text-align: center;">Inserted JSON Data</h2><br />';
        }
    }
    else{
        echo "<div style='text-align: center;' class='alert alert-danger'>
                 $errorMessage;
              </div>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Financepeer</title>
</head>

<body>
<div class="container">
<a class="nav-link d-block small" href="logout.php">click here to Logout</a>
    <div class="main-div">
    <button name="submit" class="btn btn-success" style="margin: 10px;"><a href="data.php">Click to view Data</a></button>
        <div class="">
            <div class="card" style="margin-bottom: 2px;">
                <div class="card-header post_btn_card-header text-center">
                    Upload JSON file
                </div>
                <div class="card-body">
                <form action="panel.php" method="post" enctype="multipart/form-data">
                    <div class="form-group" style="text-align: center; margin-top: 20px;">
                        <div class="form-label-group">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                    </div>
                    <button type="submit" name="submit_post" class="post_btn btn btn-block">Upload</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>