if(document.querySelector(".form-register")){
    document.querySelector(".form-register").addEventListener("submit",buildRegisterForm);
}

function buildRegisterForm(e){    
    e.preventDefault();
    form = e.currentTarget;
    formData = new FormData(form);
    sendRegisterForm(formData);
}

function sendRegisterForm(form){

    fetch("register_action.php",{
        method:"POST",
        body:form
    })
    .then(res=>res.json())
    .then((json)=>{

        displayMessage(json.type, json.msg);

        if(json.type == "success"){
            setTimeout(()=>{
                window.location.reload();
            },1000)
        }
    })
}

