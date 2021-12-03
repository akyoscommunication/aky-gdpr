window.addEventListener('scroll', (e) => {
	if (window.scrollTop() + window.innerHeight > document.innerHeight - 100) {
		document.getElementById("akyCookiesGestion").classList.add("active");
	} else {
		document.getElementById("akyCookiesGestion").classList.remove("active");
	}
});
