<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUP To Math Game</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="https://i.pinimg.com/564x/8d/2d/1c/8d2d1c5e0ee9e5141f1fc51567dba572.jpg" type=" image/x-icon " />

</head>

<body>
    <div class="register">
        <div class="register__main">
            <div class="register__image">
                <img src="./bg.jpg" alt="picture">
            </div>
            <div class="registration">
                <div class="head">
                    <div class="sign__up" >
                        Sign Up
                    </div>
                    <div class="sign__in">
                        Sign In
                    </div>
                </div>
                <div class="sign">
                    <div class="form">
                        <form method="POST" action="backend/signup.php" class="form__sign__up" >
                            
                            
                            <div class="form__div">
                                    <span  class="data_error">
                                        <?php
                                            if(isset($_GET['signupConfirm'])){
                                                $message = $_GET['signupConfirm'];
                                                echo $message;
                                             }
                                        ?>
                                    </span>
                                    <label for="name">
                                        Username
                                    </label>
                                    <input type="text" name="username" require>
                                </div>
                                <div class="form__div">
                                    <label for="email">
                                        Email
                                    </label>
                                    <input type="email" name="email" require>
                                </div>
                                <div class="form__div">
                                    <label for="password">
                                        Password
                                    </label>
                                    <input type="password" name="password" require>
                                </div>
                                <div class="form__div">
                                    <label for="confirm password">
                                        Confirm Password
                                    </label>
                                    <input type="password" name="confirm" require>
                                </div>
                            <div class="form__btn">
                                <button type="submit" name="submit">
                                    sign up
                                </button>
                            </div>
                        </form>
                        <form method="POST" action="backend/signin.php" class="form__sign__in" >
                                <div class="form__div">
                                <span  class="data_error">
                                        <?php
                                            if(isset($_GET['loginErr'])){
                                                $message = $_GET['loginErr'];
                                                echo $message;
                                             }
                                        ?>
                                    </span>
                                    <label for="username">
                                        Username
                                    </label>
                                    <input type="username" name="username">
                                </div>
                                <div class="form__div">
                                    <label for="password">
                                        Password
                                    </label>
                                    <input type="password" name="password">
                                </div>
                            <div class="form__btn">
                                <button>
                                    sign in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="script.js" >
    


</script>

</html>