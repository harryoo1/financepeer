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

    <?php
require ("includes/dbConnection.php");
$query= mysqli_query($sqlcon, "SELECT * FROM `datatable`");
 
//if we get any results we show them in table data
if(mysqli_num_rows($query) > 0):
 
?>
    <div class="container">
    <a class="nav-link d-block small" href="logout.php">click here to Logout</a>
        <div class="main-div" style="margin-top: 10px; background-color: #f5f5f5;">
            <h1 class="text-center" style="color: #a9a9a9; font-size: 30px; font-family: sans-serif;">Data</h1><hr>
            <table style="border: 1px solid #dddfe2;">
                <tr class="table-heading">
                    <th class="table-heading-id">Id</th>
                    <th class="table-heading-uid">User Id</th>
                    <th class="table-heading-title">Title</th>
                    <th class="table-headin-body">Body</th>
                </tr>
                <?php 
                // looping 
                while($row=mysqli_fetch_object($query)):?>
                <tr class="table-data">
                    <td class="table-data1"><?php echo $row->id; ?></td>
                    <td class="table-data2"><?php echo $row->userId; ?></td>
                    <td class="table-data3"><?php echo $row->title; ?></td>
                    <td class="table-data4"><?php echo $row->body; ?></td>
                </tr>
                <?php endwhile;?>
            </table>
            <?php 
            // no result show 
            else: ?>
            <h3>No Results found.</h3>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>