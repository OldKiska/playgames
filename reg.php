<?php
    session_start();
    include 'connect_db.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style1.css">
</head>


 

        <div id="content">
            <p>Регистрация</p>
            <form action="reg.php" method="POST">
            	<form method="post" action="" name="signup-form">
            	<div class="name1">ФИО</div>
                <input type="text" name="FIO" placeholder="Введите ФИО">
                <div class="name2">Логин</div>
                <input type="text" name="login" placeholder="Введите логин">
                <div class="name3">Email</div>
                <input type="email" name="email" placeholder="Введите email">
                <div class="name4">Пароль</div>
                <input type="password" name="pass1" placeholder="Введите пароль">
                <div class="name5">Повторить пароль</div>
                <input type="password" name="pass2" placeholder="Введите пароль повтороно">
                <label id="check">
                    <input type="checkbox" checked>
                    <span>Я подврждаю обратку своих персональных данных</span>
                </label>
                <input type="submit" name="sub">
            </form>
            <footer>
© 2022 <ahref=>PlayGames</a>. 

</footer>

        </div>
    </div>
    <script src="../js/reg.js"></script>
</body>

</html>
<?php
    if(isset($_REQUEST['sub'])){
        $FIO = $_REQUEST['FIO'];
        $login = $_REQUEST['login'];
        $email = $_REQUEST['email'];
        $pass1 = $_REQUEST['pass1'];
        $pass2 = $_REQUEST['pass2'];
        if(!empty($FIO) and !empty($login) and !empty($email) and !empty($pass1) and !empty($pass2)){
            if($pass1==$pass2){
                $query="SELECT FIO FROM users WHERE FIO='$FIO'";
                $result=mysqli_query($link, $query) or die(mysqli_error($link));
                $user=mysqli_fetch_assoc($result);
                if($user == null){
                    $query="SELECT login FROM users WHERE login='$login'";
                    $result=mysqli_query($link, $query) or die(mysqli_error($link));
                    $user=mysqli_fetch_assoc($result);
                    if($user == null){
                        $query="SELECT email FROM users WHERE email='$email'";
                        $result=mysqli_query($link, $query) or die(mysqli_error($link));
                        $user=mysqli_fetch_assoc($result);
                        if($user == null){
                            $query="INSERT INTO users(FIO, login, email, password) VALUES ('$FIO', '$login', '$email', '$pass1')";
                            $result=mysqli_query($link, $query) or die(mysqli_error($link));
                            $_SESSION['islogin'] = true;
                            $_SESSION['login'] = $login;    
                            $qeuryID = "SELECT id FROM users WHERE login='$login'";
                            $results = mysqli_query($link, $qeuryID) or die(mysqli_error($link));
                            $ids=mysqli_fetch_assoc($results);
                            foreach($ids as $key => $id){
                                $_SESSION['id'] = $id;
                            }
                          
                        } else{
                            echo '<script>alert("Аккаунт с таким email уже существует")</script>';
                        }
                    } else{
                        echo '<script>alert("Аккаунт с таким логином уже существует")</script>';
                    }
                } else{
                    echo '<script>alert("Аккаунт с таким ФИО уже существует")</script>';
                }
            } else{
                echo '<script>alert("Пароли не совпадают")</script>';
            }
        } else{
            echo '<script>alert("Вы не заполнили все данные")</script>';
        }
    }
?>