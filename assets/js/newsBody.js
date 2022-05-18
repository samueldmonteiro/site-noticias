    function getNewsBody(insert){
        let newsId = document.querySelector(".news-item").dataset.id;
    
        form = new FormData();
        form.append("news-id", newsId);
    
        fetch("get_news_body.php",{
            method: "POST",
            body: form
        })
        .then(res=>res.json())
        .then(json=>{
            insert(json)
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

    if(document.querySelector(".news-item-content")){
        getNewsBody(insertNewsBody)
    }

