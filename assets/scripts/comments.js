const posts = document.querySelectorAll(".post-wrapper");
posts.forEach(post => {
    const commentsForm = post.querySelector(".commentsForm");
    const commentsList = post.querySelector(".commentList");

    commentsForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(commentsForm);

        fetch("http://localhost:1337/app/comments/store.php", {
            method: "POST",
            body: formData
        })
            .then(function(response) {
                return response.json();
            })
            .then(function(response) {
                const listItem = document.createElement("li");

                const deleteButton = document.createElement("button");

                const commentInput = commentsForm.querySelector(
                    ".commentInput"
                );

                const comment = document.createElement("p");

                comment.classList.add("comment");

                commentInput.value = "";

                comment.textContent =
                    response.userEmail + ": " + response.comment;
                commentsList.appendChild(listItem);
                listItem.classList.add("commentRow");
                listItem.appendChild(comment);
                listItem.appendChild(deleteButton);

                deleteButton.textContent = "Delete";

                deleteButton.classList.add("deleteButton");

                deleteButton.setAttribute("data-id", response.id);

                deleteButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    fetch(
                        "http://localhost:1337/app/comments/delete.php?id=" +
                            deleteButton.getAttribute("data-id"),
                        {
                            method: "GET"
                        }
                    ).catch(function(error) {
                        console.log(error);
                    });
                    listItem.parentNode.removeChild(listItem);
                });
            });
    });
});

const deleteButtons = document.querySelectorAll(".deleteButton");
const commentRow = document.querySelectorAll(".commentRow");

deleteButtons.forEach(button => {
    button.addEventListener("click", function(e) {
        e.preventDefault();
        fetch(
            "http://localhost:1337/app/comments/delete.php?id=" +
                button.getAttribute("data-id"),
            {
                method: "GET"
            }
        )
            .catch(function(error) {
                console.log(error);
            })
            .then(function(res) {
                var comment = e.srcElement.parentElement.remove();
            });
    });
});
