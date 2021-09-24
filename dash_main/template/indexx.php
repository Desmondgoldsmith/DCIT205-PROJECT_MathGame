<!-- DEVELOPED BY DCIT205 GROUP17 MEMBERS -->
<!-- DATE COMPLETED : 13/06/21 -->

<?php
session_start();
include '../DB_Engine/DBconfig.php';
$sql = "SELECT * FROM mathgame_datatable";
$rank = "SELECT * FROM ranking ORDER BY score DESC";
?>
<!DOCTYPE html>
<html lang="en">
<head> 
       <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Math Game</title>
    <!-- js and jquery plugins -->
    <script type="text/javascript" src="../jquery/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"> </script>
    <script type="text/javascript">
     $(document).ready( function () {
    $.noConflict();
    var table = $('#table_e').DataTable({"search":false,
        "ordering": false,
        "info":     true,
        "scrollY": true,
        "scroller":    true,
        "scrollY":        "250px",
        "scrollCollapse": true,
        "paging":true,
        bFilter: false, 
        bInfo: false,
        "bLengthChange": false,
        // "autoWidth": true,    
       
    });
} );


// loader animation
$(document).ready( function(){
var count = 0;
var a = 0;
var b= setInterval(function(){
    $(".loader .rate .counted").html(a);
    $(".loader").css("width",a + "%");
    count++;
    a++;
    if(count==101){
        clearInterval(b);
        $(".loader").css("display","none");
    }
},30);
});

</script>


    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="styleee.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="https://i.pinimg.com/564x/8d/2d/1c/8d2d1c5e0ee9e5141f1fc51567dba572.jpg" />

    <style>
    .container {
    /* position: relative;  */
    width: 1000px;
    height: 1100px;
    overflow-y: hidden; 
    overflow-x: hidden; 
}
.picx {
    
    width: 700px;
    height: 500px;

}
.game { 
   
    width: 800px;
    height: 2000px;
   padding-bottom: 30px;
    /* overflow-y: unset; 
    overflow-x: unset; 
    width:unset; */
}
.reg_users{
    width: 200px;
    height: 600px;
    color:pink;
   
}
*{
   margin: 0;
    padding: 0;
     overflow-y: hidden; 
     overflow-x: hidden;  
    /* overflow-x: hidden; */
}

.rank{
    width: 700px;
    height: 1000px;
    /* overflow-y: hidden;  */
     overflow-x: hidden;  
color:black;
    }
#sidebar{
    overflow-y: hidden; 
     overflow-x: hidden;  
}

</style>

</head>

<body>
    <div class="loader">
    <div class="rate">
        <h1><span class= "counted">0</span>%</h1>
        </div>
    </div>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <h3>MATH GAME</h3>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle " src="../template/assets/images/faces-clipart\pic-1.png" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"><?php $name = $_SESSION['name'] ; echo $name; $_SESSION['username']= $name ?></h5>
                                <span>user</span>
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class=""></i></a>
                        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                        
                            <div class="dropdown-divider"></div>
                            <!-- end change password -->
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#picx">
                        <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <!-- game menu -->
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#game">
                        <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
                        <span class="menu-title">Game Menu</span>
                    </a>
                </li>
                <!-- end -->
                <!-- reg user -->
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#reg_users">
                        <span class="menu-icon">
                <i class="mdi mdi-account-circle"></i>
              </span>
                        <span class="menu-title">Registered Users</span>
                    </a>
                </li>
                <!-- end reg -->
                <!-- ranking -->
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#rank">
                        <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
                        <span class="menu-title">Ranking</span>
                    </a>
                </li>
                <!-- end ranking -->
            <!--  logout -->
                <li class="nav-item menu-items" id="logout">
                    <a class="nav-link" href="../details/index.php" >
                        <span class="menu-icon" >
                        <i class="mdi mdi-logout text-danger"></i>
              </span>
                        <span class="menu-title">Logout</span>
                    </a>
                </li>
            </ul>
            <!-- end logout -->
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>

                    <!-- right side [profie & logout]-->
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#picx" >
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="../template/assets/images/faces-clipart\pic-1.png" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php $show__name = $_SESSION['name']; echo $show__name;?> </p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu ">
                                <h6 class="p-3 mb-0">Profile</h6>
                                <div class="dropdown-divider"></div>
                                <!-- logout -->
                                <div class="dropdown-divider"></div>
                               
                                <div class="dropdown-divider"></div>
                            </div>
                            <!-- /logout -->
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
                </div>
            </nav>
            <!-- partial -->
       <br><br><br><br>
       <div class="container">
    <div class="picx">
    <section id="picx">
    <img src="https://image.freepik.com/free-vector/vector-illustration-math-game-preschool-school-age-children-count-insert-correct-numbers-addition-house-with-windows_74237-135.jpg" alt="">
    </section>
