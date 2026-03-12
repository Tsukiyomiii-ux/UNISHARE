// Navigate between pages
document.addEventListener('DOMContentLoaded', function() {
    // Go to Signup page from Login page
    const goSignup = document.getElementById("goSignup");
    if (goSignup) {
        goSignup.addEventListener("click", () => {
            window.location.href = "signup.html";
        });
    }

    // Go to Login page from Signup page
    const goLogin = document.getElementById("goLogin");
    if (goLogin) {
        goLogin.addEventListener("click", () => {
            window.location.href = "login.html"; // Fixed: was index.html
        });
    }

    // Optional: Remove these if buttons don't exist in HTML
    // document.getElementById("loginBtn")?.addEventListener("click", () => {
    //     alert("Login button clicked!");
    // });

    // document.getElementById("signupBtn")?.addEventListener("click", () => {
    //     alert("SignUp button clicked!");
    // });
});


// // Navigate between pages
// document.getElementById("goSignup")?.addEventListener("click", () => {
//   window.location.href = "signup.html";
// });

// document.getElementById("goLogin")?.addEventListener("click", () => {
//   window.location.href = "index.html";
// });

// // Optional: handle login/signup button click
// document.getElementById("loginBtn")?.addEventListener("click", () => {
//   alert("Login button clicked!");
// });

// document.getElementById("signupBtn")?.addEventListener("click", () => {
//   alert("SignUp button clicked!");
// });