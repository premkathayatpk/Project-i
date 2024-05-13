//Responsive
// Function to toggle navigation bar
function toggleNavbar() {
  var navBar = document.querySelector('.navbar');
  navBar.classList.toggle('open');
}

// Add event listener to menu icon
document.querySelector('.menu-icon').addEventListener('click', toggleNavbar);

//show and hide pages

function showPage(pageId) {
  // Hide all sections
  let pages = document.querySelectorAll('.page');
  pages.forEach(function (page) {
    page.style.display = 'none';
  });

  // Show the selected section
  var selectedpage = document.getElementById(pageId);
  if (selectedpage) {
    selectedpage.style.display = 'block';
  }
}
showPage('home');


//-------Show and hide add product div-----
function toggleProduct() {
  var content = document.getElementById('add-product');
  content.classList.toggle('hidden'); // Toggle the 'hidden' class
}