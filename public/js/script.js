const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".nav-pill-group .nav-link");

window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach((section) => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.offsetHeight;

        if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
            current = section.getAttribute("id");
        }
    });

    navLinks.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${current}`) {
            link.classList.add("active");
        }
    });
});

//typing animation
const words = [
    "Game Developer",
    "Graphic Designer",
    "Video Editor",
    "Web Designer",
];

let index = 0;
const textEl = document.getElementById("typed");

function changeText() {
    textEl.classList.remove("show");

    setTimeout(() => {
        textEl.textContent = words[index];
        textEl.classList.add("show");

        index = (index + 1) % words.length;
    }, 400);
}

changeText();
setInterval(changeText, 2000);
