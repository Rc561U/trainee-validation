let btn = document.getElementById("sendquery")
let butPannel = document.getElementById("signout")
let signin = document.getElementById("signin")
btn.addEventListener('click', function(e) {
// Prevent default behavior:
    e.preventDefault();
    fetch('main.controller.php', {
        method: 'POST',
        body: JSON.stringify({'destroy': 'session'}),
        })
    .then(res => res.json())
    .then(data => {
        
        
        butPannel.innerHTML= `<div class="alert alert-success" role="alert">
                                                                <input class="btn" type="button" onclick="location.href='index.html';" value="SignUp" />
                                                                <input class="btn" type="button" onclick="location.href='login-page.html';" value="Login" />
                                                            </div>`
        
        
        console.log(data.session)});

})
