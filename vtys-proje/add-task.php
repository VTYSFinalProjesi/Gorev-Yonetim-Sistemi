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
        <h3>Görev Ekleme</h3>
        <p>
            <?php 
            
                if(isset($_SESSION['add_fail']))
                {
                    echo $_SESSION['add_fail'];
                    unset($_SESSION['add_fail']);
                }
            
            ?>
        </p>
        <form method="POST" action="">
            <table class="tbl-half">
                <tr>
                    <td>Görev Adı: </td>
                    <td><input type="text" name="task_name" placeholder="Görev adını buraya yazınız." required="required" /></td>
                </tr>
                <tr>
                    <td>Görev Açıklaması: </td>
                    <td><textarea name="task_description" placeholder="Görev açıklamasını buraya yazınız."></textarea></td>
                </tr>
                <tr>
                    <td>Liste Seçme: </td>
                    <td>
                        <select name="list_id">
                            <option value="1">Yapılacak</option>
                            <option value="2">Yapılıyor</option>
                            <option value="3">Tamamlandı</option>
                            <?php 
                                
                                //Veritabanı bağlantısı
                                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                
                                //Veritabanının seçilmesi
                                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                                
                                //Listeleri veritabanından getiren SQL sorgusu
                                $sql = "SELECT * FROM tbl_lists";
                                
                                //Sorguların yürütülmesi
                                $res = mysqli_query($conn, $sql);
                                
                                //Sorguların yürütülüp yürütülmediğinin kontrol edilmesi
                                if($res==true)
                                {
                                    //Satır sayısı değişkeninin oluşturulması
                                    $count_rows = mysqli_num_rows($res);
                                    
                                    //Veritabanında veri varsa tüm verilerin görüntülenmesi, yoksa seçenek olarak yok görüntülenmesi
                                    if($count_rows>0)
                                    {
                                        //Tüm listelerin veritabanından açılan listede görüntülenmesi
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $list_id = $row['list_id'];
                                            $list_name = $row['list_name'];
                                            ?>
                                            <option value="<?php echo $list_id ?>"><?php echo $list_name; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //Hiçbiri'nin seçenek olarak gösterilmesi
                                        ?>
                                        <option value="0">Hiçbiri</option>p
                                        <?php
                                    }
                                }
                            ?>
                        
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Öncelik: </td>
                    <td>
                        <select name="priority">
                            <option value="Yüksek">Yüksek</option>
                            <option value="Orta">Orta</option>
                            <option value="Düşük">Düşük</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Bitiş Tarihi: </td>
                    <td><input type="date" name="deadline" /></td>
                </tr>
                <tr>
                    <td><input class="btn-primary" type="submit" name="submit" value="KAYDET" /></td>
                </tr>
            </table>
        </form>
        </div>
    </body>
</html>

<?php 

    //Kaydet butonuna tıklanıp tıklanmadığının kontrol edilmesi
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Formdaki tüm verilerin alınması
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];
        
        //Veritabanı bağlantısı
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //Veritabanının seçilmesi
        $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
        
        //Veritabanı eklemek için gerekli SQL sorgusu
        $sql2 = "INSERT INTO tbl_tasks SET 
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline'
        ";
        
        //Sorgunun yürütülmesi
        $res2 = mysqli_query($conn2, $sql2);
        
        //Sorgunun başarılı şekilde yürütülüp yürütülmediğinin kontrol edilmesi
        if($res2==true)
        {
            //Sorgunun başarılı şekilde yürütülmesi ve görevin eklenmesi
            $_SESSION['add'] = "Görev başarılı şekilde eklendi.";
            
            //Ana sayfaya yönlendirilme
            header('location:'.SITEURL.'login.php');
            
        }
        else
        {
            //Görev ekleme işleminin başarısız olması
            $_SESSION['add_fail'] = "Görev ekleme işlemi başarısız oldu.";
            //Görev Ekleme sayfasına yönlendirilme
            header('location:'.SITEURL.'add-task.php');
        }
    }

?>