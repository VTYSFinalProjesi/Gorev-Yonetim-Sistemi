<?php 
    include('config/constants.php');
    
    //list_id_url'in alınması
    $list_id_url = $_GET['list_id'];
?>

<html>
    <head>
        <title>Görev Yöneticisi</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
    </head>
    <body>
        <div class="wrapper">
        <h1>GÖREV YÖNETİCİSİ</h1>
        
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
        </div>
        <!-- Menü'nün bitişi -->
        <a class="btn-primary" href="<?php echo SITEURL; ?>add-task.php">Görev Ekle</a>
        <br>
        <div class="all-task">
            
            <table class="tbl-full">
                <tr>
                    <th>NO</th>
                    <th>Görev Adı</th>
                    <th>Öncelik</th>
                    <th>Bitiş Tarihi</th>
                    <th>Seçenekler</th>
                </tr>
                
                <?php 
                
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                    
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                    
                    //Görevlerin seçilen listeye göre görüntülenmesi için gerekli SQL sorgusu
                    $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";
                    
                    //Sorgunun yürütülmesi
                    $res = mysqli_query($conn, $sql);
                    
                    if($res==true)
                    {
                        //Listeye göre görevlerin görüntülenmesi
                        //Satır sayısı değişkeni
                        $count_rows = mysqli_num_rows($res);
                        
                        if($count_rows>0)
                        {
                            //Listede görevler varsa
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $task_id = $row['task_id'];
                                $task_name = $row['task_name'];
                                $priority = $row['priority'];
                                $deadline = $row['deadline'];
                                ?>
                                
                                <tr>
                                    <td>1. </td>
                                    <td><?php echo $task_name; ?></td>
                                    <td><?php echo $priority; ?></td>
                                    <td><?php echo $deadline; ?></td>
                                    <td>
                                        <a class="btn-primary" href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Güncelle</a>
                                        <a class="btn-primary" href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Sil</a>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                        }
                        else
                        {
                            //Listede görevler yoksa
                            ?>
                            
                            <tr>
                                <td colspan="5">Listeye henüz görev eklenmedi.</td>
                            </tr>
                            
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
        </div>
    </body>
</html>