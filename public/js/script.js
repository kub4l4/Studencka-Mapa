const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');


function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

emailInput.addEventListener('keyup', function () {
    setTimeout(function () {
        markValidation(emailInput, isEmail(emailInput.value));
    }, 1000);
});


function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

confirmedPasswordInput.addEventListener('keyup', function () {
    setTimeout(function () {
        const condition = arePasswordsSame(
            confirmedPasswordInput.previousElementSibling.value,
            confirmedPasswordInput.value
        );
        markValidation(confirmedPasswordInput, condition);
    }, 1000);
});


function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid')
}


//TODO PASSWORD STRENGHT
//TODO EMPTY INPUT

form.addEventListener("submit", e => {
    e.preventDefault();

    //TODO check again if form is valid after submitting it
});
