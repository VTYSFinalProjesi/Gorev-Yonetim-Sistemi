<?php
    include('config/constants.php');
?>

<html>
    <head>
        <!--<meta content="0; url=login.php">-->
        <title>Görev Yönetim Sistemi</title>
        <link rel="shortcut icon" href="/soc2-removebg-preview.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />   
    <body>

    <div class="wrapper">
        
    <h1>GÖREV YÖNETİM SİSTEMİ</h1>

    <!-- Menü'nün başlangıcı -->
    
    <div class="menu">
    
    <a href="<?php echo SITEURL; ?>login.php">Ana Sayfa</a>

    <?php 
            
            //Veritabanı bağlantısı
            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
            
            //Veritabanının seçilmesi
            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
            
            //Veritabanındaki listelerin alınması için gerekli SQL sorgusu
            $sql2 = "SELECT * FROM tbl_lists";
            
            //Sorgunun yürütülmesi
            $res2 = mysqli_query($conn2, $sql2);
            
            //Sorgunun yürütülüp yürütülemediğinin kontrolü 
            if($res2==true)
            {
                //Listeleri menüde görüntüleme
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $list_id = $row2['list_id'];
                    $list_name = $row2['list_name'];
                    ?>
                    
                    <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                    
                    <?php
                    
                }
            }
            
        ?>

    <a href="<?php echo SITEURL; ?>manage-list.php">Listeleri Yönet</a>
    <a href="<?php echo SITEURL; ?>user-infos.php">Kullanıcı Bilgileri</a>
    <a href="<?php echo SITEURL; ?>having.php">Having Tablosu</a>
    <a href="<?php echo SITEURL; ?>join.php">Join Tablosu</a>
    <a href="logout.php">Çıkış Yap</a>
    </div>
    
    <!-- Menü'nün bitişi -->

    <!-- Görevler'in başlangıcı -->
    
    <p>
    <?php 
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        
        if(isset($_SESSION['delete_fail']))
        {
            echo $_SESSION['delete_fail'];
            unset($_SESSION['delete_fail']);
        }
    
    ?>
    </p>
    <br>
    <a class="btn-primary" href="<?php SITEURL; ?>add-task.php">Görev Ekle</a>
    <div class="all-tasks">
    
    <table class="tbl-full">
    <tr>
        <th>NO</th>
        <th>Görev Adı</th>
        <th>Öncelik</th>
        <th>Bitiş Tarihi</th>
        <th>Seçenekler</th>
    </tr>
    
            <?php 
            
                //Veritabanı bağlantısı
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                
                //Veritabanının seçilmesi
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                
                //Verilerin getirilmesi için gerekli SQL sorgusu
                $sql = "SELECT * FROM tbl_tasks";
                
                //Sorgunun yürütülmesi
                $res = mysqli_query($conn, $sql);
                
                //Sorgunun yürütülüp yürütülemediğinin kontrol edilmesi
                if($res==true)
                {
                    //Veritabanında görevlerin görüntülenmesi
                    //Önce veritabanındaki verilerin yerleştirilmesi
                    $count_rows = mysqli_num_rows($res);
                    
                    //Seri numarası değişkeni oluşturma
                    $sn=1;
                    
                    //Veritabanında görev olup olmadığının kontrol edilmesi
                    if($count_rows>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $priority = $row['priority'];
                            $deadline = $row['deadline'];
                            ?>
                            
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $task_name; ?></td>
                                <td><?php echo $priority; ?></td>
                                <td><?php echo $deadline; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>" class="btn-primary">Güncelle </a>
                                    
                                    <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>" class="btn-primary">Sil </a>
                                
                                </td>
                            </tr>
                            
                            <?php
                        }
                    }
                    else
                    {
                        //Veritabanında verinin olmaması
                        ?>
                        <tr>
                            <td colspan="5">Henüz görev eklenmedi.</td>
                        </tr>
                        <?php
                    }
                }
            
            ?>
    
    </table>
    </div>
    
    <!-- Görevler'in bitişi -->
    
    </div>
    </body>
    </head>
</html>