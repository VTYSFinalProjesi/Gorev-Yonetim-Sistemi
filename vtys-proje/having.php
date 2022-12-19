<?php
    include('config/constants.php');
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style5.css">
    <link rel="shortcut icon" href="/soc2-removebg-preview.ico" type="image/x-icon">
    <title>Görev Yönetim Sistemi</title>
</head>
<body>



<div class="container" style="padding:20px">
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
                <h1 class="text-align:center;">HAVING TABLOSU</h1>
                <h3 class="text-align:center;">Şehirlere Göre Kullanıcı Sayıları</h3>
            </div>

        </div>


        <div class="all-tasks">
    <table class="tbl-full">
        <tr>
            <th>Kullanıcı Sayısı</th>
            <th>Şehir</th>
            
        </tr>

        <?php
    

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
    
    $sql = "SELECT COUNT(user_id), user_city FROM tbl_users GROUP BY user_city 
    HAVING COUNT(user_id) > 0 ORDER BY COUNT(user_id) ASC;";
    
    $result = mysqli_query($conn, $sql);

    while($row=mysqli_fetch_assoc($result))
    {
        $user_id = $row['COUNT(user_id)'];
        $user_city = $row['user_city'];
        
        ?>
            <tr>
            <td><?php echo $user_id; ?></td>
            <td><?php echo $user_city; ?></td>
            </tr>
        <?php
    }
?>

    </table>
</div>

</body>
</html>




