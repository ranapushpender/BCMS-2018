<?php include "../Include/sessions.php";
isLoggedInAdmin();
?>
<?php
    include "..\Include\connection.php";
    include "Include\header.php";
?>
    <h1><i class="fa fa-tachometer mr-2" aria-hidden="true"></i>Dashboard</h1>
    <hr>
    <div class="wrapper" style="height:100%">
        <div class="row">
            <div class="dcard">
                <div class="dcard-body dcard-body-red">
                <i class="fa fa-users user-icon pt-3" aria-hidden="true"></i>     
               <div >
                   <?php
                        $row=mysqli_fetch_array(mysqli_query($connection,"select count(username) as col from users"));
                        echo $row["col"];
                   ?>
                   
               </div>
                </div>
                <a href="users.php" style='text-decoration:none;'>
                    <div class="dcard-footer dfooter-red">
                        <div class='dfooter-text'>View Users</div>
                        <i class="fa fa-chevron-circle-right dfooter-icon" aria-hidden="true"></i>
                    </div>
                </a>
            </div>
            <div class="dcard">
                <div class="dcard-body dcard-body-blue">
                <i class="fa fa-file-text user-icon pt-3" aria-hidden="true"></i>
                <div >
                    <?php
                        $row=mysqli_fetch_array(mysqli_query($connection,"select count(post_id) as col from post"));
                        echo $row["col"];
                   ?>
                </div>
                </div>
                <a href="posts.php" style='text-decoration:none;'>
                    <div class="dcard-footer dfooter-blue">
                        <div class='dfooter-text'>View Posts</div>
                        <i class="fa fa-chevron-circle-right dfooter-icon" aria-hidden="true"></i>
                    </div>
                </a>
            </div>
            <div class="dcard">
                <div class="dcard-body dcard-body-green">
                <i class="fa fa-eye user-icon pt-3" aria-hidden="true"></i>
                <div >0</div>
                </div>
                <a href="dashboard.php" style='text-decoration:none;'>
                    <div class="dcard-footer dfooter-green">
                        <div class='dfooter-text'>View details</div>
                        <i class="fa fa-chevron-circle-right dfooter-icon" aria-hidden="true"></i>
                    </div>
                </a>
            </div>
            <div class="dcard">
                <div class="dcard-body dcard-body-grey">
                <i class="fa fa-comment" aria-hidden="true"></i>
                <div >
                <?php
                        $row=mysqli_fetch_array(mysqli_query($connection,"select count(comment_id) as col from comments"));
                        echo $row["col"];
                ?>
                </div>
                </div>
                <a href="comments.php" style='text-decoration:none;'>
                    <div class="dcard-footer dfooter-grey">
                        <div class='dfooter-text'>View Comments</div>
                        <i class="fa fa-chevron-circle-right dfooter-icon" aria-hidden="true"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class='table-responsive d-flex-1' style="min-width:300px">
                <table class="table mt-2" style="width:100%;">
                    <thead>
                        <th>Comment</th>
                        <th>Post</th>
                        <th>Date</th>
                        <th>Approve</th>
                    </thead>
                    <tbody>
                        <?php
                            $lcomments=mysqli_query($connection,"select * from comments");
                            $i=0;
                            for($i=0;$i<5;$i++)
                            {
                                if($row=mysqli_fetch_array($lcomments))
                                {
                        ?>

                                <tr>
                                    <td><?php echo $row["comment_content"]?></td>
                                    <td><?php echo $row["comment_id"]?></td>
                                    <td><?php echo $row["comment_date"]?></td>
                                    <td><a class="btn-icon btn-icon-green" href="comments.php?tasker=approve&cid=<?php echo $row["comment_id"];?>"><i class="fa fa-check" aria-hidden="true"></i>
                                </tr>
                        <?php
                                }
                                else
                                {
                        ?>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                        <?php            
                                }
                                    
                            }
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class='table-responsive d-flex-1' style="min-width:300px">
                <table class="table mt-2" style="width:100%;">
                    <thead>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Preview</th>
                    </thead>
                    <tbody>
                        <?php
                            $lcomments=mysqli_query($connection,"select * from post");
                            $i=0;
                            for($i=0;$i<5;$i++)
                            {
                                if($row=mysqli_fetch_array($lcomments))
                                {
                        ?>

                                <tr>
                                    <td><?php echo $row["post_title"]?></td>
                                    <td><a href="posts.php?tasker=edit&pid=<?php echo $row["post_id"] ?>" class='btn-icon btn-icon-yellow'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                    <td><a href="../view.php?pid=<?php echo $row["post_id"] ?>" class='btn-icon btn-icon-blue'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                </tr>
                        <?php
                                }
                                else
                                {
                        ?>
                                <tr>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>---</td>
                                </tr>
                        <?php            
                                }
                                    
                            }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
        include "Include/footer.php" 
?>