<?php
    include('config/constants.php');
?>

<html>
    <head>
        <title>Görev Yöneticisi</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
    <div class="wrapper">
        <h1>GÖREV YÖNETİCİSİ</h1>
           
        <a class="btn-secondary" href="<?php echo SITEURL; ?>login.php">Ana Sayfa</a>

        <h3>Listeleri Yönetme</h3>

        <p>
        <?php 
            
            //Ekleme için oturum mesajının kontrol edilmesi
            if(isset($_SESSION['add']))
            {
                //Mesajın görüntülenmesi
                echo $_SESSION['add'];
                //İlk görüntülemeden sonra mesajın kaldırılması
                unset($_SESSION['add']);
            }

            //Silme için oturum mesajının kontrol edilmesi
                
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            //Güncelleme için oturum mesajının kontrol edilmesi
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            
            //Silme hatası kontrolü
            if(isset($_SESSION['delete_fail']))
            {
                echo $_SESSION['delete_fail'];
                unset($_SESSION['delete_fail']);
            }
        ?>
        </p>
        
        <!-- Display Liste tablosunun başlangıcı -->
        <br>
        <a class="btn-primary" href="<?php echo SITEURL; ?>add-list.php">Liste Ekle</a>
        <br>
        <br>
        <div class="all-tasks">

            

            <table class="tbl-full">
                <tr>
                    <th>NO</th>
                    <th>Liste Adı</th>
                    <th>Seçenekler</th>
                </tr>

                <?php
                    //Veritabanının bağlanması
                    $conn=mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                    //Veritabanının seçilmesi
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                    //Veritabanındaki tüm verilerin görüntülenmesi için SQL sorgusu
                    $sql = "SELECT * FROM tbl_lists";

                    //Sorgunun yürütülmesi
                    $res = mysqli_query($conn, $sql);

                    if($res==true)
                    {
                        //Verilerin görüntülenmesi üzerine çalışılması
                        //echo "Executed";

                        //Veritabanındaki veri satırlarının sayısı
                        $count_rows = mysqli_num_rows($res);
                        
                        //Seri numarası değişkeninin oluşturulması
                        $sn = 1;

                        if($count_rows>0)
                        {
                            //Veritabanındaki verilerin tabloda görüntülenmesi
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Veritabanından veri çekme
                                $list_id = $row['list_id'];
                                $list_name = $row['list_name'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $list_name; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id; ?>" class="btn-primary">Güncelle</a> 
                                        <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>" class="btn-primary">Sil</a>
                                    </td>
                                </tr>
                                <?php 
                            }
                        }
                        else
                        {
                            //Veritabanında hiç veri olmaması
                            ?>
                            <tr>
                                <td colspan="3">Henüz liste eklenmedi.</td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            
            </table>
        </div>
        <!-- Display Liste tablosunun bitişi -->
    </div>                
    </body>
</html>