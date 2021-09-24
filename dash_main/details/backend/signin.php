<?php
 session_start();

include ('dbconnection.php');

    $r_username     =   isset($_POST['username'])?    $_POST['username']   :''; 
    $r_password     =   isset($_POST['password'])?    $_POST['password']   :'';

    $c_username     =   $r_username;
    $username       =   filter_var($r_username,  FILTER_SANITIZE_STRING    );  
    $c_password     =   preg_match("/^[a-zA-Z0-9]*$/", $r_password);
    $password       =   filter_var($r_password,    FILTER_SANITIZE_STRING    );


    // CONNECTING TO MAIN DATABASE
    if(!$c_username){
        echo ("<script>alert('Invalid Username')</script>");
        exit();
    }elseif(!$c_password){
        echo ("<script>alert('Invalid Password')</script>");
        exit();
    }else if(empty($username)){
        echo ("<script>alert('Username Field Required')</script>");
        exit();
    }else if(empty($password)){
        echo ("<script>alert('Password Required')</script>");
        exit();
    }else{

    


        if(!$conn){
            echo ("<script>alert('Database Error')</script>");
            exit();
        }else{
            $select_data    = "SELECT * FROM mathgame_datatable WHERE username=?";

            $login          = mysqli_stmt_init($conn);

            $prepare        = mysqli_stmt_prepare($login, $select_data);

            if(!$prepare){
                echo ("<script>alert('Database Error')</script>");
                exit();   
            }else{
                mysqli_stmt_bind_param($login, "s", $username);
                $run    = mysqli_stmt_execute($login);
                if(!$run){
                    echo ("<script>alert('Database Error')</script>");
                    exit();
                }else{
 
                    $row    = mysqli_stmt_num_rows($login);

                    $data   = mysqli_stmt_get_result($login);
                    
                    $result = mysqli_fetch_assoc($data);

                if(!$result){
                    echo ("<script>alert('Username Does Not Exist')</script>");
                    header("location:wrongUserName.html");                    
                    exit();
                }else{
                  $unhash = password_verify($password, $result['password']);

                  if($unhash==false){
                    echo ("<script>alert('Wrong Password')</script>");
                    header("location:wrongpassword.html");
                     exit();
                  }else if($unhash==true){

                        mysqli_close($conn);
                        // echo ("<script>alert('User Authenticated')</script>");
                   $_SESSION['name'] = $c_username;
                        header("location:../../template/indexx.php");
                        }
                    }  
                }
            }
        }
    }