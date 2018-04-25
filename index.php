<?php
    include "Include/connection.php";
    include "Include/header.php";
?>
                <!----Post Item-------------------->
                <?php                 
                    $queryGetAllPosts="select * from post where post_status='published' order by post_id desc";
                    if(isset($_GET["search"]))
                    {
                        if(!empty($_GET["search"]))
                        $queryGetAllPosts="select * from post where post_tags LIKE '%{$_GET["search"]}%' order by post_id desc";
                   } 
                   if(isset($_GET["category"]))
                    {
                        if(!empty($_GET["category"]))
                        $queryGetAllPosts="select * from post where post_category_id={$_GET["category"]}  order by post_id desc";
                   } 
                    //echo $queryGetAllPosts;
                    $resultGetAllPosts=mysqli_query($connection,$queryGetAllPosts);
                    if(!$resultGetAllPosts)
                    {
                        echo "No Posts";
                    }
                    while($row=mysqli_fetch_array($resultGetAllPosts))
                    { 
                        
                    
                ?>
                    <div class="mt-5">
                        <div class="card p-3 bg-light">
                    <h1 class=""><?php echo $row["post_title"]?></h1>
                    <h6 class="card-title my-3">Author:<a href="#"><?php echo $row["post_author"]?></a></h6>
                    <img class="card-img-top img-fluid" style="height:400px;width:100%;"  src="Images/<?php echo $row["post_image"]?>"/>
                    <div class="card-block">
                        
                        <!--<p class="card-text m-3"><?php 
                            for($i=0;$i<310;$i++)
                            {
                                echo $row["post_content"][$i];
                            }
                        ?></p>-->
                        
                    </div>
                   <!-- <div class="card-footer">-->
                        <h6 class="mt-3">Date</h6><?php echo $row["post_date"] ?>
                        <div class="my-3"><a href="view.php?pid=<?php echo $row["post_id"]?>" class="btn btn-primary">Read More</a></div>
                    <!--</div>-->
                    
                        </div>
                        <hr>
                    </div>
                <?php } ?>
                
                <!----Post Item ENd-------------------->
    

<span><i style="background-color:red;" class="fa fa-tachometer" aria-hidden="true"></i></span>
<?php

    include "Include/footer.php";
?>