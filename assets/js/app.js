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

/**
 *
 Function that hides two elements and displays one
 * @param show
 * @param hide
 * @param hide2
 */

function showElement(show, hide, hide2) {
    show.style.display = 'initial';
    hide.style.display = 'none';
    hide2.style.display = 'none';
}

/**
 *
 Function which does the inverse of the showElement function
 * @param show
 * @param show2
 * @param hide2
 */
function hideElement(show, show2, hide2) {
    show.style.display = 'none';
    show2.style.display = 'block';
    hide2.style.display = 'block';
}

if (updateDescription) {
    updateDescription.addEventListener("click", () => {
        showElement(classUpdateDescription, classDescription, updateDescription);
        document.querySelector('input[name=deletePicture]').display = 'none';
        deleteChoice.style.display = 'none';
        previous.style.display = 'inline';
        previous.addEventListener('click', () => {
            hideElement(classUpdateDescription, classDescription, updateDescription);
            document.querySelector('input[name=deletePicture]').display = 'inline';
            deleteChoice.style.display = 'inline';
            previous.style.display = 'none';
        })
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
    faUser.addEventListener("click", () => {
        document.querySelector('#profil').style.display = 'block';
    })
    document.querySelector('#profil').addEventListener("mouseover", () => {
        document.querySelector('#profil').style.display = 'block';
    })

    document.querySelector('#profil').addEventListener("mouseout", () => {
        setTimeout(() => {
            document.querySelector('#profil').style.display = 'none';
        }, 5000)
    })
}

let alert = document.querySelector('.alert');
if (alert) {
    setTimeout(() => {
        alert.remove();
    }, 5000)
}

let profil = document.querySelector('.profil');
if (profil) {
    document.querySelector('.profilMenu').style.width = '100%';
}

let header = document.querySelector('header');


let deleteChoice = document.querySelector('input[name=deleteChoice]');
let deleteChoiceComment = document.querySelector('input[name=deleteChoiceComment]');
if (deleteChoice) {
    deleteChoice.addEventListener("click", () => {
        document.querySelector('#deletePicture').style.display = 'initial';
        document.querySelector('#deletePicture').style.width = '100%';
        document.querySelector('input[name=notDeletePicture]').style.display = 'block';
        deleteChoice.style.display = 'none';
        classUpdateDescription.style.display = 'none';
        updateDescription.style.display = 'none';

        if (document.querySelector('input[name=notDeletePicture]')) {
            document.querySelector('input[name=notDeletePicture]').addEventListener('click', () => {
                document.querySelector('#deletePicture').style.display = 'none';
                document.querySelector('input[name=notDeletePicture]').style.display = 'none';
                deleteChoice.style.display = 'inline';
                updateDescription.style.display = 'inline';
            })
        }
    })
}

if (deleteChoiceComment) {
    deleteChoiceComment.addEventListener("click", () => {
        document.querySelector('input[name=deleteComment]').style.display = 'inline';
        document.querySelector('input[name=notDeleteComment]').style.display = 'inline';
        deleteChoiceComment.style.display = 'none';

        if (document.querySelector('input[name=notDeleteComment]'))
            document.querySelector('input[name=notDeleteComment]').addEventListener("click", () => {
                document.querySelector('input[name=deleteComment]').style.display = 'none';
                document.querySelector('input[name=notDeleteComment]').style.display = 'none';
                deleteChoiceComment.style.display = 'inline';
            })
    })
}

let deleteChoiceCharacter = document.querySelector('input[name=deleteChoiceCharacter]');
if (deleteChoiceCharacter) {
    deleteChoiceCharacter.addEventListener("click", () => {
        document.querySelector('.deleteCharacter').style.display = 'inline';
        document.querySelector('input[name=notDeleteCharacter]').style.display = 'inline';
        deleteChoiceCharacter.style.display = 'none';
        document.querySelector('input[name=notDeleteCharacter]').addEventListener("click", () => {
            document.querySelector('.deleteCharacter').style.display = 'none';
            document.querySelector('input[name=notDeleteCharacter]').style.display = 'none';
            deleteChoiceCharacter.style.display = 'inline';
        })
    })
}

let contactForm = document.querySelector('#contactForm');


let mail = document.querySelector('#mail');
let sujet = document.querySelector('#sujet');


if (mail) {
    mail.addEventListener('keyup', () => {
        if (mail.value === "") {
            mail.setCustomValidity("Cher sapologue veuillez entrer votre addresse mail");
        } else {
            mail.setCustomValidity("");
        }

        if (mail.value.indexOf("@", 0) < 0) {
            mail.setCustomValidity("Cher sapologue veuillez entrer une adresse e-mail valide");
        } else {
            mail.setCustomValidity("");
        }
    })
}
if (sujet) {
    sujet.addEventListener('keyup', () => {
        if (sujet.value === "") {
            sujet.setCustomValidity("Cher sapologue veuillez entrer le sujet de votre message");
        } else {
            sujet.setCustomValidity("");
        }
        if (sujet.value.length <= 2 || sujet.value.length >= 255) {
            sujet.setCustomValidity(" Cher sapologue votre titre doit contenir entre 2 et 255 caractères")
        } else {
            sujet.setCustomValidity("");
        }
    })
}
let sendForm = document.querySelector('#send');
let inputUsername = document.querySelector('#username');
let password = document.querySelector('#password');
let passwordRepeat = document.querySelector('#password-repeat');
let registerForm = document.querySelector("#registerForm");
let loginForm = document.querySelector('#loginForm');
if (loginForm) {
    if (mail.value === "") {
        mail.setCustomValidity("Cher sapologue veuillez entrer votre addresse mail");
    } else {
        mail.setCustomValidity("");
    }

    if (mail.value.indexOf("@", 0) < 0) {
        mail.setCustomValidity("Cher sapologue veuillez entrer une adresse e-mail valide");
    } else {
        mail.setCustomValidity("");
    }
}
if (registerForm) {
        sendForm.addEventListener('click', () => {
            console.log('hello')
            if (inputUsername.value === "") {
                inputUsername.setCustomValidity("Cher sapologue veuillez entrer nom d'utilisateur");
            }
            else {
                inputUsername.setCustomValidity("");
            }

            if (inputUsername.value.length <= 2 || inputUsername.value.length >= 255) {
                inputUsername.setCustomValidity(" Cher sapologue votre nom d'utilisateur doit contenir entre 2 et 255 caractères")
            }
            else {
                inputUsername.setCustomValidity("");
            }

            if (mail.value === "") {
                mail.setCustomValidity("Cher sapologue veuillez entrer votre addresse mail");
            } else {
                mail.setCustomValidity("");
            }

            if (mail.value.indexOf("@", 0) < 0) {
                mail.setCustomValidity("Cher sapologue veuillez entrer une adresse e-mail valide");
            } else {
                mail.setCustomValidity("");
            }

            if (password.value === "") {
                password.setCustomValidity("Cher sapologue veuillez entrer votre mot de passe")
            }
            else {
                password.setCustomValidity("");
            }
            if (password.value.length <= 5) {
                password.setCustomValidity(" Cher sapologue votre mot de passe doit contenir au minimum 5 caractères")
            }
            else {
                password.setCustomValidity("");
            }
            if (passwordRepeat.value === "") {
                passwordRepeat.setCustomValidity("Cher sapologue veuillez entrer votre mot de passe")
            }
            else {
                passwordRepeat.setCustomValidity("");
            }
            if (passwordRepeat.value.length <= 5) {
                passwordRepeat.setCustomValidity(" Cher sapologue votre mot de passe doit contenir au minimum 5 caractères")
            }
            else {
                passwordRepeat.setCustomValidity("");
            }
            if (passwordRepeat.value !== password.value) {
                passwordRepeat.setCustomValidity(" Cher sapologue vos mot de passe doit être identiques")
            }
            else {
                passwordRepeat.setCustomValidity("");
            }
        })

}




















