<?php
    session_start();
    require '../connection/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>

<!-- <style>
    .main{
        height: 100vh;
    }
    
    .login-box{
        width: 500px;
        height: 400px;
        box-sizing: border-box;
        border-radius: 30px ;
    }
</style> -->

<body>
        <div class="main d-flex flex-column justify-content-center align-items-center">
            <div class="wrapper">
                <div class="login-box">
                    <h2>Login</h2>
                    <form action="" method="post">
                        <div class="input-box">
                            <span class="icon"><ion-icon name="mail"></ion-icon></span>
                            <input type="text" class="" name="username" id="username">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-box">
                            <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                            <input type="password" class="" name="password" id="password">
                            <label for="password">Password</label>
                        </div>
                        <div>
                            <button class="btn mt-3" type="submit" name="loginbtn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="mt-3" style="width: 500px justify-content-center">
                <?php
                    if(isset($_POST['loginbtn'])){
                        $username = htmlspecialchars($_POST['username']);
                        $password = htmlspecialchars($_POST['password']);

                        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username' ");
                        $countdata = mysqli_num_rows($query);
                        $data = mysqli_fetch_array($query);
                        
                        if($countdata>0){
                            if (password_verify($password, $data['password'])){
                                $_SESSION['username'] = $data['username'];
                                $_SESSION['login'] = true;
                                header('location: index.php');
                            }
                            else{
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    PASSWORD SALAH
                                </div>
                                <?php
                            }
                        }   
                        else{
                            ?>
                            <div class="alert alert-warning" role="alert">
                            TIDAK ADA AKUNNYA MASBRO!
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
