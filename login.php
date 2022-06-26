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
    <title>Login</title>
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>
    <div id="back"></div>
    <div id="body">
        <div id="content">
            <p>Вход</p>
            <form action="login.php" method="POST">
            		<form method="post" action="" name="signup-form">
            			<div class="name1">Логин</div>
                <input type="text" name="login" placeholder="Введите логин">
                <div class="name2">Пароль</div>
                <input type="password" name="pass" placeholder="Введите пароль">
                <input type="submit" name="sub">
            </form>
             <footer>
© 2022 <ahref=>PlayGames</a>. 

</footer>
        </div>
    </div>
</body>

</html>
<?php
    if(isset($_REQUEST['sub'])){
        $login=$_REQUEST['login'];
        $pass=$_REQUEST['pass'];
        if(!empty($login) and !empty($pass)){
            $query="SELECT login FROM users WHERE login = '$login'";
            $result=mysqli_query($link,$query) or die(mysqli_error($link));
            $log = mysqli_fetch_assoc($result);
            if($log != null){
                $query="SELECT login FROM users WHERE password = '$pass'";
                $result=mysqli_query($link,$query) or die(mysqli_error($link));
                $password = mysqli_fetch_assoc($result);
                if($password != null){
                    $_SESSION['islogin'] = true;
                    $_SESSION['login'] = $login;
                    if($login=='admin'){
                        $_SESSION['isadmin'] = true;
                    } else{
                        $_SESSION['isadmin'] = false;
                    }
                    $qeuryID = "SELECT id FROM users WHERE login='$login'";
                    $results = mysqli_query($link, $qeuryID) or die(mysqli_error($link));
                    $ids=mysqli_fetch_assoc($results);
                    foreach($ids as $key => $id){
                        $_SESSION['id'] = $id;
                    }
                    echo "<script>window.location.replace('http://localhost/');</script>";
                    
                } else{
                    echo "<script>alert('Неправильный пароль')</script>"; 
                }
            } else{
                echo "<script>alert('Такого логина не существует')</script>";
            }
        } else{
            echo "<script>alert('Вы не ввели все данные')</script>";
        }
    }
?>