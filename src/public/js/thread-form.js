async function displayThreadForm() {
    const titleInput = document.createElement("input"),
        discussionInput = document.createElement("textarea"),
        div = document.createElement("div");
    titleInput.classList.add("swal-content__input");
    titleInput.style.marginBottom = "3%";
    titleInput.placeholder = "Title";
    discussionInput.classList.add("swal-content__textarea");
    discussionInput.placeholder = "Discussion";
    div.appendChild(titleInput);
    div.appendChild(discussionInput);
    const ThreadData = await swal({
        text: "What do you want to discuss?",
        content: div,
        button: {
            text: "Publish",
            closeModal: false,
        },
    });

    if (ThreadData) {
        try {
            const result = await fetch("/thread/create", {
                headers: {
                    'Content-Type': 'application/json'
                },
                method: 'POST',
                body: JSON.stringify({
                    "title": titleInput.value,
                    "discussion": discussionInput.value
                })
            });
            const json = await result.json();
            if (json.response == true) {
                swal("Nice!", "Your thread has been published!", "success");
                location.reload();
            } else {
                swal("Oops!", "Your title or description contains invalid characters :(", "error");
            }
        } catch (err) {
            swal("Oops!", "Seems like we couldn't fetch the info", "error");
        }
    }
}