<!-- </div> -->
    
    <div class="game">
    <section id="game">
            <div id="container">
    
        
<?php 
        $score="score";
        $result = "<div id=$score>";
        echo $result;
        // $get = "scorevalue";
             
        $sv = "scorevalue";
        $resultx = "<span id=$sv>0</span>";
        echo $resultx;
        $_SESSION['getresult'] = $resultx;

        echo "</div>";
        ?>
        <div id="correct">
            Correct
        </div>
        <div id="wrong">
            Try again
        </div>
        <div id="question">

        </div>
        <div id="instruction">
            Click on the correct answer
        </div>
        <div id="choices">
            <div id="box1" class="box"></div>
            <div id="box2" class="box"></div>
            <div id="box3" class="box"></div>
            <div id="box4" class="box"></div>
        </div>
  <!-- form to get score and username to store in database -->
        <form action="indexx.php" method="get">
            <input type="text" name="score" id="getit"></input>
            <input type="text" name="name" id="namex" value="<?php echo $_SESSION['username'];?>">
<input type="submit" id="submit" aria-colindex=""name="submit" value="END GAME">
</form>
<?php
  if (isset($_GET['submit'])) {
      $truscore= $_GET['score'];
      $uname =$_SESSION['username'];
      if ($conn->connect_error) {
          die('An Error Occured:'.$conn->connect);
      }
   
      $InsertScoreData = "INSERT INTO ranking(`username`, `score`) VALUES('$uname','$truscore')";
      if (mysqli_query($conn, $InsertScoreData)) {
          echo"";//echo nothing
        
    } else {
          echo "Error: " . $InsertScoreData  . mysqli_error($conn);
      }
  }
$conn->close();

?>
<!-- //form to get score and username to store in database -->
<!-- button to start game -->
<div id="startreset">
            Start Game
        </div>
        <!-- //button to start game -->
        <!-- time remaining -->
        <div id="timeremaining">
            Time remaining: <span id="timeremainingvalue">60</span> sec
        </div>
        <div id="gameOver">
        </div>
    </div>
     <script src="Action.js"></script>
    </div>
<!-- registerd users -->
    <div class="reg_users" style="color:white">
      <section id="reg_users">
      <?php
     $link = mysqli_connect("localhost","root","","mathgame");
       
      // Check connection
      if($link === false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }
       echo "<br><br><br>";
       
      // Attempt select query execution
      if($result = mysqli_query($link, $sql)){
          if(mysqli_num_rows($result) >= 0){
              echo "<table  class='table table-dark' style=' color:pink;'>";
                  echo " <thead>
                  <tr> ";
                    echo "<th scope='col'>ID</th>";
                  echo "<th scope='col'>USERNAME</th>";
                  echo " </tr>
                  </thead>";
                  
              while($row = mysqli_fetch_array($result)){
                  echo " <tbody>
                  <tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['username'] . "</td>";
                
                }
                echo " </tbody>
                  </tr>";
              echo "</table>";
              // Free result set
              mysqli_free_result($result);
          } else{
              echo "No records matching your query were found.";
          }
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
       
      // Close connection
      mysqli_close($link);
      ?>
      </section>
</div>
<!-- //reg users -->        
<div class="rank">
     
  <section id="rank">
  <?php
        $link = mysqli_connect("localhost","root","","mathgame");
       
      // Check connection
      if($link === false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }
       echo "<br><br><br>
       ";
      
      if($result = mysqli_query($link, $rank)){
          if(mysqli_num_rows($result) >= 0){
              echo "<table id='table_e' style='background-color:#232727f8;' class='table table-dark'>";
                  echo " <thead>
                  <tr> ";
                    echo "<th scope='col' style='color:white '>ID</th>";
                  echo "<th scope='col' style='color:white '>USERNAME</th>";
                      echo "<th style='color:white '>SCORE</th>";
                      echo " </tr>
                      </thead>";  
              while($row = mysqli_fetch_array($result)){
                  echo " <tbody>
                  <tr>";
                  echo "<td>" . $row['id'] . "</td>";
                
                  echo "<td>" . $row['username'] . "</td>";
                
                  echo "<td>" . $row['score'] . "</td>";
                
                

                }
                echo " </tbody>
                  </tr>";
              echo "</table>";
              // Free result set
              mysqli_free_result($result);
          } else{
              echo "No records matching your query were found.";
          }
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
       
      // Close connection
      mysqli_close($link);
      ?>
      </section>
  </div>

</div>
<!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>
</html>