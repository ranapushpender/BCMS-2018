<?php
    include "Include/connection.php";
?>
<?php
    if(isset($_GET["sub"]))
    {
        $postData=mysqli_real_escape_string($connection,$_GET["txtmain"]);
        $query="insert into testcontent values('${postData}')";
        mysqli_query($connection,$query);
        $postDataGet="select * from testcontent";
        $res=mysqli_query($connection,$postDataGet);
        $row=mysqli_fetch_array($res);
        echo str_replace('\"','"',$row["content"]);
        die();
    }
?>
<html>
    <head>
    <style>
        .postImage{
            width:20%;
            height:20%;
        }    
    </style>
    </head>
    <body onload="turnOnEditor()">
        <button onclick="cmdEx('bold')">Bold</button>
        <button onclick="cmdExImg('insertImage')">IImg</button>
        <iframe style="width:100%;height:700px;" name="yo" id="textEditor"></iframe>
        
        <form action="test.php" method="get">
            <textarea name="txtmain" id="txtFinal"></textarea>
            <button type="submit" id="sub" name="sub">Submit</button>
        </form>
        
        <button type="button" id="subgo" name="subgo" onclick="subMe()">SubmitGo</button>
        
        <button onclick="cmdExecDisp()">Print</button>
        <div name="TExt" id="t1">
        fsd
        </div>
        <script>
            function turnOnEditor()
            {
                yo.document.designMode="On";
                
            }
            function cmdEx(cmd)
            {
                yo.document.execCommand(cmd,null,false);
                document.getElementById("textEditor").contentWindow.document.body.innerHTML=document.getElementById("textEditor").contentWindow.document.body.innerHTML.replace("<img","<img class='postImage'");
            }
            function cmdExImg(cmd)
            {
                yo.document.execCommand(cmd,null,'Images/test.png');
            }
            function cmdExecDisp()
            {
                var TExt=document.getElementById("t1");
                TExt.innerHTML=document.getElementById("textEditor").contentWindow.document.body.innerHTML;
                TExt.innerHTML=TExt.innerHTML.replace("<img","<img class='postImage'");
                
            }
            function subMe()
            {
                document.getElementById("txtFinal").value=document.getElementById("textEditor").contentWindow.document.body.innerHTML;
                document.getElementById("sub").click();
            }
            
        </script>
    </body>
</html>