<?php 

    include('config/constants.php');
    
    //task_id'nin kontrol edilmesi
    if(isset($_GET['task_id']))
    {
        //Veritabanındaki görevin silinmesi
        //task_id'nin alınması
        $task_id = $_GET['task_id'];
        
        //Veritabanı bağlantısı
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //Veritabanının seçilmesi
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        
        //Görevlerin silinmesi için gerekli SQL sorgusu
        $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id";
        
        //Sorgunun yürütülmesi
        $res = mysqli_query($conn, $sql);
        
        //Sorgu yürütülüp yürütülememe kontrolü
        if($res==true)
        {
            //Sorgunun başarılı şekilde yürütülmesi ve görevin silinmesi
            $_SESSION['delete'] = "Görev başarılı şekilde silindi.";
            
            //Ana sayfaya yönlendirilme
            header('location:'.SITEURL.'login.php');
        }
        else
        {
            //Görev silme işleminin başarısız olması 
            $_SESSION['delete_fail'] = "Görev silme işlemi başarısız oldu.";
            
            //Ana sayfaya yönlendirilme
            header('location:'.SITEURL.'login.php');
        }
        
    }
    else
    {
        //Ana sayfaya yönlendirilme
        header('location:'.SITEURL.'login.php');
    }

?>