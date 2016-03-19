<?php
function del_DirAndFile($dirName){
    if(is_dir($dirName)){
        if ( $handle = opendir( "$dirName" ) ) {
            while ( false !== ( $item = readdir( $handle ) ) ) {
                if ( $item != "." && $item != ".." ) {
                    if ( is_dir( "$dirName/$item" ) ) {
                        del_DirAndFile( "$dirName/$item" );
                    } else {
                        if( unlink( "$dirName/$item" ) ){}
                    }
                }
            }
            closedir( $handle );
            if( rmdir( $dirName ) ) {}
        }
    }
}
?>
<?php $folder_name = $_GET['folder_name'];?>
<!DOCTYPE html>
<html>
<head>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#check-images").hide();
        });

        /* Script written by Adam Khoury @ DevelopPHP.com */
        /* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
        function _(el){
            return document.getElementById(el);
        }
        function uploadFile(){
            var file = _("file1").files[0];
            // alert(file.name+" | "+file.size+" | "+file.type);
            if(((file.type == "image/gif") || (file.type == "image/jpeg") || (file.type == "image/pjpeg")|| (file.type == "image/png")) && (file.size < 3000000))
            {
                var formdata = new FormData();
                formdata.append("file1", file);
                var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler, false);
                ajax.addEventListener("load", completeHandler, false);
                ajax.addEventListener("error", errorHandler, false);
                ajax.addEventListener("abort", abortHandler, false);
                var page = +document.getElementById("page").value;
                ajax.open("POST", "process-page.php?folder_name=<?=$folder_name?>&page="+(page+1));
                ajax.send(formdata);
                ajax.onreadystatechange=function(){
                    if(ajax.readyState==4 && ajax.status==200)
                    {
                        // rename file name
                        var page = +document.getElementById("page").value;
                        document.getElementById("page").value = (page+1);
                        // process response
                        var response = ajax.responseText.split('|$|');
                        document.getElementById("uploaded-images").innerHTML += (response[0]+' ');
                        document.getElementById("show-uploaded-img").innerHTML += (response[0]+" ");

                        // when upload success, reset div
                        document.getElementById("check-images").innerHTML = "<img src='' width='40%' id='this-img'><br clear='both'>" +
                        "<button type='button' id='del-button' onclick='delete_img()' >Delete</button>";
                        document.getElementById("upload-button").disabled = true;
                        document.getElementById("file1").disabled = false;
                        document.getElementById("file1").value = '';
                        $("#check-images").hide();
                    }
                }
            }else{
                alert("invalid file!");
            }
        }
        function progressHandler(event){
            _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
            var percent = (event.loaded / event.total) * 100;
            _("progressBar").value = Math.round(percent);
            _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
        }
        function completeHandler(event){
            var response = event.target.responseText.split('|$|');
            _("status").innerHTML = response[1];
            _("progressBar").value = 0;
        }
        function errorHandler(event){
            _("status").innerHTML = "Upload Failed";
        }
        function abortHandler(event){
            _("status").innerHTML = "Upload Aborted";
        }
    </script>
</head>
<body>
<h2 style="font-size: 24px;">Supported image file format: .jp(e)g/.png/.gif<br>maximum file size:3M each</h2>

<form id="upload_form" enctype="multipart/form-data" method="post">
    <input type="file" name="file1" id="file1" onchange="readURL(this);"><br>
    <div id="check-images" style="text-align: center">
        <img src="" width="40%" id="this-img"><br clear="both">
        <button type="button" id="del-button" onclick="delete_img()" >Delete</button>
    </div>
    <br clear="both"><br>
    <button type="button" id="upload-button" onclick="uploadFile()" style="float: left" disabled>Upload File</button>
    <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
    <h3 id="status"></h3>
    <p id="loaded_n_total"></p>
</form>
<div id="uploaded-images"></div>
</body>
</html>
