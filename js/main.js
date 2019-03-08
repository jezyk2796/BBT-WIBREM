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

// navigate to sections

const navigate = e => {
  e.preventDefault();
  const targetId = e.currentTarget.getAttribute("href");
  const navHeight = document.querySelector("nav").offsetHeight;
  const logoLink = e.currentTarget.parentElement;

  window.scrollTo({
    top:
      targetId === "#"
        ? 0
        : document.querySelector(targetId).offsetTop - navHeight,
    behavior: "smooth"
  });

  if (logoLink.classList.value === "logo") {
    return;
  } else {
    hideMenu();
  }
};

const allA = document.querySelectorAll(".menu a");
allA.forEach(link => link.addEventListener("click", navigate));

document.querySelector(".logo a").addEventListener("click", navigate);

// DO IT AGAIN AND BETTER
