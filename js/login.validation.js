const validation = new JustValidate("#signup");
var loginPage = 'mama';
validation
    .addField("#login", [
        {
            rule: "required"
        },
        {
            validator: (value) => () => {
                loginPage = value;
                return fetch("main.controller.php", {
                    method: 'POST',
                    body: JSON.stringify({'loginPage':value}),
                })
                       .then(function(response) {
                            return response.json();
                       })
                       .then(function(json) {

                            console.log(json.available)
                            // console.log(json.email)
                            return json.available;
                       });
            },
            errorMessage: "Login is not correct"
        }
    ])
    .addField("#password", [
        {
            rule: "required"
        },
        {
            validator: (value) => () => {
                console.log('This is',loginPage)
                return fetch("main.controller.php", {
                    method: 'POST',
                    body: JSON.stringify({'password':value, 'loginPage': loginPage}),
                })
                       .then(function(response) {
                            return response.json();
                       })
                       .then(function(json) {

                            console.log(json.available)
                            // console.log(json.email)
                            return json.available;
                       });
            },
            errorMessage: "Password is not correct"
        }
        
    ])
    
    
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
