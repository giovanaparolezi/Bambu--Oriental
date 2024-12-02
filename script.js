
document.getElementById("menu-btn").addEventListener("click", function() {
    document.querySelector(".header").classList.toggle("active");
});


    window.onscroll = function() {
        var header = document.getElementById("header");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            header.classList.add("transparent");
        } else {
            header.classList.remove("transparent");
        }
    };

    
 