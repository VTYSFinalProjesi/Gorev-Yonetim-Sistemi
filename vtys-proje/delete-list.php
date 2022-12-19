<?php
    include('config/constants.php');
    //echo "Delete List Page";
    
    //list_id'nin tanımlanıp tanımlanmadığının kontrol edilmesi
    if(isset($_GET['list_id']))
    {
        //list_id değerinin alınması
        $list_id = $_GET['list_id'];
        
        //Veritabanı bağlantısı
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        
        //Veritabanının seçilmesi
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        
        //Veritabanındaki listeleri silme SQL sorgusu
        $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";
        
        //Sorgunun yürütülmesi
        $res = mysqli_query($conn, $sql);
        
        //Sorgunun başarılı şekilde yürütülüp yürütülmediğinin kontrol edilmesi
        if($res==true)
        {
            //Sorgu başarılı şekilde yürütüldü (Liste silindi)
            $_SESSION['delete'] = "Liste başarılı şekilde silindi.";
            
            //Listeyi Yönet sayfasına yönlendirilme
            header('location:'.SITEURL.'manage-list.php');
        }
        else
        {
            //Liste silme işleminin başarısız olması 
            $_SESSION['delete_fail'] = "Liste silme işlemi başarısız oldu.s";
            header('location:'.SITEURL.'manage-list.php');
        }
    }
    else
    {
        //Listeyi Yönet sayfasına yönlendirilme
        header('location:'.SITEURL.'manage-list.php');
    }
?>