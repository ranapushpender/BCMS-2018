<?php include "../Include/sessions.php";
    isLoggedInMember();
?>
<?php
  
  $uid=  15;
  include("../Include/connection.php");
  include("Include\header.php");
?>
<div class="wrapper" style="height:100vh;">
    <h1><i class="fa fa-rss" aria-hidden="true"></i>
Feed</h1>
    <hr>
<div class="table-responsive">
    <table class="table" style="width:100%;">
      <thead>
        <th>Title</th>
        <th>Image</th>
        <th>View</th>
      </thead>
      <tbody>
      
      
    <?php
      $subs=(mysqli_fetch_array(mysqli_query($connection,"select subscriptions from users where id={$uid}")))["subscriptions"];
      $subsarray=explode('^',$subs);
      $listAuthorsQuery="select distinct post_author from post";
      $listAuthorsQueryResult=mysqli_query($connection,$listAuthorsQuery);
      while($author=mysqli_fetch_array($listAuthorsQueryResult))
      {
          if(stripos($subs,$author["post_author"])!=false)
          {
            $getPosts=mysqli_query($connection,"select * from post where post_author='{$author['post_author']}'");
            while($rowPost=mysqli_fetch_array($getPosts))
            {
    ?>
              <tr>
                <td><?php echo $rowPost["post_title"] ?></td>
                <td><img width="400px" height="150px" src="../Images/<?php echo $rowPost["post_image"] ?>" alt=""></td>
                <td><a class="btn btn-icon-blue" href="../view.php?pid=<?php echo $rowPost["post_id"] ?>"><i class="fa fa-eye" aria-hidden="true"></i>
</a>    </td>
              </tr>
    <?php
            }
          }
      }
    ?>
    </tbody>
    </table>
    </div>
</div>
<?php
    include("Include\\footer.php");
?>
