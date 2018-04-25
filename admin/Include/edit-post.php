
<?php
    
    if(!isset($_GET["pid"]))
    {
        
        header("Location:posts.php");
        exit();
        
    }
    else if(empty(trim($_GET["pid"])))
     {
        header("Location:posts.php");
        exit();  
            
     }
    
?>

<?php 
$pid=mysqli_real_escape_string($connection,$_GET["pid"]);
$getPostDataQuery="select * from post where post_id={$pid}";
$postDataResult=mysqli_query($connection,$getPostDataQuery);
$postData=mysqli_fetch_array($postDataResult);
?>
<h1>Edit Post</h1>
<hr>
<?php if(failureMessage())
    {
?>
        <div class="msg msg-failure">Please Dont Leave FIelds Blank</div>
 <?php }
    setFailure(0);
 ?>
<!---Script n Css-->
<script>
    done=false;
    function enableEditor()
    {
       //prompt("ef");
      
       if(!done){ document.getElementById("texteditor").contentWindow.document.designMode='on';
        document.getElementById("texteditor").contentWindow.document.body.innerHTML=document.getElementById("txtarea").value;
                 }
        done=true;
        
    }
    function exeCmd(cmd)
    {
        document.getElementById("texteditor").contentWindow.document.execCommand(cmd,null,false);
    }
    function exeCmdParam(cond)
    {
        switch(cond)
        {
            case "img":
                var imgname=prompt("Enter the image path or Url");
                if(imgname.indexOf("http://")==-1){
                    imgname=".."+imgname;
                    document.getElementById("texteditor").contentWindow.document.execCommand('insertImage',null,imgname);
                    break;      
                }
                else{
                    document.getElementById("texteditor").contentWindow.document.execCommand('insertImage',null,imgname);
                    break;
                }
                
            case "fontcol":
                var colorname=prompt("Enter the color:");
                document.getElementById("texteditor").contentWindow.document.execCommand('foreColor',null,colorname);
                break;
            case "fontsz":
                var fontsize=prompt("Enter the size (1-7):");
                if(fontsize<1 || fontsize>7)
                {
                    break;
                }
                document.getElementById("texteditor").contentWindow.document.execCommand('fontSize',null,fontsize);
                break;
            
            
            
        
        }
    }
    
    function submit_form(){
       
       var txtarea=document.getElementById("txtarea"); txtarea.value=document.getElementById("texteditor").contentWindow.document.body.innerHTML;
        document.getElementById("btn-submit").click();
    }
</script>
<style>
    .post-text-area{
        display:none;
    }
    .edit-btn{
        display:none;
    }
</style>
<!---Script n Css End-->

<div class="wrapper">
    <form id='addform' enctype="multipart/form-data" method="post" action="posts.php?pid=<?php echo $pid; ?>">
        <div class="form-group">
            <label for="posttitle">Title</label>
            <input type="text" class="form-control" name="posttitle" value="<?php echo $postData["post_title"]; ?>"/>
        </div>
        <div class="form-group">
            <label for="postauthor">Author</label>
            <input type="text" class="form-control" name="postauthor" value="<?php echo $postData["post_author"]; ?>"/>
        </div>
        <div class="form-group">
            <label for="postcategory">Category</label>
            <select class="form-control" name="categories">
                <?php
                    $getCategoriesQuery="select * from category";
                    $resultGetCategories=mysqli_query($connection,$getCategoriesQuery);
                    while($row=mysqli_fetch_array($resultGetCategories))
                    {
                        
                        
                        
                    
                ?>  
                    <option <?php if($row["cat_id"]==$postData["post_category_id"]){echo "selected='selected'";} ?> ><?php echo $row["cat_id"].". ".$row["cat_title"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="postimage">Post Image</label>
            <input type="file" class="form-control" name="postimage"/>
        </div>
        <div class="form-group" onclick="enableEditor()">
            <label for="postcontent">Content</label>
            <div class='editor-buttons'>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('bold')"><i class="fa fa-bold" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('underline')"><i class="fa fa-underline" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('italic')"><i class="fa fa-italic" aria-hidden="true"></i></button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('insertUnorderedList')"><i class="fa fa-list-ul" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('insertOrderedList')"><i class="fa fa-list-ol" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmdParam('img')"><i class="fa fa-file-image-o" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmdParam('fontcol')"><i class="fa fa-paint-brush" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmdParam('fontsz')"><i class="fa fa-font" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('createLink')"><i class="fa fa-link editor-button" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('undo')"><i class="fa fa-undo" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('redo')"><i class="fa fa-repeat" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('justifyLeft')"><i class="fa fa-align-left" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('justifyCenter')"><i class="fa fa-align-center" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('justifyRight')"><i class="fa fa-align-right" aria-hidden="true"></i>
</button>
            <button class="btn-icon btn-icon-grey mb-2" type="button" onclick="exeCmd('justifyFull')"><i class="fa fa-align-justify" aria-hidden="true"></i>
</button>
                    </div>
            <textarea class="form-control post-text-area" name="postcontent" id="txtarea"><?php echo $postData["post_content"]; ?></textarea>
            <iframe class="form-control" id="texteditor" name="mainEditor" style="height:500px;"></iframe>
        </div>
        <div class="form-group">
            <label for="posttags">Tags</label>
            <input type="text" class="form-control" name="posttags" value="<?php echo $postData["post_tags"]; ?>"/>
        </div>
        <div>
            <select name="poststatus">
                <option>draft</option>
                <option>published</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary edit-btn" name="editpostsubmit" id="btn-submit">Submit</button>
        <button class="btn btn-blue" type="button" onclick="submit_form()">Submit</button>
    </form>
</div>