
if(document.querySelector("#post-comment")){
    document.querySelector("#post-comment").addEventListener("click",postComment)
}

function postComment(){
    let commentForm = buildCommentForm();

    fetch("news_comment_action.php",{
        method:"POST",
        body: commentForm
    })
    .then(res=>res.json())
    .then(json=>{

        console.log(json)
        if(json.msg == "no login"){
            location.href = "login.php"
        }
        else if(json.type == "success"){
            insertComment.newComment(json.data, true);
        }
    })
}

function buildCommentForm(){
    let newsId = document.querySelector(".news-item").dataset.id;
    let CommentBody = document.querySelector("textarea[name='comment-body']").value;

    let form = new FormData();
    form.append("news-id", newsId);
    form.append("comment-body", CommentBody);
    return form;
}


if(document.querySelector("#more-comments")){
    document.querySelector("#more-comments").addEventListener("click", function(){

        insertComment.numComments += insertComment.numComments;
        console.log("num:",insertComment.numComments);
        insertComment.dumpComments();
    })
}

let insertComment = {

    numComments: 2,
    
    newComment(commentInfo, prepend=false){
        let containerComments = document.querySelector(".container-news-comment-items");

        let newCommentItem = document.querySelector(".news-comment-item").cloneNode(true);
    
        newCommentItem.querySelector(".image-user").src = commentInfo.user_image;
        newCommentItem.querySelector(".username").innerHTML = commentInfo.user_name;
        newCommentItem.querySelector(".post-date").innerHTML = commentInfo.comment_post_date;
        newCommentItem.querySelector(".news-comment-item-body").innerHTML = commentInfo.comment_body;
    
        newCommentItem.style = "display:flex !important;";
        
        if(prepend){
            containerComments.prepend(newCommentItem);
        }else{
            containerComments.appendChild(newCommentItem);
        }
    },


    buildDumpForm(limit){
        form = new FormData();
        form.append("news-id", document.querySelector(".news-item").dataset.id);
        form.append("limit", limit);

        return form;
    },


    dumpComments(){
        let containerComments = document.querySelector(".container-news-comment-items");
        containerComments.innerHTML = "";
        
        fetch("get_comments.php",{
            method:"POST",
            body: insertComment.buildDumpForm(this.numComments)
        })
        .then(res=>res.json())
        .then(json=>{

            json.data.forEach(commentItem => {
                console.log(commentItem);
                insertComment.newComment(commentItem);
            });
        })
    }

   
}

insertComment.dumpComments();