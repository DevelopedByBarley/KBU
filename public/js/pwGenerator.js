const pwGenerators = document.querySelectorAll('.pw-generator');

pwGenerators.forEach(generator => {
    if (generator) {
        generator.addEventListener('click', (e) => {
            e.preventDefault();
            const newPw = generatePassword();
            const password = e.target.parentElement.querySelector('.password');

            if (newPw && newPw !== '') {
                password.value = newPw;
            }

        })
    }
})

function generatePassword(length = 12) {
    const lowerCharset = "abcdefghijklmnopqrstuvwxyz";
    const upperCharset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const numberCharset = "0123456789";
    const specialCharset = "!@#$%";
    const allCharset = lowerCharset + upperCharset + numberCharset + specialCharset;

    let password = "";

    // Biztosítunk egy karaktert minden kategóriából
    password += lowerCharset[Math.floor(Math.random() * lowerCharset.length)];
    password += upperCharset[Math.floor(Math.random() * upperCharset.length)];
    password += numberCharset[Math.floor(Math.random() * numberCharset.length)];
    password += specialCharset[Math.floor(Math.random() * specialCharset.length)];

    // A maradék karaktereket véletlenszerűen válasszuk ki az összes karakterkészletből
    for (let i = 4; i < length; i++) {
        password += allCharset[Math.floor(Math.random() * allCharset.length)];
    }

    // Keverjük össze a jelszó karaktereit
    password = shufflePassword(password);

    return password;
}

function shufflePassword(password) {
    const array = password.split('');
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]]; // Cseréljük fel az elemeket
    }
    return array.join('');
}
