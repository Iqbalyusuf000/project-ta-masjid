document.addEventListener("DOMContentLoaded", () => {

    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".nav-link, .desktop-nav-link");

    const activateLink = (id) => {

        navLinks.forEach(link => {

            link.classList.remove(
                "bg-primary",
                "text-white"
            );

            link.classList.add(
                "text-secondary"
            );

            if (link.getAttribute("href") === `#${id}`) {

                link.classList.remove("text-secondary");

                link.classList.add(
                    "bg-primary",
                    "text-white"
                );
            }
        });
    };

    window.addEventListener("scroll", () => {

        let current = "";

        sections.forEach(section => {

            const sectionTop = section.offsetTop - 180;

            if (scrollY >= sectionTop) {
                current = section.getAttribute("id");
            }
        });

        activateLink(current);
    });
});