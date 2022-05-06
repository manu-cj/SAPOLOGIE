let updateDescription = document.querySelector('#updateDescription');

updateDescription.addEventListener("click", ()=> {
    document.querySelector('.description').style.display = 'none';
    document.querySelector('.updateDescription').style.display = 'inline';
    updateDescription.style.display = 'none';
});

let sendPicture = document.querySelector('#sendPicture');
let hidden =  document.querySelector('#hidden');
sendPicture.addEventListener("click", ()=> {
    document.querySelector('#addPicture').style.display = 'inline';
    hidden.style.display = '';
    sendPicture.style.display = 'none';
});

hidden.addEventListener("click", ()=> {
    document.querySelector('#addPicture').style.display = 'none';
    hidden.style.display = 'none';
    sendPicture.style.display = 'inline';
});

let character = document.querySelector('#character');
let hideCharacter = document.querySelector('#hide-character');

hideCharacter.addEventListener("click", ()=> {
    character.style.display = '';
    document.querySelector('#characters').style.display = 'none'
    hideCharacter.style.display = 'none';
})
character.addEventListener("click", ()=> {
    character.style.display = 'none';
    document.querySelector('#characters').style.display = ''
    hideCharacter.style.display = '';
})

function hideElement($show, $hide, $hide2) {
    $hide.style.display = 'none';
    $show.style.display = '';
    $hide2.style.display = '';
}
