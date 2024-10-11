

let btnlogin;


function init(){
    console.log("init");
    btnlogin = document.getElementById('btnLogin');
}

let clickevent = function (){
    btnlogin.addEventListener('click', function(){
        let name = document.getElementById('floatingInput').value;
        let pass = document.getElementById('floatingPassword').value;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 

        console.log(pass); 
        console.log(name);
        console.log(token);

        fetch('/login', {
            method: 'POST',
            headers:  {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body:JSON.stringify({
                email: name,
                password: pass
            }), 
        })
        .then(response => response.json())
        .then(data=>{
            console.log(data);
        })
        .catch(error => console.error('Error', error));
        
    });
}

document.addEventListener('DOMContentLoaded', function(){
    init();
    clickevent();
});
