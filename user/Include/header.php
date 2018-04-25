<!--Header Start -->
<?php
         $pName=basename($_SERVER['PHP_SELF']);
        $uid=15;
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>User Panel</title>

        <link rel='stylesheet' href='../admin/css/styles.css'>
        <link rel="stylesheet" href="../src/fa/css/font-awesome.css">
        <script>
            window.addEventListener('resize',function(){
                
                if(window.innerWidth>900)
                {
                    
                    document.getElementById("navmain").style="";
                    
                    
                }
                if(window.innerWidth<900)
                {
                    document.getElementById("nav-column").style='';
                    document.getElementById("navmain").classList='nav-list';
                }
                
                
            })
            function hideNav()
            {
                var style=window.getComputedStyle(document.getElementById("nav-column"));
                if(style.getPropertyValue('min-width')=='280px'){
                    document.getElementById("nav-column").style.minWidth='30px';
                   // document.getElementById("nav-column").classList='col-1-small font-white';
                    //document.getElementById("navmain").classList='nav-list-small';
                }
                else{
                    
                    document.getElementById("nav-column").style.minWidth='280px';
                    //document.getElementById("nav-column").classList='col-1 font-white';
                    //document.getElementById("navmain").classList='nav-list';
                    }
            }
            function shownav()
            {
                var nav=document.getElementById("navmain");
                
                style = window.getComputedStyle(nav),
                visibility = style.getPropertyValue('visibility');
                if(visibility=="visible")
                {
                    nav.style.visibility='hidden';
                    nav.style.height='0';
                }
                else{
                    nav.style.visibility='visible';
                    nav.style.height='100%';
                }
                
            }
        </script>
    </head>

    <body>
        <div class="container">
            <div id='header-row' class="row">
                <div id='nav-column' class='col-1 font-white'>
                    <div class="nav">
                        <h2>
                            <i class="fa fa-cogs" aria-hidden="true"></i>User Panel<button class='btn nav-btn-top' onclick='shownav()'><i class="fa fa-bars" aria-hidden="true"></i></button></h2>
                        <a href="../login.php?action=logout" class="btn btn-green"><span>Logout</span>
                            <i class="fa fa-sign-out ml-2" aria-hidden="true"></i>
                        </a>
                    </div>
                    <ul class="nav-list" id='navmain'>
                        <a href="feed.php" class='nav-link'>
                            <li class="nav-item <?php if($pName=="feed.php"){ echo "active ";}?>">
                            <i class="fa fa-rss" aria-hidden="true"></i>
<span>Feed</span></li>
                        </a>
                        <a href="subscriptions.php" class='nav-link'>
                            <li class="nav-item <?php if($pName=='subscriptions.php'){ echo "active ";}?>">
                                <span><i class="fa fa-list" aria-hidden="true"></i>
Subscriptions</span></li>
                        </a>
                        <a href="authors.php" class='nav-link'>
                            <li class="nav-item <?php if($pName=="authors.php"){ echo "active";}?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
<span>Authors</span></li>
                        </a>
                        <a href="profile.php" class='nav-link'>
                            <li class="nav-item <?php if($pName=="profile.php"){ echo "active";}?>">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
<span>Profile</span></li>
                        </a>
                        <?php
                        $getPicQuery="select * from users where id={$uid}";
                        $result=mysqli_query($connection,$getPicQuery);
                        $row=mysqli_fetch_array($result);
                    ?>
                        <li>
                        <center><p>Welcome <?php echo $row["firstname"]?></p></center>
                    <center><img src="../admin/Images/<?php echo $row["profilepicture"];  ?>" width="100px" height="100px" alt="" class="profpic" style="border-radius:50px;border:2px solid white;"/></center>
                        </li>
                    </ul>
                    
                    
                </div>
                <script>

                </script>
                <div class='col-9 bg-white' style='padding-left:17px;padding-right:17px;height:100vh;overflow-y:auto;'>
                    <!--Header End -->