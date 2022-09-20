const validation = new JustValidate("#signup");

validation
    .addField("#login", [
        {
            rule: "required"
        },
        {
          rule: 'minLength',
          value: 6,
        },
        {
            validator: (value) => () => {
                return fetch("main.controller.php", {
                    method: 'POST',
                    body: JSON.stringify({'login':value}),
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
            errorMessage: "login already exists"
        }
    ])
    .addField("#password", [
        {
            rule: "required"
        },
        {
          rule: 'customRegexp',
          value: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/,
          errorMessage: "Minimum six characters, at least one letter and one number"
        },
        
    ])
    .addField("#name", [
        {
            rule: "required"
        },
        {
          rule: 'customRegexp',
          value: /^[a-zA-Z]{2}$/,
          errorMessage: "Only 2 word character"
        }
    ])
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("main.controller.php", {
                    method: 'POST',
                    body: JSON.stringify({'email':value}),
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
            errorMessage: "email already exists"
        }
        
    ])
    
    .addField("#password_confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ])
    .onSuccess((event) => {
        console.log('onSuccess')
        var form = document.getElementById("signup");
        var formdata = new FormData(form);
     

        fetch('process-signup.php',{
            method: 'POST',
            body: formdata,
        })
        .then(res => res.json())
        .then(data => {
            var statusMsg = document.getElementById('statusMessage');
            statusMsg.innerHTML= `<div class="bar success">
            <i class="ico">&#10004;</i>${data.response}</div>`

            
            
        })
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
