const $submitButton = document.getElementById("submit-button"),
    $background = document.getElementById("background"),
    toggleLoader = () => {
        $background.classList.toggle("deactive");
        $background.classList.toggle("active");
    };
$submitButton.onclick = event => {
    event.preventDefault();
    toggleLoader();
    const title = document.getElementById("title-input").value,       
        description = document.getElementById("description-input").value;
    fetch("/thread/create", {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({
            "title": title,
            "description": description
        })
    })
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(err => console.log(err))
        .finally(() => {
            toggleLoader();
        });
};
