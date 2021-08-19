APLIKASI MONITORING KENDARAAN

Cara menjalankan aplikasi:
1. Clone repository.
2. Import database 'monitoring_kendaraan' ke MySQL. Ubah sesuai config database Anda di application/config/database.php.
3. Copy folder ke XAMPP/htdocs, buka browser dan kunjungi localhost/monitoring_kendaraan.

Panduan penggunaan aplikasi:
1. Kunjungi localhost/monitoring_kendaraan, dan akan menuju menu login.
2. Jika ingin mendaftarkan akun, klik tulisan 'Daftar disini!' setelah itu daftar akun seperti biasa.
3. Bisa juga login dengan akun yang sudah ada yaitu:
    a.  username : admin
        password : admin 
        (Level user admin)
    b.  username : azka
        password : azka
        (Level user atasan)
4. Setelah itu akan diarahkan menuju menu dashboard.
5. Jika login sebagai admin,
    a.  Klik menu 'Data Kendaraan', maka bisa mengelola data kendaraan (menambah data, mengubah data, menghapus data).
    b.  Klik menu 'Data Atasan / Penyetuju', maka bisa mengelola data atasan (menambah data, mengubah data, menghapus data).
    c.  Klik menu 'Pesan Kendaraan' untuk melakukan pemesanan. Pilih kendaraan yang akan dipesan dan klik tombol 'Pesan Kendaraan'.
        Setelah itu bisa mengisi formulir pemesanan sesuai kebutuhan. Selesai mengisi, tinggal menunggu konfirmasi dari atasan untuk menyetujui/menolak formulir.
6. Jika login sebagai atasan / penyetuju,
    a.  Klik menu 'Daftar Pemesanan' untuk menyetujui / menolak pesanan yang masuk.
7. Jika formulir disetujui atasan, di menu 'Pesan Kendaraan' milik admin akan berganti menjadi kendaraan sedang terpakai. Jika kendaraan sudah selesai
    dipakai, maka admin klik tombol 'Selesaikan Pesanan' dan pesanan pun selesai, dan bisa dilihat di menu 'Histori Pemesanan'.
8. Untuk mengexport histori pemesanan ke format Excel, klik tombol 'Export Ke Excel' maka browser otomatis mendownload file tersebut.

System Requirement: 
1. Database MySQL
2. PHP versi 7.2.8 dengan framework CodeIgniter 3.1.10
3. CSS Bootstrap versi 4.5.2
4. JQuery versi 3.2.1
5. Template website Stisla2