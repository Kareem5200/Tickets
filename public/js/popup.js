document.addEventListener("DOMContentLoaded", function () {
    var buttons = document.querySelectorAll(".toggle-button");
    var divs = document.querySelectorAll(".toggle-div");

    buttons.forEach(function (button, index) {
        button.addEventListener("click", function () {
            // Hide all divs
            divs.forEach(function (div) {
                div.style.display = "none";
            });

            // Show the corresponding div
            divs[index].style.display = "block";
            document.getElementById("overlay").style.display = "block";
        });
    });
});

function cancelPopUp() {
    document.getElementById("overlay").style.display = "none";
    var elements = document.getElementsByClassName("toggle-div");
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
}
}
