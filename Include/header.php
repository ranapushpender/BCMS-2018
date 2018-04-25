<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="src/fa/css/font-awesome.css">

 </head>
<body style="background-image:url('Images/bg.png')">
    <!-----Nav Section----->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">CMS</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav" ><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="nav navbar-nav ml-auto">
                <?php
                $queryCategoryGet= "select * from category";
                $result=mysqli_query($connection,$queryCategoryGet);
                while($row=mysqli_fetch_array($result))
                {
                    $cat_title=$row["cat_title"];
                    echo "<li class=\"nav-item\">";
                    echo "<a class=\"nav-link\" href=\"index.php?category={$row["cat_id"]}\">{$cat_title}</a></li>";
                }
                
                ?>
                
                <!--<li class="nav-item">
                    <button class="btn btn-success" data-toggle="modal" data-target="#loginModal">login</button>
                </li>-->
                
            </ul>
        </div>
    </nav>
    <!----Login---------->
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username"/>
                        </div>
                        <div clas="form-group">
                            <input type="text" class="form-control" placeholder="Username"/>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----Main Body------->
    <div class="container">
        <div class="row">
            <div class="col-sm-9 my-3">
                 