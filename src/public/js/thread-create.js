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
        discussion = document.getElementById("discussion-input").value;
    fetch("/thread/create", {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({
            "title": title,
            "discussion": discussion
        })
    })
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(err => console.log(err))
        .finally(() => {
            toggleLoader();
        });
};
