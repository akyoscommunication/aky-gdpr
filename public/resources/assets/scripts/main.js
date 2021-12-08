window.addEventListener('scroll', (e) => {
    if (window.scrollY + window.innerHeight > document.documentElement.scrollHeight - 100) {
        document.getElementById("akyCookiesGestion").classList.add("active");
    } else {
        document.getElementById("akyCookiesGestion").classList.remove("active");
    }
});