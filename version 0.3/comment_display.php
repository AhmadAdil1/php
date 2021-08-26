<html>

<head>
    <style>
        body {
            font-family: Arial;
            width: 550px;
        }

        .comment-form-container {
            background: #F0F0F0;
            border: #e0dfdf 1px solid;
            padding: 20px;
            border-radius: 2px;
        }

        .input-row {
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            border-radius: 2px;
            padding: 10px;
            border: #e0dfdf 1px solid;
        }

        .btn-submit {
            padding: 10px 20px;
            background: #333;
            border: #1d1d1d 1px solid;
            color: #f0f0f0;
            font-size: 0.9em;
            width: 100px;
            border-radius: 2px;
            cursor: pointer;
        }

        ul {
            list-style-type: none;
        }

        .comment-row {
            border-bottom: #e0dfdf 1px solid;
            margin-bottom: 15px;
            padding: 15px;
        }

        .outer-comment {
            background: #F0F0F0;
            padding: 20px;
            border: #dedddd 1px solid;
        }

        span.commet-row-label {
            font-style: italic;
        }

        span.posted-by {
            color: #09F;
        }

        .comment-info {
            font-size: 0.8em;
        }

        .comment-text {
            margin: 10px 0px;
        }

        .btn-reply {
            font-size: 0.8em;
            text-decoration: underline;
            color: #888787;
            cursor: pointer;
        }

        #comment-message {
            margin-left: 20px;
            color: #189a18;
            display: none;
        }
    </style>
    <title>Comment System using PHP and Ajax</title>
    <script src="jquery-3.2.1.min.js"></script>


<body>
    <!-- <h1>Comment System using PHP and Ajax</h1> -->
    <div class="comment-form-container">
        <form id="frm-comment">
            <div class="input-row">
                <input type="hidden" name="comment_id" id="commentId" placeholder="Name" />
                 <input class="input-field" type="hidden" name="name" id="name" Value="<?php echo $_GET['user_email']; ?>" placeholder="Name" />
            </div>
            <div class="input-row">
                <input type="hidden" name="audio_id" id="audio_Id" value="<?php echo $_GET['audio_id']; ?>" />
            </div>

            <div class="input-row">
                <p id="reply_name"></p>
                <textarea class="input-field" type="text" name="comment" id="comment" placeholder="Add a Comment" >  </textarea>
            </div>
            <div>
                <input type="button" class="btn-submit" id="submitButton" value="Publish" />
                <div id="comment-message">Comments Added Successfully!</div>
            </div>

        </form>
    </div>
    <div id="output"></div>
    <script>
        function postReply(commentId,replyName) {
            $('#commentId').val(commentId);
            $('#reply_name').text("> you are replying to "+replyName);
            $("#comment").focus();
        }

        $("#submitButton").click(function() {
            $("#comment-message").css('display', 'none');
            var str = $("#frm-comment").serialize();

            $.ajax({
                url: "comment-add.php",
                data: str,
                type: 'post',
                success: function(response) {
                    var result = eval('(' + response + ')');
                    if (response) {
                        $("#comment-message").css('display', 'inline-block');
                        $("#name").val("<?php echo $_GET['user_email']; ?>");
                        $("#comment").val("");
                        $("#reply_name").text("");
                        $("#commentId").val("");
                        listComment();
                    } else {
                        alert("Failed to add comments !");
                        return false;
                    }
                }
            });
        });

        $(document).ready(function() {
            listComment();
        });

        function listComment() {
            // TODO: send audio id
            $.post("comment-list.php?audio_id="+<?php echo $_GET['audio_id']; ?>,
                function(data) {
                    var data = JSON.parse(data);

                    var comments = "";
                    var replies = "";
                    var item = "";
                    var parent = -1;
                    var results = new Array();

                    var list = $("<ul class='outer-comment'>");
                    var item = $("<li>").html(comments);

                    for (var i = 0;
                        (i < data.length); i++) {
                        var commentId = data[i]['comment_id'];
                        parent = data[i]['parent_comment_id'];

                        if (parent == "0") {
                            comments = "<div class='comment-row'>" +
                                "<div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" +
                                "<div class='comment-text'>" + data[i]['comment'] + "</div>" +
                                "<div><a class='btn-reply' onClick='postReply(" + commentId + ",\"" + data[i]['comment_sender_name']+"\")'>Reply</a></div>" +
                                "</div>";

                            var item = $("<li>").html(comments);
                            list.append(item);
                            var reply_list = $('<ul>');
                            item.append(reply_list);
                            listReplies(commentId, data, reply_list);
                        }
                    }
                    $("#output").html(list);
                });
        }

        function listReplies(commentId, data, list) {
            for (var i = 0;
                (i < data.length); i++) {
                if (commentId == data[i].parent_comment_id) {
                    var comments = "<div class='comment-row'>" +
                        " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" +
                        "<div class='comment-text'>" + data[i]['comment'] + "</div>" +
                        "<div><a class='btn-reply' onClick='postReply(" + data[i]['comment_id'] + ",\"" + data[i]['comment_sender_name']+"\")'>Reply</a></div>" +
                        "</div>";
                    var item = $("<li>").html(comments);
                    var reply_list = $('<ul>');
                    list.append(item);
                    item.append(reply_list);
                    listReplies(data[i].comment_id, data, reply_list);
                }
            }
        }
    </script>


</body>

</html>