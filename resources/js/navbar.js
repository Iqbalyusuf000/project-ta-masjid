document.addEventListener("DOMContentLoaded", () => {

    // =========================
    // Mobile Main Menu
    // =========================
    const mobileButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    if (mobileButton && mobileMenu) {
        mobileButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    }

    // =========================
    // Dropdown Elements
    // =========================
    const unitButton = document.getElementById("unit-usaha-button");
    const unitMenu = document.getElementById("unit-usaha-menu");

    const programButton = document.getElementById("program-button");
    const programMenu = document.getElementById("program-menu");

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

});