/* Open when someone clicks on the span element */
function openNav() {
    document.getElementById("navMenu").style.width = "100%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
    document.getElementById("navMenu").style.width = "0%";
}

function showPassword() {
    console.log("hi")
    let showPass = document.getElementById("showPass");
    let pword = document.getElementById("password");
    
    if (showPass.className == "far fa-eye form-icon-right") {
        showPass.className = "far fa-eye-slash form-icon-right";
    }
    else{
        showPass.className = "far fa-eye form-icon-right";
    }
    
    if (pword.type === "password") {
        pword.type = "text";
    }
    else {
        pword.type = "password";
    }
}
