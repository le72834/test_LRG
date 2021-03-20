import { SendMail } from "./components/mail.js";

(() => {

    let mailSubmit = document.querySelector('.submit-wrapper'),
        messageBox = document.querySelector('.mess-sub p'),
        submitCon = document.querySelector('.lightboxCon'),
        close = document.querySelector('.close'),
        lightbox = document.querySelector('.lightbox-contact');
    

    function processMailFailure(result) {
        //show a failure message in the UI
        console.table(result);
        //alert(result.message);
        messageBox.innerHTML = result.message;
    }
    function processMailSuccess(result) {
        //show a success message in the UI
        //table shows an object in table form
        console.table(result);
        //let user know the mail attempt was successful
        //alert(result.message);
        messageBox.innerHTML = result.message;
    }

    function processMail(event) {
        //block the default submit behaviour
        event.preventDefault();

        SendMail(this.parentNode)
        
            .then(data => processMailSuccess(data))
            .catch(err => processMailFailure(err));
    }
    function showLightBox() {
        
        lightbox.classList.add('show-lb');
        
    }
    function closeLightBox() {
        submitCon.classList.add('hidden');
    }


    //eventListener go here
    mailSubmit.addEventListener("click", processMail);
    mailSubmit.addEventListener('click', showLightBox);
   close.addEventListener('click', closeLightBox);

})();