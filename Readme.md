Berikut adalah tentang aplikasi manajemen-kendaraan ini.

username & password

Admin email : admin@mail.com password : password
Approver 1 (kepala_cabang) email : cabang@mail.com password : password
Approver 2 (kepala_pusat) email : pusat@mail.com password : password
database version : mysql 8.4.3 PHP version : PHP 8.3.16 Framework : Laravel 12.18.0

Aplikasi ini masih pengembangan dan belum melakukan deployment sehingga hanya bisa diakses menggunakan/melalui lokalhost. Aplikasi ini menggunakan framework laravel berbasis admin panel dengan menggunakan package material filament dari laravel. Menggunakan Ip localhost yaitu http://127.0.0.1:8000/... yang nantinya akan diarahkan ke dalam halaman login, setelah login menggunakan email user yang ditentukan, aplikasi akan menyaring role user tersebut. Jika terdeteksi role sebagai admin, maka akan redirect ke halaman panel admin filament. Jika terdeteksi role approver maka akan redirect ke halaman panel approver filament. Sehingga aplikasi web ini berbentuk multi panel, panel admin hanya bisa diakses oleh admin atau bisa disebut operator, sedangkan untuk atasan dimana adalah approver hanya bisa login ke halaman panel approver untuk melakukan pemantuan dan menyetujui peminjaman kendaraan.

Harapan saya post-test ini dapat menjadi pertimbangan dalam seleksi saya untuk lamaran magang di perusahaan Sekawan Media.