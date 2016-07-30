// берем обьект окна
var modal = document.getElementById('myModal');
var body = document.getElementById('body');

// кнопка, которая будут открывать окно
var btnOpen = document.getElementById("modalBtn");

// кнопка, которая будет закрывать окно
var btnClose = document.getElementById("modal-close");


//функции закритыя и открытия окна

function modalOpen(){
    modal.style.display = "block";
    body.style.overflow = 'hidden';
}

function modalClose(){
    modal.style.display = "none";
    body.style.overflow = 'auto';
}

// открыть окно по нажатии на кнопку
btnOpen.onclick = function() {
    modalOpen()
};

// закрыть окно по нажатии на кнопку
btnClose.onclick = function() {
    modalClose()
};

// закрыть окно при нажатии на пустую область
window.onclick = function(event) {
    if (event.target == modal) {
        modalClose()
    }
};

// берем обьект окна
var modal_register = document.getElementById('myModal_register');
var body_register = document.getElementById('body');

// кнопка, которая будут открывать окно
var btnOpen_register = document.getElementById("modalBtn_register");

// кнопка, которая будет закрывать окно
var btnClose_register = document.getElementById("modal-close_register");


//функции закритыя и открытия окна

function modalOpen_register(){
    modal_register.style.display = "block";
    body_register.style.overflow = 'hidden';
}

function modalClose_register(){
    modal_register.style.display = "none";
    body_register.style.overflow = 'auto';
}

// открыть окно по нажатии на кнопку
btnOpen_register.onclick = function() {
    modalOpen_register()
};

// закрыть окно по нажатии на кнопку
btnClose_register.onclick = function() {
    modalClose_register()
};

// закрыть окно при нажатии на пустую область
window.onclick = function(event) {
    if (event.target == modal_register  ) {
        modalClose_register()
    }
};
