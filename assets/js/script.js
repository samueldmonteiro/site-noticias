function displayMessage(type, msg, displayTime=false){
    
    message = document.querySelector(".message");
    message.classList.remove("hide-message");
    message.classList.add("show-message");

    if(type == "error"){
        message.classList.add("alert-danger");
        message.classList.remove("alert-primary");

    }else if(type == "success"){
        message.classList.remove("alert-danger");
        message.classList.add("alert-primary");
    }

    message.innerText = msg;

    if(displayTime){
        setTimeout(()=>{
            message.classList.remove("show-message");
            message.classList.add("hide-message");
        }, displayTime)
    }
}

