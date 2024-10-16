//----------------------Start of signUP script----------------------------
var currentStep = 1;
const progressBar = document.getElementById("progress");
const form = document.getElementById("signup-form");

//keep inputs in field
var pathname = window.location.pathname;
console.log(pathname);
if (pathname !== "/register") {
    sessionStorage.clear();
}
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signup-form");
    const inputs = form.querySelectorAll(".saveIn");

    console.log(inputs);

    // Load saved data from localStorage

    if (pathname == "/register") {
        inputs.forEach((input) => {
            const savedValue = sessionStorage.getItem(input.name);
            if (savedValue) {
                input.value = savedValue;
            }
        });

        // Save data to localStorage on input change
        inputs.forEach((input) => {
            input.addEventListener("input", function () {
                sessionStorage.setItem(input.name, input.value);
            });
        });
    } else if (pathname == "/login") {
        sessionStorage.clear();
    }
});

//*****************7-2************** */
function checkerrStep3PersonalImg() {
    var testTheErr = document.getElementById("faceError");
    var faceErrMsg = document.getElementById("faceErrMsg");
    var uploadIdCard = document.getElementById("ssnId");
    var passport_id = document.getElementById("passportId");
    var errPssportId = document.getElementById("errPssportId");
    var testssnTheErr = document.getElementById("ssnError");
    console.log;
    if (testTheErr !== null) {
        faceErrMsg.classList.replace("d-none", "d-block");
        var currentStepDiv = document.getElementById("step" + currentStep);
        var nextStepDiv = document.getElementById("step" + (currentStep + 2));
        const selectedCountry = sessionStorage.getItem("country");
        if (selectedCountry === "Egypt") {
            uploadIdCard.classList.remove("d-none");
            passport_id.classList.add("d-none");
        } else {
            uploadIdCard.classList.add("d-none");
            passport_id.classList.remove("d-none");
        }
        currentStepDiv.classList.remove("pageActive");
        nextStepDiv.classList.add("pageActive");
        currentStep = 3;
        updateProgressBar();
    } else if (testssnTheErr !== null || errPssportId !== null) {
        function checkerrStep3PersonalSsn() {
            var currentStepDiv = document.getElementById("step" + currentStep);
            var nextStepDiv = document.getElementById(
                "step" + (currentStep + 2)
            );
            const selectedCountry = sessionStorage.getItem("country");
            if (selectedCountry === "Egypt") {
                uploadIdCard.classList.remove("d-none");
                passport_id.classList.add("d-none");
            } else {
                uploadIdCard.classList.add("d-none");
                passport_id.classList.remove("d-none");
            }
            currentStepDiv.classList.remove("pageActive");
            nextStepDiv.classList.add("pageActive");
            currentStep = 3;
            updateProgressBar();
        }
        checkerrStep3PersonalSsn();
    }
}
checkerrStep3PersonalImg();

//*****************7-2************** */

//******************* */
var regex = {
    pass: /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/,
    phone: /^(01)[0125][0-9]{8}$/,
    name: /^[A-Za-z\s]+$/,
};

function nextStep() {
    const currentStepDiv = document.getElementById("step" + currentStep);
    const nextStepDiv = document.getElementById("step" + (currentStep + 1));
    if (currentStep === 1) {
        if (!validateStep1()) return;
    }
    if (currentStep === 2) {
        if (!validateStep2()) return;
    }
    currentStepDiv.classList.remove("pageActive");
    nextStepDiv.classList.add("pageActive");
    currentStep++;
    updateProgressBar();
}

function previousStep() {
    const currentStepDiv = document.getElementById("step" + currentStep);
    const previousStepDiv = document.getElementById("step" + (currentStep - 1));
    currentStepDiv.classList.remove("pageActive");
    previousStepDiv.classList.add("pageActive");
    currentStep--;
    updateProgressBar();
}

