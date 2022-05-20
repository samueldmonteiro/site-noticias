if(document.querySelector("#show-news-delete-modal")){
    document.querySelector("#show-news-delete-modal").addEventListener("click", showNewsDeleteModal);
}

if(document.querySelector("#news-delete-confirm")){
    document.querySelector("#news-delete-confirm").addEventListener("click", newsDelete);
}

function showNewsDeleteModal(e){
    console.log("news");
    let modal = document.querySelector("#news-delete-modal");
    let newsId = e.currentTarget.closest(".news-item-action").dataset.id;
    modal.dataset.news_id = newsId;
}

async function newsDelete(e){
    let newsId = e.currentTarget.closest("#news-delete-modal").dataset.news_id;
    form = new FormData();
    form.append('news-id',newsId);

    let req = fetch("news_delete.php",{
        method:"POST",
        body:form
    }).then(()=>{
        window.location.href = "index.php";
    })

    
}
