<h2><i class="fa fa-users mr-2" aria-hidden="true"></i>Add Users</h2>
<hr>
<?php
                //======================================
                    if(failureMessage())
                    {
                ?>
                    <div class="msg msg-failure">Please dont leave fields blank</div>
                <?php
                        setFailure(0);
                    }
                ?>
<div class="wrapper">
    <form action="users.php" method='post' enctype='multipart/form-data'>
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" class='form-control' id="">
        </div>
        <div class="form-group mt-1">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" class='form-control' id="">
        </div>
        <div class="form-group mt-1">
            <label for="email">Email</label>
            <input type="text" name="email" class='form-control' id="">
        </div>
        <div class="form-group mt-1">
            <label for="username">Username</label>
            <input type="text" name="username" class='form-control' id="">
        </div>
        <div class="form-group mt-1">
            <label for="password">Password</label>
            <input type="password" name="password" class='form-control' id="">
        </div>
        <div class="mt-1">
           <select name='role'>
                <option>subscriber</option>   
                <option>admin</option>
           </select>
        </div>
        <div class="form-group mt-1">
            <label for="profpic">Profile Picture</label>
            <input type="file" name="profilepic" class='form-control' id="">
        </div>
        <input type="submit" name='addusersubmit' class="btn btn-blue mt-1 mb-1" value="Add"/>
    </form>
</div>