

if(document.querySelector(".update-news")){
    getNewsBody(insertBodyToUpdate)
}


function insertBodyToUpdate(body){
    CKEDITOR.instances.news_body_update.setData(body)
}

