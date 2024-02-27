<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kütüphane Giriş Sistemi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        <h2>Kütüphane Giriş Sistemi</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="user_type">Giriş Türü:</label>
                <select id="user_type" name="user_type" required>
                    <option value="admin">Yönetici</option>
                    <option value="user">Üye</option>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Giriş Yap</button>
        </form>
    </div>
    <?php
// Veritabanı bağlantısı
$servername = "localhost";
$user = "root";
$pw = "";
$dbname = "library";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $user, $pw, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) 
{
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Kullanıcıyı doğrula
if (isset($_POST["user_type"],$_POST["username"],$_POST["password"]))
    {        
        // Kullanıcı giriş bilgilerini al
        $user_type = $_POST['user_type'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($user_type == 'user') 
        {            
            $sql = "SELECT * FROM users WHERE username='$user' AND passwor='$pw'";
            $result = $conn->query($sql);
            // Üye olarak giriş yapıldı, üye sayfasına yönlendir
            header('Location: user_home.php');
        } 
        elseif ($user_type === 'admin') 
        {
            $sql = "SELECT * FROM admins WHERE username='$user' AND passwor='$pw'";
            $result = $conn->query($sql);
            // Yönetici olarak giriş yapıldı, yönetici sayfasına yönlendir
            header('Location: admin_home.php');
        } 
        else {
            // Geçersiz kullanıcı türü
            header('Location: index.html');
        }
    }
?>
</body>
</html>