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
                // const editButton = document.createElement("button");

                const commentInput = commentsForm.querySelector(
                    ".commentInput"
                );

                const commentAuthor = document.createElement("p");
                const comment = document.createElement("p");

                comment.classList.add("comment");

                commentInput.value = "";
                commentAuthor.textContent = response.userEmail;
                commentAuthor.classList.add("commentAuthor");
                comment.textContent = response.comment;
                commentsList.appendChild(listItem);
                listItem.classList.add("commentRow");
                listItem.appendChild(commentAuthor);
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

editButtons = document.querySelectorAll(".editButton");

editButtons.forEach(editButton => {
    editButton.addEventListener("click", function(e) {
        e.preventDefault();
        const editForm = e.target.parentElement.querySelector("form");
        editForm.classList.toggle("hidden");

        const comment = e.target.parentElement.querySelector(".comment")
            .textContent;

        editForm.querySelector("input").value = comment;
    });
});

updateForms = document.querySelectorAll(".updateForm");

updateForms.forEach(updateForm => {
    updateForm.addEventListener("submit", e => {
        e.preventDefault();
        const comment = e.target.parentElement.querySelector(".comment");

        const formData = new FormData(updateForm);
        const editForm = e.target.parentElement.querySelector("form");
        editForm.classList.toggle("hidden");

        fetch("http://localhost:1337/app/comments/update.php", {
            method: "POST",
            body: formData
        })
            .then(function(response) {
                return response.json();
            })
            .then(function(json) {
                const comment = e.target.parentElement.querySelector(
                    ".comment"
                );
                comment.textContent = json;
            });
    });
});
