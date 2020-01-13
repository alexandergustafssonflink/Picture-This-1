'use strict';

//when clicking at logout a modal box appears with alternatives logout or cancel

let modalBtnDesktop = document.querySelector("#modal-btn-desktop")
let modalBtn = document.querySelector("#modal-btn");
let modal = document.querySelector(".modal");
let closeBtn = document.querySelector(".close-btn");

modalBtn.onclick = function(){
  modal.style.display = "block"
}

modalBtnDesktop.onclick = function(){
  modal.style.display = "block"
}

closeBtn.onclick = function(){
  modal.style.display = "none"
}
