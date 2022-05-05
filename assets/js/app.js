let updateDescription = document.querySelector('#updateDescription');

updateDescription.addEventListener("click", ()=> {
    document.querySelector('.description').style.display = 'none';
    document.querySelector('.updateDescription').style.display = 'inline';
    updateDescription.style.display = 'none';
});