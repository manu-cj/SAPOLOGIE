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
        document.querySelector('input[name=deletePicture]').display = 'none';
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
        hideElement(showUserData, hideUserData, userData);
    })
}
if (hideUserData) {
    hideUserData.addEventListener("click", () => {
        showElement(showUserData, hideUserData, userData);
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
        if (formDeleteAccount, deleteCheck, deleteAccount) {
            formDeleteAccount.style.display = 'none';
            deleteCheck.style.display = 'none';
            deleteAccount.style.display = 'none';
        }
    })
    changeMailButton.addEventListener("click", () => {
        formMail.style.display = 'initial';
        formUsername.style.display = 'none';
        formPassword.style.display = 'none';
        if (formDeleteAccount, deleteCheck, deleteAccount) {
            formDeleteAccount.style.display = 'none';
            deleteCheck.style.display = 'none';
            deleteAccount.style.display = 'none';
        }
    })
    changePasswordButton.addEventListener("click", () => {
        formPassword.style.display = 'initial';
        formMail.style.display = 'none';
        formUsername.style.display = 'none';
        if (formDeleteAccount, deleteCheck, deleteAccount) {
            formDeleteAccount.style.display = 'none';
            deleteCheck.style.display = 'none';
            deleteAccount.style.display = 'none';
        }
    })
}
if (deleteAccount) {
    deleteAccount.addEventListener("click", () => {
        deleteCheck.style.display = 'initial';
        deleteAccount.style.display = 'none';
    })
}
if (deleteCheck) {
    no.addEventListener("click", () => {
        deleteAccount.style.display = 'initial';
        deleteCheck.style.display = 'none';
    })
    yes.addEventListener("click", () => {
        formDeleteAccount.style.display = 'initial';
        deleteCheck.style.display = 'none';
    })
}

let faUser = document.querySelector('.profil');

if (faUser) {
    let clic = 1;
    faUser.addEventListener("click", () => {
        document.querySelector('#profil').style.display = 'block';
    })
    document.querySelector('#profil').addEventListener("mouseover", () => {
        document.querySelector('#profil').style.display = 'block';
    })

    document.querySelector('#profil').addEventListener("mouseout", () => {
        setTimeout(()=> {
            document.querySelector('#profil').style.display = 'none';
        }, 2500)
    })
}

let alert = document.querySelector('.alert');
if (alert) {
    setTimeout(()=>{
        alert.remove();
    }, 5000)
}

let profil = document.querySelector('.profil');
if (profil) {
    document.querySelector('.profilMenu').style.width = '100%';
}

let  header = document.querySelector('header');

if (header) {
    header.addEventListener('mouseover', ()=> {
        document.querySelector('.menu').style.height = '100px';
        document.querySelector('input[name=searchBar]').style.animationName = 'searchBar';
        document.querySelector('input[name=searchBar]').style.animationDuration = '2s';
        document.querySelector('input[name=searchBar]').style.width = '150px';


    })
    header.addEventListener('mouseout', ()=> {
        document.querySelector('.menu').style.height = '65px';
        document.querySelector('input[name=searchBar]').style.animationName = '';
        document.querySelector('input[name=searchBar]').style.width = '30px';
    })
}

let deleteChoice = document.querySelector('input[name=deleteChoice]');
let deleteChoiceComment = document.querySelector('input[name=deleteChoiceComment]');
if (deleteChoice) {
    deleteChoice.addEventListener("click", ()=>{
       document.querySelector('input[name=deletePicture]').style.display = 'inline';
        document.querySelector('input[name=notDeletePicture]').style.display = 'inline';
        deleteChoice.style.display = 'none';
        document.querySelector('input[name=notDeletePicture]').addEventListener('click', ()=> {
            document.querySelector('input[name=deletePicture]').style.display = 'none';
            document.querySelector('input[name=notDeletePicture]').style.display = 'none';
            deleteChoice.style.display = 'inline';
        })
    })
}
if (deleteChoiceComment) {
    deleteChoiceComment.addEventListener("click", ()=> {
        document.querySelector('input[name=deleteComment]').style.display = 'inline';
        document.querySelector('input[name=notDeleteComment]').style.display = 'inline';
        deleteChoiceComment.style.display = 'none';
        document.querySelector('input[name=notDeleteComment]').addEventListener("click", ()=> {
            document.querySelector('input[name=deleteComment]').style.display = 'none';
            document.querySelector('input[name=notDeleteComment]').style.display = 'none';
            deleteChoiceComment.style.display = 'inline';
        })

    })
}
















