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
        <a class="btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Listeleri Yönet</a>

        <h3>Liste Ekleme</h3>

        <p>
            <?php
                //Oturumun açılıp açılmamasının kontrolü
                if(isset($_SESSION['add_fail']))
            {
                //Oturum mesajının gösterilmesi
                echo $_SESSION['add_fail'];
                //Mesajın bir kez gösterildikten sonra kaldırılması 
                unset($_SESSION['add_fail']);
            }
            ?>
        </p>

        <!-- Listeye Ekleme formunun başlangıcı --> 
        <form action="" method="POST">
            <table class="tbl-half">
                <tr>
                    <td>Liste Adı: </td>
                    <td><input type="text" name="list_name" placeholder="Liste adını buraya yazınız." required="required"/></td>
                </tr>
                <tr>
                    <td>Liste Açıklaması: </td>
                    <td><textarea name="list_description" placeholder="Liste açıklamasını buraya yazınız."></textarea></td>
                </tr>
                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="KAYDET"></td>
                </tr>
            </table>
        </form>
        <!-- Listeye Ekleme formunun bitişi --> 
    </div>
    </body>
</html>

<?php
    //Formun gönderilip gönderilmediğinin kontrol edilmesi
    if(isset($_POST['submit']))
    {
        //Formdan değerlerin alınıp değişkenlere kaydedilmesi
        $list_name=$_POST['list_name'];
        $list_description=$_POST['list_description'];
        
        //Veritabanı bağlantısı
        $conn=mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //Veritabanının seçilmesi
        $db_select=mysqli_select_db($conn, DB_NAME);
        
        //Bilginin veritabanına girilmesini sağlayan SQL sorgusu
        $sql="INSERT INTO tbl_lists SET 
        list_name='$list_name',
        list_description='$list_description'
        ";

        //Sorgunun çalıştırılması ve veritabanına eklenmesi
        $res = mysqli_query($conn, $sql);

        //Sorgunun başarılı şekilde çalıştırılıp çalıştırılamamasının kontrolü
        if($res==true)
        {
            //Görüntülenecek bir oturum değişkeni oluşturma mesajı 
            $_SESSION['add'] = "Liste başarılı şekilde eklendi.";
            
            //Listeyi Yönet sayfasına yönlendirilme
            header('location:'.SITEURL.'manage-list.php');
            
            
        }
        else
        {
            //Mesajı kaydetmek için oturum oluşturma
            $_SESSION['add_fail'] = "Liste ekleme işlemi başarısız oldu.";
            
            //Aynı sayfaya yönlendirme
            header('location:'.SITEURL.'add-list.php');
        }
    }
    
?>