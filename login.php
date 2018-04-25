<?php  include "Include/connection.php";?>
<?php
     session_start();
    if(isset($_SESSION["user"]))
    {
        if($_SESSION["user_role"]=="admin")
        {     
            header("Location:admin");
        }
        else{
            header("Location:user");
        }
    }
    if(isset($_GET["action"]))
        {
            if($_GET["action"]=="logout")
            {
                $_SESSION=array();
                header("Location:login.php");
            }
        }
    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
        
        $uname=mysqli_real_escape_string($connection,$_POST["username"]);
        $upass=mysqli_real_escape_string($connection,$_POST["password"]);
        if(trim($uname)!="" && trim($upass)!="")
        {
            $validateQuery="select * from users where username='{$uname}' and password='{$upass}'";
            $validateResult=mysqli_query($connection,$validateQuery);
            if(mysqli_num_rows($validateResult)==0)
            {
                header("Location:login.php");
            }
            else{
                $_SESSION["success"]=0;
                $_SESSION["failure"]=0;
                $_SESSION["user"]=$uname;
                $row=mysqli_fetch_array($validateResult);
                $_SESSION["user_role"]=$row["role"];
                $_SESSION["user_id"]=$row["id"];
                if($_SESSION["user_role"]=="admin")
                {
                    header("Location:admin");
                }
                else{
                    header("Location:user");
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="admin/css/styles.css">
    <link rel="stylesheet" href="src/fa/css/font-awesome.css">
    <style>
        html{
            height:100%;
        }
        body{
            background: url(Images/login-bg.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            display:flex;
            align-items: center;
            justify-content: center;
        }
        .login-container{
            background-color:rgba(255,255,255,0.96);  
            -webkit-box-shadow: -1px 2px 14px -1px rgba(0,0,0,0.75);
            -moz-box-shadow: -1px 2px 14px -1px rgba(0,0,0,0.75);
            box-shadow: -1px 2px 14px -1px rgba(0,0,0,0.75);
            margin-top:25px;
            
        }
        @media only screen and (min-width:550px)
        {
            .login-container{
                margin-top: 166px;
            }
    
        }
        .form-control{
            margin:10px 0px;
        }
        .btn{
            margin:20px 0px;
        }
    </style>
</head>
<body>
    <div class="login-container d-flex">
            <h1>Login</h1>
            <hr>
            <form action="login.php" method="post" class="row row-inverse">
               <label for="username">Username:</label> 
                <input type="text" name="username" class="form-control"/>
                <label for="password">Password: </label>
                <input type="password" name="password" class="form-control"/>
                <button type="submit" class="btn btn-lblue">Login</button>
            </form>
        </div>
    </div>    
</body>
</html>