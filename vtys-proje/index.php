<?php
    include('config/constants.php');
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/style2.css" />
    <title>Giriş Sayfası</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
         
        <form method="POST" class="sign-in-form">
            <h2 class="title">Giriş Yap</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="user_name" placeholder="Kullanıcı Adı" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="user_password" placeholder="Şifre" />
            </div>
            <input type="submit" name="login" value="GİRİŞ YAP" class="btn solid" />
            <p class="social-text"></p>
          </form>


          <?php
            if(isset($_POST['login']))
            { 

              $user_name2=$_POST['user_name'];
              $user_password2=$_POST['user_password'];

              //Veritabanı bağlantısı
              $conn2=mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

              //Veritabanının seçilmesi
              $db_select2=mysqli_select_db($conn2, DB_NAME);
              
              $sql2=mysqli_query($conn2, "SELECT * FROM tbl_users WHERE user_name = '$user_name2' AND user_password = '$user_password2' ");

              $row=mysqli_fetch_array($sql2);

              if(is_array($row))
              {
                $_SESSION["user_name"] = $row["user_name"];
                $_SESSION["user_password"] = $row["user_password"];

                if(isset($_SESSION["user_name"]))
                {
                  header("location:login.php");
                }
              }
              else
              {
                echo '<script type="text/javascript">';
                echo 'alert("Geçersiz kullanıcı adı veya şifre.");';
                echo 'window.location.href = "index.php"';
                echo '</script>';
              }
            }
            
        ?>



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

          <form class="sign-up-form" method="POST">
            <h2 class="title">Kayıt Ol</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="user_name" placeholder="Kullanıcı Adı" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="user_mail" placeholder="E-Mail" />
            </div>
            <div class="input-field">
              <i class="far fa-id-card"></i>
              <input type="int" name="user_age" placeholder="Kullanıcı Yaşı" />
            </div>
            <div class="input-field">
              <i class="fas fa-map-marker-alt"></i>
              <input type="text" name="user_city" placeholder="Şehir" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="user_password" placeholder="Şifre" />
            </div>
            <input type="submit" class="btn" name="submit" value="KAYDOL" />
            <p class="social-text">Üye değilseniz kaydolmanız gerekmektedir.</p>
          </form>
        
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Hoşgeldiniz</h3>
            <p>
               Hesabınız yok ise kaydolun ve giriş yapın.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              KAYDOL
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            
            <p>
              Hesap oluşturduysanız siteye giriş yapabilirsiniz.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              GİRİŞ YAP
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>

<?php
    //Formun gönderilip gönderilmediğinin kontrol edilmesi
    if(isset($_POST['submit']))
    {
        //Formdan değerlerin alınıp değişkenlere kaydedilmesi
        $user_name=$_POST['user_name'];
        $user_mail=$_POST['user_mail'];
        $user_age=$_POST['user_age'];
        $user_city=$_POST['user_city'];
        $user_password=$_POST['user_password'];
        
        //Veritabanı bağlantısı
        $conn=mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //Veritabanının seçilmesi
        $db_select=mysqli_select_db($conn, DB_NAME);
        
        //Bilginin veritabanına girilmesini sağlayan SQL sorgusu
        $sql="INSERT INTO tbl_users SET 
        user_name='$user_name',
        user_mail='$user_mail',
        user_age='$user_age',
        user_city='$user_city',
        user_password='$user_password'
        ";

        //Sorgunun çalıştırılması ve veritabanına eklenmesi
        $res = mysqli_query($conn, $sql);

        //Sorgunun başarılı şekilde çalıştırılıp çalıştırılamamasının kontrolü
        if($res==true)
        {   
        //Giriş yapmak için aynı sayfaya yönlendirilme
        echo '<div class="alert alert-success">Kaydınız başarılı şekilde gerçekleştirildi.</div>';
          
        }
        else
        {   
        //Aynı sayfaya yönlendirme
        echo '<div class="alert alert-danger">Kayıt işlemi başarısız oldu.</div>';
        }
      }
    
    
?>

