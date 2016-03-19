$(document).ready(function() {
    $('#new-comment-form').hide();
    $(".p1").show();

    $("#scores_info_table").DataTable();
    $("#anige_info_table").DataTable({
        "bLengthChange": false
    });
    $("#songs_info_table").DataTable({
        "bLengthChange": false
    });
    $("#unfinished_score_table").DataTable();
    $("#unfinished_anige_info_table").DataTable();
    $("#unfinished_song_info_table").DataTable();

    var show = false;
    $(".selectThisAnige").click(function(){
        $('.selectThisAnige').not(this).removeClass('clickTable');
        $(this).toggleClass('clickTable');
        $("#fromWhich").val($(this).text());
    });

    $("#new-comment-button").click(function(){
        show = !show;
        if(show){
            $('#new-comment-form').show("slow",function(){});
        }else{$('#new-comment-form').hide("slow",function(){});}

    });

    $(".popupButton").click(function() {
        $("#popupBox").show();
        $("#backsheet").show();
    });
    $(".buttonClose").click(function() {
        $("#popupBox").hide();
        $("#backsheet").hide();
    });

    // required info form submit by ajax
    $("#required-info-form").submit(function() {
        var url = "process-page.php?required_info=0"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: $("#required-info-form").serialize(), // serializes the form's elements.
            success: function(data)
            {
                if(isNaN(data)){
                    alert(data);
                }else{
                    document.getElementById("last-insert-id").value = data;
                    $("#need-to-fill").css('display','none');
                    $("#upload_work").show('slow', function(){});
                    $(".after-sub-required").show('slow', function(){});
                    $("#after-sub-table1").hide('slow',function(){});
                }
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });

    // add anige through ajax
    $("#edit-anige-form").submit(function() {
        var url = "process-page.php?subAnige=1";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#edit-anige-form").serialize(),
            success: function(data)
            {
                if(isNaN(data)){
                    alert(data);
                }else{
                    var anige_title_jp = $("#title").val();
                    if(anige_title_jp != null){
                        $("#fromWhich").val(anige_title_jp);
                    }else{
                        $("#fromWhich").val($("#roma").val());
                    }
                    $("#anige-id").val(data);
                    $('#anige_info_table_control').hide('slow',function(){});
                    EABackToES();
                }
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });

    //edit td
    $(".edit-this").dblclick(function(){
        var ty_id=$(this).attr('id');
        var content=$("#"+ty_id).text();
        var edit_update;  // 0:edit 1:update
        if(content == '/'){
             edit_update= 0;
        }else{edit_update = 1;
            if(!confirm("You are tying to modified this record, it should check by admin manually. Are you sure this info is Not Correct?")){
                return false;
            }}
        var ID=ty_id.substr(4);
        var td_type=ty_id.substr(0,3);
        var input=prompt("Change value to:","");
        if(input !=null){
            var dataString = 'td_type='+ td_type +'&input_value='+input+'&id='+ID + '&edit_update=' +edit_update;
            if(edit_update==1){
                var notes=prompt("You can say something or just skip:","");
                dataString += ('&notes=' + notes);
            }
            $.ajax({
                type: "POST",
                url: "process-page.php",
                data: dataString,
                success: function(data){
                   // alert(data);
                   location.href="unfinished.php";
                }
            })
        }
    });

    $("#anige_info_table tr").click(function(){
        $(this).addClass("selected").siblings().removeClass("selected");
    });
});

// comments page function
var lastTarget = 1;

function changePage(page){
    if(page != lastTarget){
        $(".p"+lastTarget).hide();
        lastTarget = page;
    }
    $(".p"+page).show();

}

var show_anige_info_table_ = false;
function show_anige_info_table(score_id){
    show_anige_info_table_ = !show_anige_info_table_;
    if(show_anige_info_table_){
        $('#anige_info_table_control'+score_id).show('slow',function(){});
    }else{
        $('#anige_info_table_control'+score_id).hide('slow',function(){});
    }
}

var show_song_info_table_ = false;
function show_song_info_table(score_id){
    show_song_info_table_ = !show_song_info_table_;
    if(show_song_info_table_){
        $('#song_info_table_control'+score_id).show('slow',function(){});
    }else{
        $('#song_info_table_control'+score_id).hide('slow',function(){});
    }
}

function select_anige(title, anige_id){
    document.getElementById("fromWhich").value = title;
    document.getElementById("anige-id").value = anige_id;
}

function select_song(title, anige_id, score_id,song_title,isScoreExit){
    if(isScoreExit == 0){
        document.getElementById("fromWhich").value = title;
        document.getElementById("anige-id").value = anige_id;
        document.getElementById("score-id").value = score_id;
        document.getElementById("title").value = song_title;
    }else{alert("Sorry, this Song already has score in database.");}
}

function select_song_info(title, score_id,song_title){
    document.getElementById("fromWhich").value = title;
    document.getElementById("title").value = song_title;
    document.getElementById("score-id").value = score_id;
}

function seleted_anige(){
    $('#anige_info_table_control').hide('slow',function(){});
    $('#edit_song_control').show('slow',function(){});
}

function seleted_song(){
    $('#song_info_table_control').hide('slow',function(){});
    $('#edit_song_control').hide('slow',function(){});
}

function check_search_key(){
    return (document.getElementById("search-bar").value != '')
}

function staff_roma(score_id){
    $('.staff-jp'+score_id).hide('slow',function(){});
    $('.staff-roma'+score_id).show('slow',function(){});
}

function staff_jp(score_id){
    $('.staff-roma'+score_id).hide('slow',function(){});
    $('.staff-jp'+score_id).show('slow',function(){});
}

function staff_both(){
    $('.staff-roma').show('slow',function(){});
    $('.staff-jp').show('slow',function(){});
}

var show_options_ = false;
function show_options(){
    show_options_ = !show_options_;
    if(show_options_)
        $('#options').show('slow',function(){});
    else
        $('#options').hide('slow',function(){});
        $('#options_roma').hide('slow',function(){});
}

function show_chord_progressions(){
    $("#score-img").hide('slow',function(){});
    $("#chord-progressions-link").hide('slow',function(){});
    $("#chord-progressions").show('slow',function(){});
}

function show_chord_progressions_link(){
    $("#score-img").hide('slow',function(){});
    $("#chord-progressions").hide('slow',function(){});
    $("#chord-progressions-link").show('slow',function(){});
}

function show_upload_modle(){
    var folder_name = document.getElementById("last-insert-id").value;
    $("#upload-modle").load("upload-modle.php?folder_name=w_s" + folder_name);
    scroll(0,0);
}

function show_img_file(){
    $("#chord-progressions").hide('slow',function(){});
}

function options_in_jp(score_id){
    $("#options_roma"+score_id).hide('slow',function(){});
    $("#options"+score_id).show('slow',function(){});
}

function options_in_ro(score_id){
    $("#options"+score_id).hide('slow',function(){});
    $("#options_roma"+score_id).show('slow',function(){});
}

function delete_img_admin(del_this, score_id){
    var images=document.getElementById("up-images"+score_id).value;
    images = images.replace(del_this,'');
    document.getElementById("up-images"+score_id).value = images;
    document.getElementById(del_this+score_id).style.display = "none";
}

function delete_img(){
    document.getElementById("check-images").innerHTML = "<img src='' width='40%' id='this-img'><br clear='both'>" +
                                        "<button type='button' id='del-button' onclick='delete_img()' >Delete</button>";
    document.getElementById("upload-button").disabled = true;
    document.getElementById("file1").disabled = false;
    document.getElementById("file1").value = '';
    $("#check-images").hide();
}

var last_scores_page_admin = 1;
function change_scores_page_admin(this_page){
    $(".score-page"+last_scores_page_admin).hide();
    $(".score-page"+this_page).show();
    last_scores_page_admin = this_page;
    scroll(0,0);
}
// read image from local computer
function readURL(input) {
    var file = input.files[0];
    if (input.files && file) {
        if(((file.type == "image/gif") || (file.type == "image/jpeg") || (file.type == "image/pjpeg")|| (file.type == "image/png")) && (file.size < 3000000))
        {
            var reader = new FileReader();
            reader.onload = function (e) {

                document.getElementById("file1").disabled = true;
                document.getElementById("upload-button").disabled = false;
                $("#check-images").show();

                $('#this-img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);

        }else{
            alert("invalid file!");
        }
    }
}

//cover link process
function check_cover_link(){
    //video source website
    var cover_link = $("#cover-url").val();

    if(cover_link.indexOf("youtube.com") >= 0 ){
        // youtube link https://www.youtube.com/watch?v=jbS7MscIp6M&list=RDH3pEDSp7nhw&index=2
        var y_vid = cover_link.substring(cover_link.indexOf("watch?v=")+8);
        if(y_vid.indexOf("&") >= 0 ){
            // not id content, delete
            y_vid = y_vid.substring(0,y_vid.indexOf("&"));
        }
        var y_img_url = "http://img.youtube.com/vi/" + y_vid + "/1.jpg";
        // send id to process-page
        var dataString = 'y_vid='+ y_vid;
        $.ajax({
            type: "POST",
            url: "process-page.php",
            data: dataString,
            success: function(data)
            {
                var response = data.split("|$|");
                if(response[1]!=''){
                    $("#preview-cover-video-title").val(response[0]);   // title
                    $("#preview-cover-video-username").val(response[1]);   // username
                    $("#preview-cover-video-published").val(response[2]);   // published
                    $("#preview-cover-video-img").attr('src',y_img_url);   // img

                    $("#preview-cover-video-request").hide('slow',function(){})
                    $("#preview-cover-video").delay(200).show('slow',function(){});
                }else{
                    alert("Can not find video!")
                }
            }
        });

    }else if(cover_link.indexOf("vimeo.com") >= 0 ){
        // vimeo link
        alert("Sorry, not support vimeo now.")

    }else if(cover_link.indexOf("bilibili") >= 0 ){
        // bilibili link

    }else if(cover_link.indexOf("tudou.com") >= 0 ){
        // tudou link
        alert("Sorry, not support tudou now.")

    }else if(cover_link.indexOf("youku.com") >= 0 ){
        alert("Sorry, not support youku now.")

    }else if(cover_link.indexOf("nicovideo.jp") >= 0 ){
        //  http://www.nicovideo.jp/watch/sm25925565?top_flog&num=0
        var n_vid = cover_link.substring(cover_link.indexOf("/sm")+3);
        // send id to process-page
        var n_dataString = 'n_vid='+ n_vid;
        $.ajax({
            type: "POST",
            url: "process-page.php",
            data: n_dataString,
            success: function(data)
            {
                var response = data.split("|$|");
                if(response[1]!=''){
                    $("#preview-cover-video-title").val(response[0]);   // title
                    $("#preview-cover-video-username").val(response[1]);   // username
                    $("#preview-cover-video-published").val(response[2]);   // published
                    $("#preview-cover-video-img").attr('src',response[3]);   // img

                    $("#preview-cover-video-request").hide('slow',function(){})
                    $("#preview-cover-video").delay(200).show('slow',function(){});
                }else{
                    alert("Can not find video!")
                }
            }
        });


    }else{
        alert("Sorry, now only support youtube, bilibili and niconico video links.")
    }
}

function sub_cover(){
    var title = $("#preview-cover-video-title").val();
    var username = $("#preview-cover-video-username").val();
    var published = $("#preview-cover-video-published").val();
    var video_link = $("#cover-url").val();
    var description = $("#preview-cover-video-dec").val();
    var score_id = $("#score-id").val();
    var img_address = $("#preview-cover-video-img").attr('src');

    var dataString = 'sub_cover_title='+ title + '&username=' + username + '&published=' + published + '&img_address=' + img_address +
                        '&video_link=' + video_link + '&description=' +description + '&score_id=' +score_id;
    $.ajax({
        type: "POST",
        url: "process-page.php",
        data: dataString,
        success: function(data)
        {
            location.href="scores.php?id="+score_id;
        }
    });
}
function cancel_sub_cover(){
    $("#preview-cover-video-request").show('slow',function(){})
    $("#preview-cover-video").delay(200).hide('slow',function(){});
}

var show_anige_table_ = false;
function show_anige_table(){
    show_anige_table_ = !show_anige_table_;
    if(show_anige_table_){
        $("#show-anige-table").show('slow',function(){});
    }else{$("#show-anige-table").hide('slow',function(){});}
}

function show_add_song_title_roma(){
    $("#add-song-title-jp").hide('slow',function(){});
    $("#add-song-title-roma").show('slow',function(){});
}

function show_add_song_title_jp(){
    $("#add-song-title-roma").hide('slow',function(){});
    $("#add-song-title-jp").show('slow',function(){});
}

// ppid =1 : editscore; ppid =2 : wanted; ppid =3 : cover;
function show_edit_song_control(ppid){
    $("#song_info_table_control").hide('slow',function(){});
    $("#edit_song_control").show('slow',function(){});
    window.location.href="editSong.php?fes="+ppid;
}

function show_edit_anige_control(){
    $("#edit_song_control").hide('slow',function(){});
    $("#edit_anige_control").show('slow',function(){});
}

function check_edit_song(){
    if((document.getElementById("song-title-ro").value !='') ||(document.getElementById("song-title-jp").value !='')){
        if((document.getElementById("singer-ro").value !='') ||(document.getElementById("singer-jp").value !='')){
            if((document.getElementById("composer-ro").value !='') ||(document.getElementById("composer-jp").value !='')){
                if((document.getElementById("arranger-ro").value !='') ||(document.getElementById("arranger-jp").value !='')){
                    if((document.getElementById("fromWhich").value !='')){
                        return true;
                    }else{alert("Please select a anime or game.");}
                }else{alert("Arranger should be filled.");}
            }else{alert("Composer should be filled.");}
        }else{alert("Singer should be filled.");}
    }else{alert("Song Title should be filled.");}
    return false;
}

function EABackToES(){
    $("#edit_anige_control").hide('slow',function(){});
    $("#edit_song_control").show('slow',function(){});
}

function unfinished_score_Staff_table(score_id){
    var url = "process-page.php?unfinished_score_Staff_table=1";
    var dataString = 'score_id='+ score_id;
    $.ajax({
        type: "POST",
        url: url,
        data: dataString,
        success: function(data)
        {
            var response = data.split("|$|",6);
            $("#guj-"+score_id).html(response[1]);
            $("#baj-"+score_id).html(response[2]);
            $("#drj-"+score_id).html(response[3]);
            $("#ssj-"+score_id).html(response[4]);
            $("#mij-"+score_id).html(response[5]);

            $("#unfinished_score_Staff-"+score_id).show('slow',function(){});
            $("#other-staff-but"+score_id).hide('slow',function(){});
        }
    });
}

function show_score_img(){
    $("#chord-progressions").hide('slow',function(){});
    $("#score-img").show('slow',function(){});
}







