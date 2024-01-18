import './bootstrap';

import Alpine from 'alpinejs';

window.toggleDarkMode = function () {
    let isDarkMode = document.documentElement.classList.toggle('dark');
    localStorage.setItem('darkMode', isDarkMode ? 'true' : 'false');
    let lang = document.documentElement.lang;

    if (document.documentElement.classList.contains('dark')) {
        if (lang === "ar")
            document.getElementById("toggle").innerHTML = "الضوء"
        else
            document.getElementById("toggle").innerHTML = "Light"
    } else {
        if ( lang === "ar")
            document.getElementById("toggle").innerHTML = "الظلام"
        else
            document.getElementById("toggle").innerHTML = "Dark"

    }
}


document.addEventListener('DOMContentLoaded', (event) => {
    let lang = document.documentElement.lang;

    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
        if (lang === "ar")
            document.getElementById("toggle").innerHTML = "الضوء"
        else
            document.getElementById("toggle").innerHTML = "Light"

    } else {
        document.documentElement.classList.remove('dark');
        if ( lang === "ar")
            document.getElementById("toggle").innerHTML = "الظلام"
        else
            document.getElementById("toggle").innerHTML = "Dark"

    }


});

window.Alpine = Alpine;

Alpine.start();
