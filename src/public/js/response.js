const $responseInput = document.getElementById("response-input"),
    $threadsDiv = document.querySelector('[id^=thread]'),
    $background = document.getElementById("background"),
    toggleLoader = () => {
        $background.classList.toggle("deactive");
        $background.classList.toggle("active");
    };
$responseInput.onkeydown = event => {
    if (event.keyCode === 13) {
        toggleLoader();
        const response = $responseInput.value;
        let id = $threadsDiv.id.split('/'),
            pid = id[1],
            url = 'thread/' + pid;
        fetch(url, {
            headers: {
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify({
                "response": response
            })
        })
            .then(res => res.json())
            .then(res => console.log(res))
            .catch(err => console.log(err))
            .finally(() => {
                toggleLoader();
            });
    }
};
