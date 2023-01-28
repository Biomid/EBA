function show1() {
    let x = document.getElementById("element");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

let error = document.querySelector(".error-mes"),
    form = document.querySelector(".myform"),
    code,
    temp;

function onchange() {
    code = $('input[name = "code"]').val();
    if (code.length === temp.length) {
        $.ajax({
            url: 'confirm.php',
            method: 'POST',
            dataType: 'json',
            data: {
                code: code
            },
            success(data) {
                error.innerHTML = data.good;
                temp = data.mytext;
                setTimeout(function () {
                    form.reset();
                }, 3000);
               


            }
        });
    }
}


$(document).ready(function () {
    console.log("ready!");
    $(".send-code").on('click', function (e) {
        e.preventDefault();
        code = $('input[name = "code"]').val();

        $.ajax({
            url: 'confirm.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
                code: code
            },
            success(data) {
                setTimeout(function () {
                    form.reset();
                }, 3000);
                error.innerHTML = data.good;
                temp = data.mytext;
                //code = "";

                form.addEventListener("change", onchange);

            }
        });
    });
});
