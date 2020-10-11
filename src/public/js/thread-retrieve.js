(() => {
    const $threadsDivs = document.querySelectorAll('[id^=thread]'),
    $background = document.getElementById("background"),
    toggleLoader = () => {
        $background.classList.toggle("deactive");
        $background.classList.toggle("active");
    };
    $threadsDivs.forEach(element => {
        element.onclick = event => {
            toggleLoader();
            let id = element.id.split('/'),
                pid = id[1],
                url = '/thread/' + pid;
            window.location.href = url;
        };
    });
})();
