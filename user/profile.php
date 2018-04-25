<?php include "../Include/sessions.php";
    isLoggedInMember();
?>
<?php
  
  $uid=$_SESSION["user_id"];
  include("../Include/connection.php");
?>
<?php //include "../Include/sessions.php";?>
<?php
    if(isset($_POST["updateusersubmit"]))
    {   
        $fname=trim($_POST["fname"]);
        $lname=trim($_POST["lname"]);
        $email=trim($_POST["email"]);
        $username=trim($_POST["username"]);
        $password=trim($_POST["password"]);
        $imgName='';
        $updateUserQuery='';
        if(is_uploaded_file($_FILES["profilepic"]["tmp_name"]))
        {
            $nameString="0123456789abcdefghijklmnopqrstuvwxyz";
             
             for($i=0;$i<20;$i++)
             {
                  $rno=rand(0,34);
         
                   $imgName=$imgName.($nameString[$rno]);
                }
                $tmpImgName=$_FILES["profilepic"]["tmp_name"];
                move_uploaded_file($tmpImgName,"../admin/Images/{$imgName}");
                echo $tmpImgName;
               
                $updateUserQuery="update users set firstname='{$fname}',lastname='{$lname}',username='{$username}',password='{$password}',email='{$email}',profilepicture='{$imgName}' where id={$uid}";
                
        }
        else{
            $updateUserQuery="update users set firstname='{$fname}',lastname='{$lname}',username='{$username}',password='{$password}',email='{$email}' where id={$uid}";

        }
        
        if(empty($fname) || empty($lname) || empty($email) || empty($username) || empty($password))
        {
            setFailure(1);
            header("Location:profile.php");
            die();
        }
        else{
            mysqli_query($connection,$updateUserQuery);
            setSuccess(1);
            header("Location:profile.php");
            die();
        }
    }
    include "Include/header.php";
    
    
    $getUserQuery="select * from users where id={$uid}";
    $getUserQueryResult=mysqli_query($connection,$getUserQuery);
    $row=mysqli_fetch_array($getUserQueryResult);
?>
            <h1><i class="fa fa-user-circle" aria-hidden="true"></i>
Profile</h1>
            <hr>
            <?php
                //======================================
                    if(successMessage())
                    {
                ?>
                    <div class="msg msg-success">Profile updated sucessfully</div>
                <?php
                        setSuccess(0);
                    }
                ?>
                <?php
                //======================================
                    if(failureMessage())
                    {
                ?>
                    <div class="msg msg-failure">PLease Dont leave fields blank</div>
                <?php
                        setFailure(0);
                    }
                ?>
            <div class="wrapper" style="height:100vh;">
    <form action="profile.php" method='post' enctype='multipart/form-data'>
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" value='<?php echo $row['firstname'] ?>' class='form-control' id="">
        </div>
        <div class="form-group mt-1">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" value='<?php echo $row['lastname'] ?>' class='form-control' id="">
        </div>
        <div class="form-group mt-1">
            <label for="email">Email</label>
            <input type="text" name="email" value='<?php echo $row['email'] ?>' class='form-control' id="">
        </div>
        <div class="form-group mt-1">
            <label for="username">Username</label>
            <input type="text" name="username" value='<?php echo $row['username'] ?>' class='form-control' id="">
        </div>
        <div class="form-group mt-1">
            <label for="password">Password</label>
            <input type="password" name="password" value='<?php echo $row['password'] ?>' class='form-control' id="">
        </div>

        <div class="form-group mt-1">
            <label for="profpic">Profile Picture</label>
            <input type="file" name="profilepic" class='form-control' id="">
        </div>
        <button type="submit" name='updateusersubmit' class="btn btn-blue mt-1 mb-1"><i class="fa fa-arrow-up" aria-hidden="true"></i>Update</button>
    </form>
</div>


<?php
    include("Include\\footer.php");
?>
