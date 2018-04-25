<?php include "../Include/sessions.php";?>

<?php
    isLoggedInAdmin();
    header("Location:dashboard.php");
?>
               