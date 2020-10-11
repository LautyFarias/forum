(()=>{
const $responseInput = document.getElementById("response-input"),
    $threadsDiv = document.querySelector('[id^=thread]'),
    $background = document.getElementById("background"),
    toggleLoader = () => {
        $background.classList.toggle("deactive");
        $background.classList.toggle("active");
    };
$responseInput.onkeydown = event => {
    if (event.code === "Enter") {
        toggleLoader();
        const response = $responseInput.value;
        let id = $threadsDiv.id;
        fetch('/' + id, {
            headers: {
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify({
                "response": response
            })
        })
            .then(res => res.text())
            .then(res => location.reload())
            .catch(err => console.log(err))
            .finally(() => {
                toggleLoader();
                $responseInput.value = '';
            });
    }
};
})();