<?php include "../Include/sessions.php";
isLoggedInAdmin();
?>
<?php
    include "../Include/connection.php";
    if(isset($_POST["addusersubmit"]))
    {   $fname=trim($_POST["fname"]);
        $lname=trim($_POST["lname"]);
        $email=trim($_POST["email"]);
        $username=trim($_POST["username"]);
        $password=trim($_POST["password"]);
        $role=trim($_POST["role"]);
        $nameString="0123456789abcdefghijklmnopqrstuvwxyz";
        $imgName='';
        for($i=0;$i<20;$i++)
        {
            $rno=rand(0,34);
         
            $imgName=$imgName.($nameString[$rno]);
        }
        $tmpImgName=$_FILES["profilepic"]["tmp_name"];
        move_uploaded_file($tmpImgName,"Images/{$imgName}");
        if(empty($fname) || empty($lname) || empty($email) || empty($username) || empty($password) || empty($role))
        {
            setFailure(1);
            header("Location:users.php?action=add");
        }
        else{
            setSuccess(1);
            $addUserQuery="insert into users(firstname,lastname,email,username,password,role,profilepicture) values('{$fname}','{$lname}','{$email}','{$username}','{$password}','{$role}','{$imgName}')";
            mysqli_query($connection,$addUserQuery);
            header("Location:users.php");
            die();
        }
        
    }
    if(isset($_GET["action"]))
    {
        if(trim($_GET["action"])!="")
        {
            switch($_GET["action"])
            {
                case "add":
                    include "Include/header.php";
                    include("Include/add-user.php");
                    break;
                case "delete":
                    if(isset($_GET["id"]) && !(empty(trim($_GET["id"]))))
                    {
                        $deleteUserQuery="delete from users where id={$_GET['id']}";
                        mysqli_query($connection,$deleteUserQuery);
                        header("Location:users.php");
                    }
                    break;
                case "approve":
                    if(isset($_GET["id"]) && !(empty(trim($_GET["id"]))))
                     {
                       $approveUserQuery="update users set approved=1 where id={$_GET['id']}";
                        mysqli_query($connection,$approveUserQuery);
                        header("Location:users.php");
                     }
                    break;
                case "unapprove":
                    if(isset($_GET["id"]) && !(empty(trim($_GET["id"]))))
                    {
                        $unapproveUserQuery="update users set approved=0 where id={$_GET['id']}";
                        mysqli_query($connection,$unapproveUserQuery);
                        header("Location:users.php");
                    }
                    break;
                case "update":
                    if(isset($_GET["id"]) && !(empty(trim($_GET["id"]))))
                    {
                        $updateQuery="update users set role='{$_GET['role']}' where id={$_GET['id']}";
                        mysqli_query($connection,$updateQuery);
                        header("Location:users.php");
                    }
                    break;
            }
        }
    }
    else{
        include "Include/header.php";
?>
            <h1><i class="fa fa-users mr-2" aria-hidden="true"></i>Users</h1>
            <hr>
            <?php
                //======================================
                    if(successMessage())
                    {
                ?>
                    <div class="msg msg-success">User added sucessfully</div>
                <?php
                        setSuccess(0);
                    }
                ?>
            <div class="wrapper">
                <a href='users.php?action=add' class='btn btn-blue'>Add User</a>
                <div class="table-responsive" style='width:100%;'>
                    <table class="table mt-2" style='width:100%;'>
                        <thead>
                        <th>Id</th>
                            <th>Username</th>
                            <th>role</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </thead>
                        <tbody>
                        <?php
                            $getUsersQuery='select * from users';
                            $getUsersQueryResult=mysqli_query($connection,$getUsersQuery);
                            while($row=mysqli_fetch_array($getUsersQueryResult))
                            {
                        ?>
                            <tr>
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["username"] ?></td>
                                <td><?php #echo $row["role"] ?>
                                <form action="users.php" method="get">
                                    <select name="role">
                                        <option><?php echo $row["role"] ?></option>
                                        <option>
                                            <?php
                                                if($row['role']=="subscriber")
                                                {
                                                    echo "admin";
                                                }
                                                else{
                                                    echo "subscriber";
                                                }
                                            ?>
                                        </option>
                                    </select>
                                </td>
                                <td><a class="btn btn-icon btn-icon-green"  href="users.php?action=approve&id=<?php echo $row['id'] ?>"><i class="fa fa-check" aria-hidden="true"></i>
</a></td>
                                <td><a class="btn btn-icon btn-icon-yellow" href="users.php?action=unapprove&id=<?php echo $row['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                <td><a class="btn btn-icon btn-icon-red" href="users.php?action=delete&id=<?php echo $row['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                
                                    <td>
                                    <button name="action" value="update" type="submit" class="btn btn-icon btn-icon-yellow"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
                                    <input name="id" type="hidden" value="<?php echo $row['id'] ?>">
                                    </td>
                                </form>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
    <?php
        }
    ?>
<?php
    include "Include/footer.php";
?>