

let btnlogin;
let btnRegister;


function init(){
    console.log("init");
    btnlogin = document.getElementById('btnLogin');
    btnRegister = document.querySelector('#btnRegisterUser');
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

function registerUser(){
    btnRegister.addEventListener('click', function(){

        let contra1 = document.querySelector('#floatingPassword').value;
        let contra2 = document.querySelector('#floatingConfirmPassword').value;
        if(contra1!=contra2){
            console.log("Son diferentes");
        }else{
            console.log("Iguales");
        }
/*
        fetch('/register',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: document.querySelector('#floatingInputName').value,
                email: document.querySelector('#floatingInputEmail').value,
                password: document.querySelector('#floatingPassword').value
            })
        }).then(response=>response.json())
        .then(data=>{
            console.log(data);
        })
        .catch(error => console.log(error));*/
    });
}

document.addEventListener('DOMContentLoaded', function(){
    init();
    //clickevent();
    registerUser();
});
