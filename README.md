# mencegah-akses-directory-upload
Hallo gais..
sample ini saya buat untuk teman2 yang kesulitan dalam implementasi preview dokumen/foto yang sudah di upload tetapi menghindari akses langsung ke direktori, misal :

struktur folder :
- app
  - upload
    - foto.jpg
    - dokumen.pdf
  - index.php\

dari struktur tersebut kita bisa melihat bahwa foto.jpg dan dokumen.pdf terdapat dalam folder upload.
biasanya kita akses gambar/dokumen tersebut seperti ini :
- situs.com/app/upload/foto.jpg
- situs.com/app/upload/dokumen.pdf
\
bisa dilihat dokumennya?
tentu bisa, namun cara ini akan berbahaya, karena user yang jahil akan mencoba akses direktori seperti ini :
- situs.com/app/upload/
\
maka yang terjadi file akan ke listing, /index of upload, semua file yang kita upload akan dilihat secara mudah, hal ini tentu berbahaya jika data yang kita upload sangat2 rahasia, dan juga teknik seperti ini akan memudahkan attacker dalam menemukan bug/shell yang mereka upload.
\
ada banyak cara untuk mengamankan hal ini, salah satunya rename file asli menjadi file yang kita generate saat upload dan menambahkan index.html disetiap direktori agar tidak dilisting file upload, namun  teknis ini hanya mencegah orang lain untuk tidak intip direktori secara langsung lewat browser, jika lewat aplikasi attacker seperti Accunetix, burpsuite, atau google bot index akan mudah dilihat semua isi data dalam direktori kita, lalu bagaimana mencegah data ini bocor ke publik ?\
1. menambahkan .htaccess pada direktori upload, isinya seperti ini :

``<IfModule authz_core_module>\
	Require all denied\
</IfModule>\
<IfModule !authz_core_module>\
	Deny from all\
</IfModule>``
\
simpan kode diatas, dan beri nama .htaccess di dalam folder upload, maka struktur akan menjadi :
struktur folder :
- app
  - upload
    - foto.jpg
    - dokumen.pdf
    - .htaccess
  - index.php\
agar apa?
agar direktori kita tidak bisa diakses secara langsung baik melalui browser ataupun melalui tools hacking, 
akan di tolak oleh webserver dengan kode Access forbidden! Error 403 You don't have permission to access the requested object. It is either read-protected or not readable by the server. atau Access to this resource on the server is denied!

bahkan aplikasi yang kita buat untuk preview gambar misalnya menggunakan kode ``<img src='upload/foto.jpg'>`` tidak bisa menampilkan gambar karena ditolak oleh server,
lalu bagaimana agar gambar tersebut tetap bisa dibuka,
caranya dengan membuat coding preview dengan manipulasi URL, caranya :
1. buat .htaccess di folder awal untuk manipulasi url, menghapus index.php dan file php lain, code :
``RewriteEngine On
RewriteCond $1 !^(index\.php)
RewriteRule ^preview/([^/\.]+)/?$ lihat.php?file=$1  [L]``
simpan di folder awal, maka struktur menjadi :
struktur folder :
- app
  - upload
    - foto.jpg
    - dokumen.pdf
    - .htaccess
  - index.php
  - .htaccess
  


