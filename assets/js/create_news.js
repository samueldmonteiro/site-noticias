if(document.querySelector("#create-news")){
    document.querySelector("#create-news").addEventListener("click",buildNewsForm);
}

function buildNewsForm(e){
    e.preventDefault();

    let newsTitle = document.querySelector("input[name='news-title']").value;
    let newsSubject = document.querySelector("input[name='news-subject']").value;
    let newsCategory = document.querySelector("select[name='news-category']").value;
    let newsCover = document.querySelector("input[type='file']").files[0];
    let newsBody = CKEDITOR.instances.news_body.getData();

    formData = new FormData();
    formData.append("news-title", newsTitle);
    formData.append("news-subject", newsSubject);
    formData.append("news-body", newsBody);
    formData.append("news-category", newsCategory);
    formData.append("news-cover", newsCover);

    sendNewsForm(formData);  
}

function sendNewsForm(form){

    fetch("create_news_action.php",{
        method: "POST",
        body: form
    })
    .then(res => res.json())
    .then(json=>{
        
        console.log(json);
        displayMessage(json.type, json.msg, 2000);
    })
}

