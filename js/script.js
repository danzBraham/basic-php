const searchButton = document.querySelector('.search-button');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');

// hilangkan tombol cari
searchButton.style.display = 'none';

// event ketika kita menuliskan keyword
keyword.addEventListener('keyup', function () {
   // ajax
   // cara lama menggunakan xmlhttprequest
   // const xhr = new XMLHttpRequest();

   // xhr.onreadystatechange = function () {
   //    if (xhr.readyState == 4 && xhr.status == 200) {
   //       container.innerHTML = xhr.responseText;
   //    }
   // };

   // xhr.open('GET', 'ajax/ajax_search.php?keyword=' + keyword.value);
   // xhr.send();

   // cara baru menggunakan fetch()
   fetch('ajax/ajax_search.php?keyword=' + keyword.value)
      .then((response) => response.text())
      .then((response) => (container.innerHTML = response));
});