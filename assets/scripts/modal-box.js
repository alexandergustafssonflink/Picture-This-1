'use strict';

//when clicking at logout a modal box appears with alternatives logout or cancel

const modalBtnDesktop = document.querySelector("#modal-btn-desktop")
const modalBtn = document.querySelector("#modal-btn");
const modal = document.querySelector(".modal");
const closeBtn = document.querySelector(".close-btn");

modalBtn.onclick = function() {
  modal.style.display = "block"
}

modalBtnDesktop.onclick = function() {
  modal.style.display = "block"
}

closeBtn.onclick = function() {
  modal.style.display = "none"
}
