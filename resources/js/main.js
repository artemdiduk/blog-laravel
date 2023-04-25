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
    if (button) {
        button.addEventListener("click", function (even) {
            even.preventDefault();
            let box = document.querySelector('.alert');
            let text = document.querySelector('textarea[name="text"]');
            let img = document.querySelector('input[name="img"]');
            let routeComment = button.getAttribute("data-routeComment");
            commentAjax(box, routeComment, text, img);
            clearValue(text, img)
        })
    }
    function clearValue(text, img) {
        text.value = "";
        text.innerHTML = "";
        img.value = '';
    }
    function commentAjax(boxInfo, routeComments, text, img, reload = false) {
        let formData = new FormData();
        formData.append('text', text.value);
        if (img.files[0]) {
            formData.append('img', img.files[0]);
        }
        fetch(routeComments, {
            method: "POST",
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        }).then(data => {
            return data.json();
        }).then(data2 => {
            boxInfo.innerHTML = "";
            if (data2["success"]) {
                if (reload) {
                    return location.reload()
                }
                boxInfo.className = "alert alert-success";
                return boxInfo.innerHTML = `<p>${data2["success"]}</p>`;
            }
            for (const property in data2) {
                if (typeof data2[property] === "object") {
                    boxInfo.className = "alert alert-danger";
                    for (const error in data2[property]) {
                        data2[property][error].forEach(item => {
                            boxInfo.innerHTML += `<li>${item}</li>`
                        })
                    }
                }

            }

        });
    }
    let buttons = document.querySelectorAll(".form__comment-admin button");
    let boxs = document.querySelectorAll('.alert');
    let texts = document.querySelectorAll('textarea[name="text"]');
    let imgs = document.querySelectorAll('input[name="img"]');
    buttons.forEach((button, index) => {
        button.addEventListener("click", function (even) {
            even.preventDefault();
            let routeComment = button.getAttribute("data-routeComment");
            commentAjax(boxs[index], routeComment, texts[index], imgs[index], true)
        })
    })

});


document.addEventListener('DOMContentLoaded', () => {
    let likeElement = document.querySelector('.like__icon');
    let buttonLike = document.querySelector('.wrapper__like form button')
    if (buttonLike) {
        buttonLike.addEventListener("click", function (even) {
            even.preventDefault();
            let countLike = document.querySelector(".wrapper__like span");
            let routeLike = buttonLike.getAttribute("data-route");
            if (likeElement.classList.contains('like')) {
                countLikeActual(countLike, false);
                likeElement.classList.remove('like');
            }
            else {
                countLikeActual(countLike);
                likeElement.classList.add('like');
            }
            fetch(routeLike, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json;charset=utf-8'
                }
            })
        })
    }
    function countLikeActual(element, addLike = true) {
        let count = +element.textContent;
        if (!addLike) {
            return element.textContent = count - 1;
        }
        element.textContent = count + 1;
    }
});
