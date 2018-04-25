<?php include "../Include/sessions.php";
    isLoggedInAdmin();
?>
<?php include "../Include/connection.php" ?>
<?php 
    if(isset($_POST["btnaddcat"]))
    {
        $postCategory=mysqli_real_escape_string($connection,$_POST["txtcategory"]);
        if(empty(trim($postCategory)))
        {
            setFailure(1);
            header("Location:categories.php");
            die();
        }
        
        $addCategoryQuery="INSERT INTO `category`(`cat_title`) VALUES ('{$postCategory}')";
       // echo $addCategoryQuery;
        $_POST=array();
        mysqli_query($connection,$addCategoryQuery) ;
        setSuccess(1);
        header("Location:".$_SERVER["PHP_SELF"]);
        die();
    }
    if(isset($_GET["delete"]))
    {
        $deleteCategoryQuery="DELETE FROM category WHERE cat_id='{$_GET["delete"]}' ";
        mysqli_query($connection,$deleteCategoryQuery) ;
        header("Location:".$_SERVER["PHP_SELF"]);
    }
    if(isset($_POST["btneditcat"])){
        $editCategoryQuery="update category set cat_title='{$_POST["txtupdatecat"]}' where cat_id={$_POST["cat_id_edit"]}";
        mysqli_query($connection,$editCategoryQuery) ;
        header("Location:".$_SERVER["PHP_SELF"]);
    }
    
?>
<?php include "Include/header.php" ?>

      
            <h1><i class="fa fa-list mr-2" aria-hidden="true"></i>Categories</h1>
            <hr>
            
            <?php
                //======================================
                    if(successMessage())
                    {
                ?>
                    <div class="msg msg-success">Category added sucessfully</div>
                <?php
                        setSuccess(0);
                    }
                ?>
                <?php
                //======================================
                    if(failureMessage())
                    {
                ?>
                    <div class="msg msg-failure">Please fill the category name</div>
                <?php
                        setFailure(0);
                    }
                ?>
            <div class="wrapper">
                <div class="row">
                    <div>
                        <form method="post" action="categories.php">
                            <div class="form-group">
                                <label for="txtcategory">Category Name</label>
                                <input id="txtcategory" name="txtcategory" type="text" class="form-control"/>
                            </div>
                            <div> 
                                <button id="btnaddcat" name="btnaddcat" type="submit" class="btn btn-blue mt-1"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Add</button>
                            </div>
                        </form>
                        <?php
                                if(isset($_GET["edit"])){
                                    
                                
                            ?>
                        <form action='categories.php' method='post'>
                                    <div class='form-group'>
                                        <label for='txtupdatecat' class='mt-1'>Edit</label>
                                        <input id='txtupdatecat' name='txtupdatecat' type='text' value='<?php echo urldecode($_GET["edit"])?>' class='form-control'/>
                                   </div>
                                   <div>
                                        <button id='btneditcat' name='btneditcat' type='submit' class='btn btn-blue mt-1'><i class="fa fa-arrow-circle-up mr-2" aria-hidden="true"></i>Update</button>
                                        <input type='hidden' name='cat_id_edit' value='<?php echo $_GET["edit"]?>'/>
                                  </div>
                        </form>
                            
                        <?php
                                }
                        ?>
                    </div>
                    <div class='table-responsive' style='width:100%;'>
                        <table class="table" style='width:100%;'>
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $showCategory="select * from category";
                                    $result=mysqli_query($connection,$showCategory);
                                    if($result)
                                    {
                                        while($row=mysqli_fetch_array($result))
                                        {
                                            echo "<tr>";
                                                echo "<td>{$row["cat_id"]}</td>";
                                                echo "<td>{$row["cat_title"]}</td>";
                                                echo "<td><a class='btn btn-icon btn-icon-red' href='categories.php?delete=".urlencode($row["cat_id"])."'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                                                echo "<td><a class='btn btn-icon btn-icon-yellow' href='categories.php?edit=".urlencode($row["cat_id"])."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";       
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
<?php include "Include/footer.php" ?>