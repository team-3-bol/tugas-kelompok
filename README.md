# Tugas Kelompok Web Programming
Repository ini berisi tugas kelompok yang mencakup tugas kelompok pertama sampai terakhir.

#### Team 3
1. Ahmad Ghifari Fuaiz
2. Brevan Kenneth Aleanda
3. Hardhika Surya Nugraha
4. Ichsan Firdaus
5. Zulwiyoza Putra


## Installasi
* Buka terminal atau command prompt ( cmd ), lalu pindah direktori kedalam folder project
* Masukan perintah berikut untuk melakukan duplikasi pada file .env.example menjadi file .env.
```bash
$ cp .env.example .env
```
* Untuk pengguna windows, bisa langsung copy-paste file .env.example lalu ubah namanya menjadi .env
* Lalu ubah file .env sesuaikan dengan settingan yang dimiliki
* Setelah itu ketik perintah berikut pada terminal
```bash
$ composer install
$ php artisan key:generate
$ php artisan migrate --seed
$ php artisan serv
```

