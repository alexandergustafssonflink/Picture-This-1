'use strict';

const menuContainer = document.querySelector(".mobile-navbar");
const hamburgerIcon = document.querySelector(".hamburger-icon");

//toggles classnames to show menu 
hamburgerIcon.addEventListener("click", () => {
  menuContainer.classList.toggle("show-menu");
  hamburgerIcon.classList.toggle("change");
});


