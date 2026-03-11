// Navigate between pages
document.getElementById("goSignup")?.addEventListener("click", () => {
  window.location.href = "signup.html";
});

document.getElementById("goLogin")?.addEventListener("click", () => {
  window.location.href = "index.html";
});

// Optional: handle login/signup button click
document.getElementById("loginBtn")?.addEventListener("click", () => {
  alert("Login button clicked!");
});

document.getElementById("signupBtn")?.addEventListener("click", () => {
  alert("SignUp button clicked!");
});