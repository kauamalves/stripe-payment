window.onload = function() {
    let iconAlterTheme = document.querySelector('#alterThemeIcon');
    let icons = document.querySelectorAll('.fa-solid');

    function loadDarkMode() {
        const isDark = localStorage.getItem('dark');

        if (isDark === 'true') {
            document.body.classList.add('dark');
            document.body.classList.remove('white');

            iconAlterTheme.classList.remove('fa-sun');
            iconAlterTheme.classList.add('fa-moon');

            icons.forEach(icon => {
                icon.classList.add('darkInIcons');
            });
        } else {
            document.body.classList.add('white');
            document.body.classList.remove('dark');

            iconAlterTheme.classList.remove('fa-moon');
            iconAlterTheme.classList.add('fa-sun');

            icons.forEach(icon => {
                icon.classList.remove('darkInIcons');
            });
        }
    }

    loadDarkMode();

    function toggleBackground(oldBackground, newBackground) {
        const body = document.body;

        body.classList.remove(oldBackground);
        body.classList.add(newBackground);

        localStorage.setItem('dark', newBackground === 'dark');
    }

    const btn_change_bg = document.querySelector('#alterTheme');

    btn_change_bg.addEventListener('click', event => {
        event.preventDefault();

        const isDark = localStorage.getItem('dark') === 'true';

        if (isDark) {
            toggleBackground('dark', 'white');

            iconAlterTheme.classList.remove('fa-moon');
            iconAlterTheme.classList.add('fa-sun');

            icons.forEach(icon => {
                icon.classList.remove('darkInIcons');
            });
        } else {
            toggleBackground('white', 'dark');

            iconAlterTheme.classList.remove('fa-sun');
            iconAlterTheme.classList.add('fa-moon');

            icons.forEach(icon => {
                icon.classList.add('darkInIcons');
            });
        }
    });
}
