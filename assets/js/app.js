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












