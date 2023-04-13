document.addEventListener('DOMContentLoaded', () => {
    let btnFormActive = document.querySelector(".btn.btn-primary.create");
    let form = document.getElementById("exampleModal");
    let btnClose = document.getElementById("btn-close");
    if (form) {
        btnFormActive.addEventListener("click", () => {
            form.classList.add("show");
            form.style.display = "block";
        });
    }
    if (form) {
        btnClose.addEventListener("click", () => {
            form.classList.remove("show");
            form.style.display = "none";
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    let button = document.querySelector('.form__comment button');
    let box = document.querySelector('.alert');
    if (button) {
        button.addEventListener("click", function (even) {
            even.preventDefault();
            let text = document.querySelector('textarea[name="text"]');
            let img = document.querySelector('input[name="img"]');
            let formData = new FormData();
            formData.append('text', text.value);
            if (img.files[0]) {
                formData.append('img', img.files[0]);
            }
            fetch(routeFormComment, {
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            }).then(data => {
                return data.json();
            }).then(data2 => {
                box.innerHTML = "";
                if (data2["success"]) {
                    box.className = "alert alert-success";
                    return box.innerHTML = `<p>${data2["success"]}</p>`;
                }
                for (const property in data2) {
                    if (typeof data2[property] === "object") {
                        box.className = "alert alert-danger";
                        for (const error in data2[property]) {
                            data2[property][error].forEach(item => {
                                box.innerHTML += `<li>${item}</li>`
                            })
                        }
                    }

                }

            });
            text.value = "";
            text.innerHTML = "";
            img.value = '';
        })
    }
});


document.addEventListener('DOMContentLoaded', () => {
    let deleteCommentButton = document.querySelectorAll('.form__comment-delete button');
    let commentsAuthor = document.querySelectorAll('.comments-author');
    commentAdminAjaxDelate(deleteCommentButton)

    function commentAdminAjaxDelate(buttonElement) {
        buttonElement.forEach((button, index) => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                let route = button.getAttribute("data-route");
                let routeShowPost = button.getAttribute("data-idPost");
                fetch(route, {
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                }).then(data => {
                    return data.json();
                }).then(data2 => {
                    commentsAuthor[index].style.display = "none";
                    fetch(routeShowPost, {
                        method: "GET",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    }).then(data => {
                        return data.json();
                    }).then(data2 => {
                        if (data2['post_id']) {
                            let data_id = data2['post_id'];
                            let dropdown_content_ths = document.querySelector('.post[data-postId="' + data_id + '"]');
                            dropdown_content_ths.style.display = "none";
                        }
                    })
                });
            })
        })
    }

    let approvedCommentButton = document.querySelectorAll('.form__comment-admin button');
    approvedComment(approvedCommentButton);
    function approvedComment(button) {
        button.forEach((button, index) => {
            button.addEventListener("click", function (even) {
                even.preventDefault();
                let routeFormComment = button.getAttribute("data-route");
                let routeShowPost = button.getAttribute("data-idPost");
                let dataForm = button.getAttribute("data-form");
                let text = document.querySelector(`textarea[name="text-${dataForm}"]`);
                let img = document.querySelector(`input[name="img-${dataForm}"]`);
                let formData = new FormData();
                formData.append('text', text.value);
                if (img.files[0]) {
                    formData.append('img', img.files[0]);
                }
                fetch(routeFormComment, {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                }).then(data => {
                    return data.json();
                }).then(data2 => {
                    commentsAuthor[index].style.display = "none";
                    fetch(routeShowPost, {
                        method: "GET",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    }).then(data => {
                        return data.json();
                    }).then(data2 => {
                        if (data2['post_id']) {
                            let data_id = data2['post_id'];
                            let dropdown_content_ths = document.querySelector('.post[data-postId="' + data_id + '"]');
                            dropdown_content_ths.style.display = "none";
                        }
                    })
                })
            });
        })
    }
});
