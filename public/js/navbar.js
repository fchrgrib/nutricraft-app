function toggleMenu() {
    var mobileMenu = document.getElementById("mobile-menu");
    mobileMenu.classList.toggle("show");
}

const logoutButton = document.getElementById("logoutbtn");

logoutButton.addEventListener('click', () => {
    var date = new Date()
              date.setTime(date.getTime() - (24*60*60*1000));
              var expires = '; expires=' + date.toUTCString();
              document.cookie = 'user='+ expires + '; path=/';
});
