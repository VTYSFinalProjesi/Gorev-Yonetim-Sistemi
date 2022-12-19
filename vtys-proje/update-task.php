<?php 
    include('config/constants.php');
    
    //task_id'nin kontrolü
    if(isset($_GET['task_id']))
    {
        //Veritabanından verilerin alınması
        $task_id = $_GET['task_id'];
        
        //Veritabanı bağlantısı
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //Veritabanının seçilmesi
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        
        //Görevin seçilmesi için gereken SQL sorgusu
        $sql = "SELECT * FROM tbl_tasks WHERE task_id=$task_id";
        
        //Sorgunun yürütülmesi
        $res = mysqli_query($conn, $sql);
        
        //Sorgunun başarılı şekilde yürütülüp yürütülememesi kontrolü
        if($res==true)
        {
            $row = mysqli_fetch_assoc($res);
            
            //Değerlerin atanması
            $task_name = $row['task_name'];
            $task_description = $row['task_description'];
            $list_id = $row['list_id'];
            $priority = $row['priority'];
            $deadline = $row['deadline'];
        }
    }
    else
    {
        //Ana sayfaya yönlendirilme
        header('location:'.SITEURL);
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
        
        <p>
            <a class="btn-secondary" href="<?php echo SITEURL; ?>login.php">Ana Sayfa</a>
        </p>
        
        <h3>Görev Güncelleme</h3>
        
        <p>
            <?php 
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
                    <td>Görev Adı: </td>
                    <td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required" /></td>
                </tr>
                
                <tr>
                    <td>Görev Açıklaması: </td>
                    <td>
                        <textarea name="task_description">
                        <?php echo $task_description; ?>
                        </textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Liste Seçme: </td>
                    <td>
                        <select name="list_id">
                            
                            <?php 
                                //Veritabanı bağlantısı
                                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                
                                //Veritabanının seçilmesi
                                $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                                
                                //Listelerin alınması için gereken SQL sorgusu
                                $sql2 = "SELECT * FROM tbl_lists";
                                
                                //Sorgunun yürütülmesi
                                $res2 = mysqli_query($conn2, $sql2);
                                
                                //Sorgunun başarılı şekilde yürütülüp yürütülememesi kontrolü
                                if($res2==true)
                                {
                                    //Listelerin görüntülenmesi
                                    //Satır sayısı değişkeni 
                                    $count_rows2 = mysqli_num_rows($res2);
                                    
                                    //Listenin eklenip eklenmediğinin kontrol edilmesi
                                    if($count_rows2>0)
                                    {
                                        //Listelerin eklenmesi
                                        while($row2=mysqli_fetch_assoc($res2))
                                        {
                                            //Değerlerin atanması
                                            $list_id_db = $row2['list_id'];
                                            $list_name = $row2['list_name'];
                                            ?>
                                            
                                            <option <?php if($list_id_db==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                                            
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //Listelerin eklenememesi
                                        //Hiçbiri seçeneğinin görüntülenmesi
                                        ?>
                                        <option <?php if($list_id=0){echo "selected='selected'";} ?> value="0">Hiçbiri</option>p
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
                            <option <?php if($priority=="Yüksek"){echo "selected='selected'";} ?> value="Yüksek">Yüksek</option>
                            <option <?php if($priority=="Orta"){echo "selected='selected'";} ?> value="Orta">Orta</option>
                            <option <?php if($priority=="Düşük"){echo "selected='selected'";} ?> value="Düşük">Düşük</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>Bitiş Tarihi: </td>
                    <td><input type="date" name="deadline" value="<?php echo $deadline; ?>" /></td>
                </tr>
                
                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value="GÜNCELLE" /></td>
                </tr>
                
            </table>
        
        </form>
        </div>
    </body>
</html>


<?php 

    //Buton tıklanma kontrolü
    if(isset($_POST['submit']))
    {
        //echo "Clicked";
        
        //Değerlerin formdan alınması
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];
        
        //Veritabanı bağlantısı
        $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //Veritabanının seçilmesi
        $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());
        
        //Görevlerin güncellenmesi için gerekli SQL sorgusu
        $sql3 = "UPDATE tbl_tasks SET 
        task_name = '$task_name',
        task_description = '$task_description',
        list_id = '$list_id',
        priority = '$priority',
        deadline = '$deadline'
        WHERE 
        task_id = $task_id
        ";
        
        //Sorgunun yürütülmesi
        $res3 = mysqli_query($conn3, $sql3);
        
        //Sorgunun yürütülüp yürütülememe kontrolü
        if($res3==true)
        {
            //Sorgunun başarılı şekilde yürütülmesi ve görevlerin güncellenmesi
            $_SESSION['update'] = "Görev başarılı şekilde güncellendi.";
            
            //Ana sayfaya yönlendirilme
            header('location:'.SITEURL.'login.php');
        }
        else
        {
            //Görevlerin güncellenmesinin başarısız olması
            $_SESSION['update_fail'] = "Görev güncelleme işlemi başarısız oldu.";
            
            header('location:'.SITEURL.'update-task.php?task_id='.$task_id);
        }
        
        
    }

?>









































