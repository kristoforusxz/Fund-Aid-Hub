document.addEventListener("DOMContentLoaded", function() {
    const username = sessionStorage.getItem("username");

    if (username) {
        const loginButton = document.getElementById("loginButton");
        loginButton.textContent = username;
        loginButton.href = "#";
    }
});
