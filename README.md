## How to Run
- pastikan sudah download dan install composer
- jika download zip, extract file. TIDAK HARUS pada folder htdocs
- edit file .env.example. rename file jadi .env. atur nama database pada
    DB_DATABASE= nama_db
    DB_USERNAME=root
    DB_PASSWORD=
- buat database dengan nama sesuai di file .env
- buka database kemudian import file database wifi1.sql
- jalankan xampp
- jalankan program dengan cara buka cmd pada direktori/folder program ini berada. ketik "composer install" untuk install library yg dibutuhkan dalam program ini
- setelah berhasil ketik "php artisan serve" tanpa tanda petik.
- buka url (bisa dengan cara ctrl + click link atau copy paste pada browser)

## Cara buka cmd pada direktori/folder program
- buka direktori/folder program yang telah di extract
- klik pada address bar (kolom berisi letak folder. contoh: This PC > Document > a ), hapus text, ketik "cmd" tanpa tanda petik, Enter
