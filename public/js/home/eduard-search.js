document.addEventListener('DOMContentLoaded', () => {
    const submenu = document.querySelector('.submenu');
    submenu.addEventListener('click', () => {
      submenu.classList.toggle('open');
    });
  });
  