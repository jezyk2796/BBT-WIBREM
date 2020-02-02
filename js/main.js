// show menu on mobile screen

const showMenu = () => {
  const burger = document.querySelector(".burger");
  const menu = document.querySelector(".menu");
  const menuLinks = document.querySelectorAll(".menu li");
  const bars = document.querySelector(".fa-bars");
  const close = document.querySelector(".fa-times");

  burger.addEventListener("click", () => {
    // toggle nav
    menu.classList.toggle("menu-active");

    // change burger
    bars.classList.toggle("toggle");
    close.classList.toggle("toggle");

    // animation for links
    menuLinks.forEach((link, i) => {
      // if animation exists
      if (link.style.animation) {
        link.style.animation = "";
      } else {
        link.style.animation = `showLinks 0.5s ease forwards ${i / 7 + 0.5}s`;
      }
    });
  });
};

showMenu();

// hide menu

const hideMenu = () => {
  const bars = document.querySelector(".fa-bars");
  const close = document.querySelector(".fa-times");
  const menuLinks = document.querySelectorAll(".menu li");

  document.querySelector(".menu").classList.remove("menu-active");

  bars.classList.toggle("toggle");
  close.classList.toggle("toggle");

  // animation for links
  menuLinks.forEach((link, i) => {
    // if animation exists
    if (link.style.animation) {
      link.style.animation = "";
    } else {
      link.style.animation = `showLinks 0.5s ease forwards ${i / 7 + 0.5}s`;
    }
  });
};

// global variables
const windowWidth = window.innerWidth;
const windowHeight = window.innerHeight;

// navigate to sections

const navigate = e => {
  e.preventDefault();
  const targetId = e.currentTarget.getAttribute("href");
  const navHeight = document.querySelector("nav").offsetHeight;
  const logoLink = e.currentTarget.parentElement;

  if (e.target.innerHTML === 'galeria') {
    window.location.href = './subpages/gallery.html';
  }

  window.scrollTo({
    top:
      targetId === "#"
        ? 0
        : document.querySelector(targetId).offsetTop - navHeight,
    behavior: "smooth"
  });

  if (
    logoLink.classList.value === "logo" ||
    (windowWidth >= 1024 && windowHeight < windowWidth)
  ) {
    return;
  } else {
    hideMenu();
  }
};

const allA = document.querySelectorAll(".menu a");
allA.forEach(link => link.addEventListener("click", navigate));
document.querySelector(".logo a").addEventListener("click", navigate);

const setBgcHeight = () => {
  const bgc = document.querySelector(".background");
  const fluentDiv = document.querySelector(".about .wrapper");

  if (windowWidth >= 1024 && windowHeight < windowWidth) {
    bgc.style.height = `${fluentDiv.clientHeight}px`;
  }
};

setBgcHeight();
window.addEventListener("load", setBgcHeight);

// TO DO AGAIN AND BETTER
