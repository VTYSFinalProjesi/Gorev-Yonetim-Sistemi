<?php
    include('config/constants.php');
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style4.css">
    <link rel="shortcut icon" href="/soc2-removebg-preview.ico" type="image/x-icon">
    <title>Görev Yönetim Sistemi</title>
</head>
<body>

<div class="container" style="padding:80px">
        <div class="leftbox">
            <nav>
                <a onclick="tabs(0)" class="tab active"><i class="fa-fa-user"></i></a>
                <a onclick="tabs(1)" class="tab"><i class="fa-fa-credit-card"></i></a>
                <a onclick="tabs(2)" class="tab"><i class="fa-fa-tv"></i></a>
                <a onclick="tabs(3)" class="tab"><i class="fa-fa-tasks"></i></a>
                <a onclick="tabs(4)" class="tab"><i class="fa-fa-cog"></i></a>
            </nav>
        </div>
        <div class="rightbox">
            <div class="profile-tabShow">
                <h1 class="text-align:center;">LİSTE - GÖREV JOIN TABLOSU</h1>
            </div>

        </div>


<div class="all-tasks" >
    <table class="tbl-full">
        <tr>
            <th>ID</th>
            <th>Liste Adı</th>
            <th>Liste Açıklaması</th>
            <th>Görev Adı</th>
            <th>Görev Açıklaması</th>
        </tr>

        <?php
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
    
    $sql = "SELECT tbl_lists.list_id, tbl_lists.list_name, tbl_lists.list_description, tbl_tasks.task_name, tbl_tasks.task_description
    FROM tbl_lists
    INNER JOIN tbl_tasks ON tbl_lists.list_id=tbl_tasks.list_id;";
    
    $result = mysqli_query($conn, $sql);

    while($row=mysqli_fetch_assoc($result))
    {
        $list_id = $row['list_id'];
        $list_name = $row['list_name'];
        $list_description = $row['list_description'];
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];

        ?>
            <tr>
            <td><?php echo $list_id; ?></td>
            <td><?php echo $list_name; ?></td>
            <td><?php echo $list_description; ?></td>
            <td><?php echo $task_name; ?></td>
            <td><?php echo $task_description; ?></td>
            </tr>
        <?php
    }
?>

    </table>
</div>
    
</body>
</html>


