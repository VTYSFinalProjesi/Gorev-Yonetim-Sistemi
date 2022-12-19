<?php
    include('config/constants.php'); 
    
    //Seçilen listenin mevcut verilerinin alınması
    if(isset($_GET['list_id']))
    {
        //list_id değerinin alınması
        $list_id = $_GET['list_id'];
        
        //Veritabanı bağlantısı
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //Veritabanının seçilmesi
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        
        //Veritabanındaki verileri getiren SQL sorgusu
        $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";
        
        //Sorgunun yürütülmesi
        $res = mysqli_query($conn, $sql);
        
        //Sorgunun başarılı şekilde yürütülüp yürütülmediğinin kontrol edilmesi
        if($res==true)
        {
            //Veritabanındaki verilerin alınması
            $row = mysqli_fetch_assoc($res);
            
            //$row dizisinin yazdırılması
            //print_r($row);
            
            //Verileri kaydetmek için değişken oluşturulması
            $list_name = $row['list_name'];
            $list_description = $row['list_description'];
        }
        else
        {
            //Yönetim Listesi ekranına geri dönülmesi
            header('location:'.SITEURL.'manage-list.php');
        }
    }

?>




<html>
    <head>
        <title>Görev Yöneticisi</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
        <div class="wrapper">
        <h1>GÖREV YÖNETİCİSİ</h1>
            <a class="btn-secondary"  href="<?php echo SITEURL; ?>login.php">Ana Sayfa</a>
            <a class="btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Listeleri Yönet</a>
        <h3>Liste Güncelleme</h3>
        <p>
            <?php 
                //Oturumun ayarlanıp ayarlanamamasının kontrol edilmesi
                if(isset($_SESSION['update_fail']))
                {
                    echo $_SESSION['update_fail'];
                    unset($_SESSION['update_fail']);
                }
            ?>
        </p>
        
        <form method="POST" action="">
            <table class="tbl-half">
                <tr>
                    <td>Liste Adı: </td>
                    <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required" /></td>
                </tr>
                <tr>
                    <td>Liste Açıklaması: </td>
                    <td>
                        <textarea name="list_description">
                            <?php echo $list_description; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td><input class="btn-lg btn-primary" type="submit" name="submit" value="GÜNCELLE" /></td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>

<?php 
    //Güncelleme'nin tıklanıp tıklanmadığının kontrol edilmesi
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        
        //Formdan güncellenmiş değerlerin alınması
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];
        
        //Veritabanı bağlantısı
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //Veritabanının seçilmesi
        $db_select2 = mysqli_select_db($conn2, DB_NAME);
        
        //Listenin güncellenmesi için gerekli SQL sorgusu
        $sql2 = "UPDATE tbl_lists SET 
            list_name = '$list_name',
            list_description = '$list_description' 
            WHERE list_id=$list_id
        ";
        
        //Sorgunun yürütülmesi
        $res2 = mysqli_query($conn2, $sql2);
        
        //Sorgunun başarılı şekilde yürütülüp yürütülmediğinin kontrol edilmesi
        if($res2==true)
        {
            //Güncelleme başarılıysa mesaj gönderilmesi
            $_SESSION['update'] = "Liste başarılı şekilde güncellendi.";
            
            //Yönetim Listesi sayfasına geri dönülmesi
            header('location:'.SITEURL.'manage-list.php');
        }
        else
        {
            //Güncellemenin başarısız olması durumunda mesaj gönderilmesi
            $_SESSION['update_fail'] = "Liste güncelleme işlemi başarısız oldu.";
            //Güncelleme Listesi sayfasına yönlendirilme
            header('location:'.SITEURL.'update-list.php?list_id='.$list_id);
        }    
    }
?>









































