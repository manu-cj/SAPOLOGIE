let sendPicture = document.querySelector('#sendPicture');
let hidden = document.querySelector('#hidden');
let addPicture = document.querySelector('#addPicture');
let updateDescription = document.querySelector('#update');
let classUpdateDescription = document.querySelector('.updateDescription');
let classDescription = document.querySelector('.description');
let updateCharacter = document.querySelector('#updateCharacter');
let formUpdateCharacter = document.querySelector('#formUpdateCharacter');
let characterData = document.querySelector('.character');
let previous = document.querySelector('#previous');
let showUserData = document.querySelector('.showUserData');
let userData = document.querySelector('.userData');
let hideUserData = document.querySelector('.hideUserData');


function showElement(show, hide, hide2) {
    show.style.display = 'initial';
    hide.style.display = 'none';
    hide2.style.display = 'none';
}

function hideElement(show, show2, hide2) {
    show.style.display = 'none';
    show2.style.display = 'block';
    hide2.style.display = 'block';
}

if (updateDescription) {
    updateDescription.addEventListener("click", () => {

        showElement(classUpdateDescription, classDescription, updateDescription);
    });
}
if (sendPicture) {
    sendPicture.addEventListener("click", () => {

        hideElement(sendPicture, hidden, addPicture);
    });
}
if (hidden) {
    hidden.addEventListener("click", () => {

        showElement(sendPicture, hidden, addPicture);
    });
}
if (updateCharacter) {

    updateCharacter.addEventListener("click", () => {
        showElement(formUpdateCharacter, updateCharacter, characterData)
        previous.style.display = 'inline';
    })
}
if (previous) {
    previous.addEventListener("click", () => {
        hideElement(previous, characterData, updateCharacter);
        formUpdateCharacter.style.display = 'none';
    })
}
if (showUserData) {
    showUserData.addEventListener("click", () => {
        hideElement(showUserData, hideUserData,userData);
    })
}
if (hideUserData) {
    hideUserData.addEventListener("click", () => {
        showElement(showUserData, hideUserData,userData);
    })
}
let changeUsernameButton = document.querySelector('.changeUsernameButton');
let changeMailButton = document.querySelector('.changeMailButton');
let changePasswordButton = document.querySelector('.changePasswordButton');
let usernameData = document.querySelector('.userData');
let mailData = document.querySelector('.mailData');
let passwordData = document.querySelector('.passwordData');
let formUsername = document.querySelector('#formUsername');
let formMail = document.querySelector('#formMail');
let formPassword = document.querySelector('#formPassword');

let deleteAccount = document.querySelector('#deleteAccount');
let deleteCheck = document.querySelector('#deleteCheck');
let formDeleteAccount = document.querySelector('#formDeleteAccount');
let yes = document.querySelector('#yes');
let no = document.querySelector('#no');

if (changePasswordButton, changeMailButton, changeUsernameButton) {
    changeUsernameButton.addEventListener("click", () => {
        formUsername.style.display = 'initial';
        formMail.style.display = 'none';
        formPassword.style.display = 'none';
    })
    changeMailButton.addEventListener("click", () => {
        formMail.style.display = 'initial';
        formUsername.style.display = 'none';
        formPassword.style.display = 'none';
    })
    changePasswordButton.addEventListener("click", () => {
        formPassword.style.display = 'initial';
        formMail.style.display = 'none';
        formUsername.style.display = 'none';
    })
}
if (deleteAccount) {
    deleteAccount.addEventListener("click", () => {
        deleteCheck.style.display = 'initial';
        deleteAccount.style.display = 'none';
    })
}
if (deleteCheck) {
    no.addEventListener("click", ()=> {
        deleteAccount.style.display = 'initial';
        deleteCheck.style.display = 'none';
    })
    yes.addEventListener("click", ()=> {
        formDeleteAccount.style.display = 'initial';
        deleteCheck.style.display = 'none';
    })
}












