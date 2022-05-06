function showElement($show, $hide, $hide2) {
    $show.style.display = 'initial';
    $hide.style.display = 'none';
    $hide2.style.display = 'none';
}

function hideElement($show, $show2, $hide2) {
    $show.style.display = 'none';
    $show2.style.display = 'block';
    $hide2.style.display = 'block';
}

let updateDescription = document.querySelector('#update');
let classUpdateDescription = document.querySelector('.updateDescription');
let classDescription = document.querySelector('.description');


updateDescription.addEventListener("click", ()=> {
    showElement(classUpdateDescription, classDescription, updateDescription);
});

let sendPicture = document.querySelector('#sendPicture');
let hidden =  document.querySelector('#hidden');
let addPicture = document.querySelector('#addPicture');
sendPicture.addEventListener("click", ()=> {
    hideElement( sendPicture,hidden, addPicture);
});

hidden.addEventListener("click", ()=> {
    showElement(sendPicture, hidden, addPicture);
});

let character = document.querySelector('#character');
let hideCharacter = document.querySelector('#hide-character');
let allCharacters = document.querySelector('#characters');
hideCharacter.addEventListener("click", ()=> {
    showElement(character, allCharacters, hideCharacter);
})
character.addEventListener("click", ()=> {
    hideElement(character, allCharacters, hideCharacter);

})

let updateCharacter = document.querySelector("#updateCharacter");
let formUpdateCharacter = document.querySelector('#formUpdateCharacter');
let characterData = document.querySelector('.character');
let previous = document.querySelector('#previous');
updateCharacter.addEventListener("click", () =>{
    showElement(formUpdateCharacter, updateCharacter, characterData)
    previous.style.display = 'inline';
})

previous.addEventListener("click", () => {
    hideElement(previous, characterData, updateCharacter);
    formUpdateCharacter.style.display = 'none';
})





