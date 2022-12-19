<html>
<?php
    include('config/constants.php');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
    
    $sql = "SELECT * FROM tbl_users";
    $result = mysqli_query($conn, $sql);
    $count_rows = mysqli_num_rows($result);
    
    $query = "SELECT MAX(user_age) AS scores FROM tbl_users";
    $query_result = mysqli_query($conn, $query);

    $query2 = "SELECT MIN(user_age) AS scores2 FROM tbl_users";
    $query_result2 = mysqli_query($conn, $query2);

    $query3 = "SELECT COUNT(user_id) AS scores3 FROM tbl_users";
    $query_result3 = mysqli_query($conn, $query3);

    $query4 = "SELECT SUM(user_age) AS scores4 FROM tbl_users";
    $query_result4 = mysqli_query($conn, $query4);

    $query5 = "SELECT AVG(user_age) AS scores5 FROM tbl_users";
    $query_result5 = mysqli_query($conn, $query5);

    while($row=mysqli_fetch_assoc($query_result))
    {
        $output="En Yaşlı Kullanıcının Yaşı:"." ".$row['scores']."<br>";
    }

    while($row=mysqli_fetch_assoc($query_result2))
    {
        $output2="En Genç Kullanıcının Yaşı:"." ".$row['scores2']."<br>";
    }

    while($row=mysqli_fetch_assoc($query_result3))
    {
        $output3="Kayıtlı Kullanıcı Sayısı:"." ".$row['scores3']."<br>";
    }

    while($row=mysqli_fetch_assoc($query_result4))
    {
        $output4=nl2br("Kullanıcıların Yaşları Toplamı:"." ".$row['scores4']."<br>");
        
        
    }
    
    while($row=mysqli_fetch_assoc($query_result5))
    {
        $output5=nl2br("Kullanıcıların Yaşları Ortalaması:"." ".$row['scores5']);
    }
 
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="/soc2-removebg-preview.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style3.css">
    <title>Görev Yönetim Sistemi</title>

<style>
table, tr, td{
    text-align:center;
}
table, tr, th, td{
    border:1px solid #ccc;
}

</style>

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
                <h1 class="text-align:center;">KULLANICI BİLGİLERİ</h1>
            </div>

        </div>
        

    <?php
        echo $output3;
    ?>
    <br>
    <?php
        echo $output;
    ?>
    <br>
    <?php
        echo $output2;
    ?>
    <br>
    <?php
        echo $output4;
    ?>
    <br>
    <?php
        echo $output5;
    ?>
    <?php
    
    if($count_rows>0)
    {
        while($row=mysqli_fetch_assoc($result))
        {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_mail = $row['user_mail'];
            $user_age = $row['user_age'];
            $user_password = $row['user_password'];

            
        }
    }
    else
    {
        ?>
            <tr>
                <td colspan="5">Henüz kullanıcı eklenmedi.</td>
            </tr>
        <?php
    }
    ?>

    </div>
    
</body>
</html>

