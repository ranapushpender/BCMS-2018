<?php include "../Include/sessions.php";
    isLoggedInMember();
?>
<?php
  include("../Include/connection.php");
  $uid=  15;
  $subs=(mysqli_fetch_array(mysqli_query($connection,"select subscriptions from users where id={$uid}")))["subscriptions"];
  $subsarray=explode('^',$subs);
  if(isset($_GET["action"]))
  {
    switch($_GET["action"])
    {
      case "unsubscribe":
        $name=$_GET["name"];
        $newsubarray=array();
        $j=0;
        for($i=0;$i<sizeof($subsarray);$i++)
        {
          if($subsarray[$i]==$name)
          {
            continue;
          }
          else{
            $newsubarray[$j]=$subsarray[$i];
            $j++;
          }
        }
        $newsubs=implode("^",$newsubarray);
        $unsubscribeQuery="update users set subscriptions='{$newsubs}' where id={$uid}";
        mysqli_query($connection,$unsubscribeQuery);
        header("Location:subscriptions.php");
        break;
    }
  }
  
  include("Include\header.php");
  
?>
<div class="wrapper" style="height:100vh;">
    <h1><i class="fa fa-list" aria-hidden="true"></i>
Subscriptions</h1>
    <hr>
    <div class="table-responsive">
      <table class="table" style="width:100%">
        <thead>
          <th>Author</th>
          <th>Unsubscribe</th>
        </thead>
        <tbody>
          <?php
              for($i=0;$i<sizeof($subsarray);$i++)
              {
          ?>
                <tr>
                  <td><?php echo $subsarray[$i] ?></td>
                  <td><a class="btn btn-icon-red" href="subscriptions.php?action=unsubscribe&name=<?php echo $subsarray[$i] ?>"><i class="fa fa-bell-slash" aria-hidden="true"></i>

</a></td>
                </tr>
          <?php
              }
          ?>
        </tbody>
      </table>
    </div>
</div>

<?php
    include("Include\\footer.php");
?>
