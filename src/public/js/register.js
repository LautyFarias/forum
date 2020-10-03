const $submitButton = document.getElementById("submit-button"),
    $background = document.getElementById("background"),
    toggleLoader = () => {
        $background.classList.toggle("deactive");
        $background.classList.toggle("active");
    };
$submitButton.onclick = event => {
    event.preventDefault();
    toggleLoader();
    const email = document.getElementById("email-input").value,
        username = document.getElementById("username-input").value,
        password = document.getElementById("password-input").value,
        repassword = document.getElementById("repassword-input").value,
        description = document.getElementById("description-input").value;
    fetch("/register", {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({
            "email": email,
            "username": username,
            "password": password,
            "repassword": repassword,
            "description": description,
        })
    })
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(err => console.log(err))
        .finally(() => {
            toggleLoader();
        });
};