function validateStep1() {
    const signupemail = document.getElementById("semail").value.trim();
    const signupphone = document.getElementById("sphone").value.trim();
    const signuppassword = document.getElementById("spassword").value.trim();
    const confirmPassword = document
        .getElementById("spassword-confirm")
        .value.trim();
    const emailErrMsg = document.getElementById("emailErrMsg");
    const emptyErr = document.getElementById("emptyErr");
    const passErrMsg = document.getElementById("passErrMsg");
    const phoneErrMsg = document.getElementById("phoneErrMsg");
    if (
        signupemail === "" ||
        signupphone === "" ||
        signuppassword === "" ||
        confirmPassword === ""
    ) {
        emptyErr.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Please fill in all fields `;
        highlightEmptyFields();
        return false;
    }
    if (!validateEmail(signupemail)) {
        emailErrMsg.innerHTML = "Please enter a valid email address!";
        document.getElementById("semail").classList.add("is-invalid");
        return false;
    }
    if (regex["pass"].test(signuppassword) == false) {
        passErrMsg.innerHTML =
            "Password must be at least 8 number and contain special chars and upper case chars";
        document.getElementById("spassword").classList.add("is-invalid");
        document
            .getElementById("spassword-confirm")
            .classList.add("is-invalid");
        return false;
    }
    if (signuppassword !== confirmPassword) {
        passErrMsg.innerHTML = "Passwords do not match!";
        document.getElementById("spassword").classList.add("is-invalid");
        document
            .getElementById("spassword-confirm")
            .classList.add("is-invalid");
        return false;
    }
    if (regex["phone"].test(signupphone) == false) {
        phoneErrMsg.innerHTML = "please enter a vaild phone number!";
        document.getElementById("sphone").classList.add("is-invalid");
        return false;
    }
    return true;
}

function validateStep2() {
    const Name = document.getElementById("sname").value.trim();
    const gender = document.getElementById("sgender").value;
    const singupcountry = document.getElementById("scountry").value;
    const birthDate = document.getElementById("sbirth-date").value;
    const favoriteTeam = document.getElementById("sfavorite-team").value;
    const uploadIdCard = document.getElementById("ssnId");
    const passport_id = document.getElementById("passportId");
    const emptyErr2 = document.getElementById("emptyErr2");
    const nameErrMsg = document.getElementById("nameErrMsg");
    if (
        Name === "" ||
        gender === "" ||
        singupcountry === "" ||
        birthDate === "" ||
        favoriteTeam === ""
    ) {
        emptyErr2.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Please fill in all fields `;
        highlightEmptyFields();
        return false;
    }
    // if (regex["name"].test(Name) == false) {
    //     document.getElementById("sname").classList.add("is-invalid");
    //     nameErrMsg.innerText = "Name must not contain numbers or special chars";
    //     return false;
    // }

    // Validate age (16 years or older)
    const currentDate = new Date();
    const selectedDate = new Date(birthDate);
    const age = currentDate.getFullYear() - selectedDate.getFullYear();
    if (age < 16) {
        document.getElementById("age-validation-message").innerText =
            "You must be 16 years or older!";
        return false;
    }
    // Validate birth year (2008 or before)
    if (selectedDate.getFullYear() > 2008) {
        document.getElementById("age-validation-message").innerText =
            "You must be 16 years or older!";
        return false;
    }
    const selectedCountry = singupcountry;

    if (selectedCountry === "Egypt") {
        uploadIdCard.classList.remove("d-none");
        passport_id.classList.add("d-none");
    } else {
        uploadIdCard.classList.add("d-none");
        passport_id.classList.remove("d-none");
    }
    return true;
}

function validateEmail(signupemail) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(signupemail);
}

function updateProgressBar() {
    progressBar.style.width = currentStep * 33.33 + "%";
    progressBar.innerHTML = "Step " + currentStep;
}

function highlightEmptyFields() {
    const currentStepDiv = document.getElementById("step" + currentStep);
    const inputs = currentStepDiv.querySelectorAll("input, select");
    inputs.forEach((input) => {
        if (input.value.trim() === "") {
            input.classList.add("is-invalid");
        } else {
            input.classList.remove("is-invalid");
        }
    });
}

// Remove highlighting when the user starts typing
const inputs = document.querySelectorAll("input, select");
inputs.forEach((input) => {
    input.addEventListener("input", () => {
        input.classList.remove("is-invalid");
        document.getElementById("age-validation-message").innerText = "";
        document.getElementById("emptyErr").innerHTML = "";
        document.getElementById("emptyErr2").innerHTML = "";
    });
});

//28/6

document.getElementById("semail").addEventListener("input", function () {
    document.getElementById("emailErrMsg").innerHTML = "";
    document.getElementById("semail").classList.remove("is-invalid");
});
document.getElementById("spassword").addEventListener("input", function () {
    document.getElementById("passErrMsg").innerHTML = "";
    document.getElementById("spassword").classList.remove("is-invalid");
    document.getElementById("spassword-confirm").classList.remove("is-invalid");
});
document
    .getElementById("spassword-confirm")
    .addEventListener("input", function () {
        document.getElementById("passErrMsg").innerHTML = "";
        document.getElementById("spassword").classList.remove("is-invalid");
        document
            .getElementById("spassword-confirm")
            .classList.remove("is-invalid");
    });

document.getElementById("sphone").addEventListener("input", function () {
    document.getElementById("phoneErrMsg").innerHTML = "";
    document.getElementById("sphone").classList.remove("is-invalid");
});
document.getElementById("sname").addEventListener("input", function () {
    document.getElementById("nameErrMsg").innerHTML = "";
});

//--------------------end of signUP script-------------

//-------confirmaton of admin password------------------
document
    .getElementById("admin-signup-form")
    .addEventListener("submit", function (event) {
        var password = document.getElementById("admin-password").value;
        var confirmPassword = document.getElementById(
            "admin-confirm-password"
        ).value;

        if (password !== confirmPassword) {
            alert("Passwords do not match");
            event.preventDefault();
        } else {
            return true;
        }
    });
