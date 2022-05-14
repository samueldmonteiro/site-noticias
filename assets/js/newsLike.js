if(document.querySelector("#news-like")){
    document.querySelectorAll("#news-like").forEach(newsButtonLike=>{
        newsButtonLike.addEventListener("click",execActionLike)
    })
}


function execActionLike(e){

    let newsButtonLike = e.currentTarget;

    let newsId = newsButtonLike.closest(".news-item-action").dataset.id;

    let form = new FormData();
    form.append("news-id", newsId);

    fetch("news_like_action.php", {

        method:"POST",
        body: form
    })
    .then(res=>res.json())
    .then(json=>{
         
        if(json.type == "success"){
            changeLikeState(newsButtonLike);
        }else{
            window.location.href = "login.php";
        }
    })

    
}

function changeLikeState(e){

    let numLikes = e.querySelector("#num-likes");
    let likeIcon = e.querySelector("i");

    if(likeIcon.classList.contains("bi-heart")){
        likeIcon.classList.remove("bi-heart");
        likeIcon.classList.add("bi-heart-fill");

        numLikes.innerHTML  = parseInt(numLikes.innerHTML) + 1;

    }else{
        likeIcon.classList.add("bi-heart");
        likeIcon.classList.remove("bi-heart-fill");

        if(numLikes.innerHTML != "0"){
            numLikes.innerHTML = parseInt(numLikes.innerHTML) - 1;
        }
    }
}