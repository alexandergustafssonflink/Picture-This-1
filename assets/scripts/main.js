'use strict';

/* const hamburgerIcon = document.querySelector(".hamburger-icon");
const navItems = document.querySelector(".nav-items");
const menuContainer = document.querySelector(".nav-bar");

// Function toggles between class names to show/hide menu items and change styling to menu and icon.
hamburgerIcon.addEventListener("click", () => {
  navItems.classList.toggle("show-menu");
  //menuContainer.classList.toggle("change-background");
}); */

let modalBtn = document.querySelector("#modal-btn");
let modal = document.querySelector(".modal");
let closeBtn = document.querySelector(".close-btn");

modalBtn.onclick = function(){
  modal.style.display = "block"
}
closeBtn.onclick = function(){
  modal.style.display = "none"
}

