window.onload = function(){

    function getNewsBody(){

        let newsId = document.querySelector(".news-item").dataset.id;
    
        form = new FormData();
        form.append("news-id", newsId);
    
        fetch("get_news_body.php",{
            method: "POST",
            body: form
        })
        .then(res=>res.json())
        .then(json=>{
            insertNewsBody(json)
        })
    } 
     
    function insertNewsBody(data){
        let newsBody = document.querySelector(".news-item-content");
    
        if(CKEDITOR){
            CKEDITOR.instances.editor1.setData(data);
            setTimeout(()=>{
                let content = CKEDITOR.instances.editor1.getData();
                    newsBody.innerHTML = content;
            },1000)
        }
    }
    getNewsBody();
}
