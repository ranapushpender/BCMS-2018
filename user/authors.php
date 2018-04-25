<?php include "../Include/sessions.php";
    isLoggedInMember();
?>
<?php
  
  $uid=  15;
  include("../Include/connection.php");
  if(isset($_GET["action"]))
  {
        switch($_GET["action"])
        {
            case "subscribe":
                $updateSubscriptionsQuery="update users set subscriptions=CONCAT(subscriptions,'^','{$_GET["name"]}') where id={$uid}";
                mysqli_query($connection,$updateSubscriptionsQuery);
                header("Location:authors.php");
            break;
        }
  }
  include("Include\header.php");
  $listAuthorsQuery="select distinct post_author from post";
  $listAuthorsQueryResult=mysqli_query($connection,$listAuthorsQuery);
  ?>
<div class="wrapper" style="height:100vh;">
    <h1><i class="fa fa-pencil" aria-hidden="true"></i>
Authors</h1>
    <hr>
    <div class="table-responsive">
        <table style="width:100%;">
            <thead>
                <th>Author Name</th>
                <th>Subscribe</th>
            </thead>
            <tbody>
                <?php
                    while($row=mysqli_fetch_array($listAuthorsQueryResult))
                    {
                ?>
                    <tr>
                        <td><?php echo $row["post_author"] ?></td>
                        <td><a class="btn btn-icon-green" href="authors.php?action=subscribe&name=<?php echo $row["post_author"] ?>"><i class="fa fa-bell" aria-hidden="true"></i>
</a></td>
                    </tr>
                
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
<?php
    include("Include\\footer.php");
?>
