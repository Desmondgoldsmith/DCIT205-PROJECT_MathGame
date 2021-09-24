
<?php

include('logo.html');

include ('dbconnection.php');

    if(!isset($_POST['submit'])){
        header("location:../index.php?signupConfirm=Data Saved. Login ->");
         exit();
    }else{

        $r_username     =   isset($_POST['username'])?    $_POST['username']   :'';
        $r_password     =   isset($_POST['password'])?    $_POST['password']   :'';
        $r_confirm      =   isset($_POST['confirm'])?     $_POST['confirm']    :'';    
        $r_email        =   isset($_POST['email'])?       $_POST['email']      :'';
    


//CHECKING UNEXPECTED ELEMENTS IN FORM INPUT
    $c_username     =   ( $r_username);
    $c_password     =   preg_match("/^[a-zA-Z0-9]*$/", $r_password);
    $c_confirm      =   preg_match("/^[a-zA-Z0-9]*$/", $r_confirm);
    $c_email        =   preg_match("/^[a-zA-Z0-9\@\.]*$/", $r_email);

    //  FILTERING, SANITIZING AND VALIDATE ALL FORM INPUTS    
    
    $username       =   strtolower(filter_var($r_username,  FILTER_SANITIZE_STRING    ));  
    $password       =   filter_var($r_password,    FILTER_SANITIZE_STRING    );
    $confirm        =   filter_var($r_confirm ,    FILTER_SANITIZE_STRING    );
    $email          =   filter_var($r_email,       FILTER_VALIDATE_EMAIL     );
   

// ERROR HANDLERS    
    $errorEmpty     = false;
    $errorUsername  = false;
    $errorPassword  = false;
    $errorConfirm   = false;
    $errorEmail     = false;
   
    
    if(!$c_username){
        header("location:../index.php?signupConfirm=Invalid Username");
    }elseif(strlen($username) <6 && !empty($username)){
        header("location:../index.php?signupConfirm=Username must contain at least 6 characters");
    }elseif(!$c_password){
        header("location:../index.php?signupConfirm=Invalid Password");
    }elseif(strlen($password) <6 && !empty($password)){
        header("location:../index.php?signupConfirm=Password Too short");
    }elseif(!$c_confirm || $password!=$confirm){
        header("location:../index.php?signupConfirm=Passwords Do Not Match");
      }elseif(!$c_email){
        header("location:../index.php?signupConfirm=Invalid Email Address");
       }elseif(empty($username) || empty($password) || empty($confirm) || empty($email)){
        header("location:../index.php?signupConfirm=All Fields are Required");
     }else{
                    // CONNECTING TO DATABASE


        if ($conn){
         
            $data_select     = "SELECT username,email FROM mathgame_datatable
                                      WHERE
                                      username='$username' or email='$email'";
            
            $select         = mysqli_query($conn, $data_select);

            $result         = mysqli_num_rows($select);

                if ($result>=1){
                    
                    $s_username         =   "SELECT username FROM mathgame_datatable WHERE username='$username'";
                    $s_email            =   "SELECT email FROM mathgame_datatable WHERE email='$email'";

                    $r_username         =   mysqli_query($conn, $s_username);       
                    $r_email            =   mysqli_query($conn, $s_email);

                    $verify_user        =   mysqli_num_rows($r_username);
                     $verify_email       =   mysqli_num_rows($r_email);
 
                    if($verify_user>=1){
                        header("location:../index.php?signupConfirm=Username Already Exists");
                    }elseif($verify_email>=1){
                        header("location:../index.php?signupConfirm=Email Already Exists");
                    }
                    }else{
            
                                    $data_insert = "INSERT INTO mathgame_datatable(USERNAME, PASSWORD, EMAIL)
                                    VALUES(?, ?, ?)
                                    ";
                        
                                $insert      = mysqli_stmt_init($conn);

                                if(mysqli_stmt_prepare($insert, $data_insert)){
                                    $hashedPwd   = password_hash($password, PASSWORD_DEFAULT);
                                    mysqli_stmt_bind_param($insert, "sss", $username, $hashedPwd,$email);

                                    $run = mysqli_stmt_execute($insert);

                                    if($run){
                                        mysqli_close($conn);
                                       // echo ("<script>alert('Signup Successfull')</script>");
// echo("<script>alert('SIGN IN')</script>");
                                    header('Location: '.$_SERVER['PHP_SELF']);
                                    die;                                        
                                    }else{
                                        header("location:../index.php?signupConfirm=An unknown Error Occured");
                                     }
                        
                                }else{
                                    header("location:../index.php?signupConfirm=An unknown Error Occured");
                                }
                            }
                            }
                            }
                        }           
?>