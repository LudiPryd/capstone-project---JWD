window.addEventListener('DOMContentLoaded', (event) => {
  // Navbar shrink function
  var navbarShrink = function () {
    const navbarCollapsible = document.body.querySelector('#mainNav');
    if (!navbarCollapsible) {
      return;
    }
    if (window.scrollY === 0) {
      navbarCollapsible.classList.remove('navbar-shrink');
    } else {
      navbarCollapsible.classList.add('navbar-shrink');
    }
  };

  // Shrink the navbar
  navbarShrink();

  // Shrink the navbar when page is scrolled
  document.addEventListener('scroll', navbarShrink);

  //  Activate Bootstrap scrollspy on the main nav element
  const mainNav = document.body.querySelector('#mainNav');
  if (mainNav) {
    new bootstrap.ScrollSpy(document.body, {
      target: '#mainNav',
      rootMargin: '0px 0px -40%',
    });
  }

  // Collapse responsive navbar when toggler is visible
  const navbarToggler = document.body.querySelector('.navbar-toggler');
  const responsiveNavItems = [].slice.call(
    document.querySelectorAll('#navbarResponsive .nav-link')
  );
  responsiveNavItems.map(function (responsiveNavItem) {
    responsiveNavItem.addEventListener('click', () => {
      if (window.getComputedStyle(navbarToggler).display !== 'none') {
        navbarToggler.click();
      }
    });
  });
});

// fungsi hitung
document.getElementById('hitungBtn').addEventListener('click', function () {
  // Get values
  var durasi = parseInt(document.getElementById('durasi').value) || 0;
  var peserta = parseInt(document.getElementById('peserta').value) || 0;

  // Ambil elemen select wisata dan dapatkan harga dari data-harga
  var wisataSelect = document.getElementById('wisata');
  var wisata =
    wisataSelect.options[wisataSelect.selectedIndex].getAttribute(
      'data-harga'
    ) || 0;
  wisata = parseInt(wisata);

  var layanan = document.querySelectorAll('input[name="layanan[]"]:checked');
  var totalLayanan = Array.from(layanan).reduce(
    (total, checkbox) => total + parseInt(checkbox.value),
    0
  );

  // Calculate prices
  var hargaPaket = wisata + totalLayanan;
  var tagihan = hargaPaket * peserta;

  // Update fields
  document.getElementById('harga').value = hargaPaket;
  document.getElementById('tagihan').value = tagihan;
});
