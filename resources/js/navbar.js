document.addEventListener("DOMContentLoaded", () => {

    // =========================
    // Mobile Main Menu
    // =========================
    const mobileButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    if (mobileButton && mobileMenu) {
        const icon = mobileButton.querySelector("iconify-icon");
        mobileButton.addEventListener("click", () => {
            const isOpen = mobileMenu.classList.contains("max-h-[600px]");
            if (isOpen) {
                // Close Menu
                mobileMenu.classList.remove("max-h-[600px]", "opacity-100", "py-4");
                mobileMenu.classList.add("max-h-0", "opacity-0");
                if (icon) {
                    icon.setAttribute("icon", "mdi:menu");
                    icon.classList.remove("rotate-90");
                }
            } else {
                // Open Menu
                mobileMenu.classList.remove("max-h-0", "opacity-0");
                mobileMenu.classList.add("max-h-[600px]", "opacity-100", "py-4");
                if (icon) {
                    icon.setAttribute("icon", "mdi:close");
                    icon.classList.add("rotate-90");
                }
            }
        });
    }

    // =========================
    // Dropdown Elements
    // =========================
    const unitButton = document.getElementById("unit-usaha-button");
    const unitMenu = document.getElementById("unit-usaha-menu");
    const unitIcon = document.getElementById("unit-usaha-icon");

    const programButton = document.getElementById("program-button");
    const programMenu = document.getElementById("program-menu");
    const programIcon = document.getElementById("program-icon");

    // =========================
    // Helper Functions
    // =========================

    function openDropdown(menu) {
        menu.classList.remove("max-h-0", "opacity-0");
        menu.classList.add("max-h-[300px]", "opacity-100");
    }

    function closeDropdown(menu) {
        menu.classList.remove("max-h-[300px]", "opacity-100");
        menu.classList.add("max-h-0", "opacity-0");
    }

    function isOpen(menu) {
        return menu.classList.contains("max-h-[300px]");
    }

    // =========================
    // Unit Usaha Click
    // =========================
    if (unitButton && unitMenu) {
        unitButton.addEventListener("click", () => {

            // tutup dropdown lain
            closeDropdown(programMenu);

            // toggle current
            if (isOpen(unitMenu)) {
                closeDropdown(unitMenu);
            } else {
                openDropdown(unitMenu);
            }
        });
    }

    // =========================
    // Program Click
    // =========================
    if (programButton && programMenu) {
        programButton.addEventListener("click", () => {

            // tutup dropdown lain
            closeDropdown(unitMenu);

            // toggle current
            if (isOpen(programMenu)) {
                closeDropdown(programMenu);
            } else {
                openDropdown(programMenu);
            }
        });
    }

    if (unitButton) {
        unitButton.addEventListener("click", function () {

            unitIcon.classList.toggle('rotate-180');
        })
    }

    if (programButton) {
        programButton.addEventListener("click", function () {

            programIcon.classList.toggle('rotate-180');
        })
    }

});