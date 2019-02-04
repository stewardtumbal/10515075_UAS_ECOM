# Aplikasi Pendataan Siswa di SMKN 1 Cimahi
Hasil dari project ini yaitu aplikasi pendataan Siswa di SMKN 1 Cimahi dengan menggunakan framework Laravel. Aplikasi ini dibuat sebagai tugas besar UAS untuk mata kuliah E-Commerce Lanjut

# Penginstallan Laravel
Project ini menggunakan framework laravel, untuk menginstall laravel di perangkat anda yaitu dengan cara copy saja satu folder fresh install laravel dari orang lain ke perangkat kamu. Kemudian akses Laravel kalian seperti contoh yang saya yaitu http://localhost/10515075_UAS_ECOM/public 

# Integrasi Laravel dengan Template AdminLTE 2.3.11
Laravel yang telah di install kemudian di integrasikan dengan template admin LTE 2.3.11. Langkah awal yaitu persiapkan template AdminLTE 2.3.11 yang bisa didapatkan dari alamat https://codeload.github.com/almasaeed2010/AdminLTE/zip/v2.3.11.
Selanjutnya buat folder assets di folder public laravel. Copy folder dist, bootstrap dan plugin dari template AdminLTE ke folder tersebut.
Kemudian buat folder baru dengan nama templates pada folder resources/views di laravel kamu.
Kemudian didalam folder templates, buat 2 file dengan nama header.blade.php dan footer.blade.php
Kemudian buat folder baru dengan nama kelas pada folder resources/views di laravel kamu. Didalam folder kelas, buat file dengan nama index.blade.php
Kemudian buka folder AdminLTE-2.3.11 kamu, kemudian cari file blank.html di folder pages/examples
Selanjutnya buka file tersebut dengan editor kesayanganmu. Lakukan langkah-langkah berikut:
- Copy Line 1 s.d 391, paste di file templates/header.blade.php
- Copy line 392 s.d 432, paste di file index.blade.php
- Copy line 433 s.d 654, paste di file templates/footer.blade.php
Pada file templates/header.blade.php baris 21, tambahkan: @stack digunakan untuk menyimpan potongan script dari hasil @push
Masih pada file templates/header.blade.php baris terakhir, tambahkan 2 baris
sintaks berikut: 
- @yield digunakan untuk menyimpan potongan script dari hasil @section
- @include digunakan untuk menyisipkan file lain
Buka file kelas/index.blade.php, tambahkan pada baris pertama kodingan ini :
@extends('templates/header')
@section('content')'
Dan pada baris terakhir tambahkan :
@endsection
Pada file templates/header.blade.php dan templates/footer.blade.php lakukan Find and Replace untuk mengganti semua link asset ke folder asset yang sudah kita copy kan tadi. Find : ../.. | Replace : {{asset('assets')}}
Buka Command Prompt (dengan cara tekan Shift + Klik Kanan di sembarang tempat, pilih Open windows command windows here) di folder belajarLaravel, buat Controller baru menggunakan artisan dengan syntax berikut: php artisan make:controller Kelas Controller
Buka file app/Http/Controllers/KelasController.php, tambahkan sintaks berikut ke dalam kodingan class KelasController :
public function index()
{
  return view('kelas/index');
}
Selanjutnya buka file routes/web.php, tambahkan kodingan routes yang sudah ada menjadi : Route::get('/', 'KelasController@index);
Akses web kalian dengan alamat url sesuai dengan yang sudah di install di awal maka Template AdminLTE 2.3.11 telah terintegrasi ke Laravel anda.

# CRUD
Pada pembahasan selanjutnya akan dijelaskan bagaimana membaca data dari database menggunakan Laravel dan Eloquent. Eloquent sendiri merupakan fitur dari Laravel yang memungkinkan kita memanggil data dari database dalam bentuk Entity Object,
tanpa syntax MySQL sama sekali. Untuk membuat database MySQL nya pun akan digunakan fitur migration dari Laravel. Fitur ini bermanfaat sekali apabila kalian sudah membangun project laravel dalam suatu tim. Migration ini membantu web artisan dalam mendefinisikan table (DDL) dalam bentuk sintaks pemrograman PHP.
Tutorial Make Simple CRUD sendiri dapat di akses di link berikut :
https://drive.google.com/file/d/1AmexPu9OEQEz1cHfvVOHHIx3-47ml-Jm/view

Di link tersebut sudah dijelaskan dengan sangat detail tentang Membuat CRUD yang simpel mulai dari Read Data, Create Data, Updating Data, dan Delete Data.

# Eloquent Relationsip

Langkah selanjutnya saya akan menjelaskan bagaimana membuat relasi dua tabel menggunakan fitur canggih dari Laravel, yaitu Relationship Eloquent. Jadi kalian tidak perlu repot-repot lagi membuat sintaks query JOIN JOIN, semuanya sudah dimudahkan dengan menggunakan eloquent, dan untuk memanggil relasinya pun cukup mudah. 
Pertama tama buatlah satu tabel lagi seperti langkah CRUD di atas dengan nama tabel yaitu table_siswa dengan field nis, nama_lengkap, jenis_kelamin, alamat, no_telp, dan id_kelas sebagai foreign key dari tabel kelas ke tabel siswa ini.

Pada file resources/views/siswa/index.blade.php ada sedikit kodingan yang harus di tambahkan :
@$row->kelas->nama_kelas digunakan untuk memanggil data relasi eloquent. Pada Model Siswa kita sudah membuat fungsi kelas, nah disini @$row->kelas adalah memanggil fungsi tersebut (Fungsi Relasi Eloquent). Setelah @$row->kelas kita memiliki seluruh atribut Data Kelas, tinggal panggil lagi saja atribut Data Kelas nya, misal @$row->kelas->nama_kelas.

Pada form select diatas, terdapat @foreach, digunakan untuk me-looping data. Data yang diambil adalah \App\Kelas::all() yang artinya mengambil semua data pada tabel t_kelas. Kemudian pada sintaks berikutnya memasukan id_kelas sebagai value, dan nama_kelas
sebagai display teks nya.
{{ @$result->id_kelas == $kelas->id_kelas ? ‘selected’ : ‘’ }} Sintaks tersebut digunakan pada saat form mode edit, untuk menandakan status selected pada combo box sesuai dengan data yang akan diedit.

Buka web kamu, kemudian coba lakukan input data maka relasi tabel antara tabel kelas dan tabel siswa sudah berjalan.

# Login
Selanjutnya akan dijelaskan mengenai Authentikasi User. Kita akan menggunakan fitur bawaan Laravel dan sedikit modifikasi sistemnya.
Langkah pertama kita buat dulu tampilan login nya. Buka AdminLTE-2.3.11/pages/examples/login.html.
Buat file baru di resources/views/login.blade.php
Copy isi dari login.html ke login.blade.php
Sama seperti file template pada pembahasan awal, Find & Replace. Find : ../.. | Replace : {{asset('assets')}}
Modifikasi tambah feedback, form action, field name dan tambahkan token (Line 36, 38, 39, 42, 46 dan 53)
36. @include('tempaltes.feedback')
38. <form action="{{ url('login') }}" method="post">
39. {{csrf_field() }}
42. <input type="text" name="username" class="form-control" placeholder="Username">
46. <input type="password" name="password" class="form-control" placeholder="Password">
53. <input type="checkbox name="remember"> Remember Me

Kemudian edit routes/web.php

di atas kodingan route::get tambahkan :
Route::auth();
dan Route::group(['middleware'=>'auth'], function() {
});

- Route::auth() digunakan untuk menciptakan routes yang berhubungan dengan authentikasi
(Bawaan Laravel)
- Route::group digunakan untuk membuat grup route dan mengimplemntasikan atribut/rule khusus kepada grup tsb. Pada contoh diatas mengimplementasikan middleware auth pada seluruh route yang ada pada grup tsb. Jadi untuk mengakses route yang ada di dalam grup tersebut harus login terlebih dahulu. Contohnya mengakses alamat laravel yang sudah di install tidak akan terbuka jika user belum login.

Selanjutnya membuat migration table login yaitu buka cmd kemudian ketikan perintah berikut ini : php artisan make:migration create_table_user
Edit file migration tersebut tambahkan kodingan :
 Schema::create('t_login', function (Blueprint $table) {
            $table->increments('id_login');
            $table->string('nama_user', 100);
            $table->string('username', 100);
            $table->string('password', 150);
            $table->rememberToken();
            $table->timestamps();
        });
        
Kemudian lakukan migrate dengan ketik perintah berikut di cmd : php artisan migrate
Table t_login akan tercipta otomatis. Lihat hasilnya di phpMyAdmin
Untuk Login, model nya cukup berbeda. Laravel sudah menyediakan Model nya dengan nama User pada folder app, tinggal kita modifikasi saja.
 use Notifiable;
    protected $table = 't_login';
    public $primaryKey = 'id_login';
    protected $fillable = [
        'nama_user', 'username', 'password'
    ];
Untuk membuat user adminnya, kita coba lewat database seeder ya. Langkah-langkahnya adalah sebagai berikut:  
1. Buka cmd dan ketikan perintah : php artisan make:seed LoginSeeder
2. Edit file Seeder tersebut seperti ini : 
 public function run()
    {
        $user = new \App\User;
        $user->nama_user = 'Admin';
        $user->username = 'admin';
        $user->password = bcrypt('admin');
        $user->save();
    }
3. Kemudian jangan lupa edit juga database/seeds/DatabaseSeeder.php yaitu mematikan fungsi yang lain kemudian menambahkan fungsi :
  $this->call(LoginSeeder::class);
4. Kemudian ketikan ini pada cmd : php artisan db:seed

Selanjutnya modifikasi Login Controller yaitu Modifikasi file app/Http/Controllers/Auth/LoginController.php (Line 28, Line 40-48)
28. protected $redirectTo = '/';
40 - 46 : 
public function showLoginForm(){
        return view('login');
    }
   public function username(){
        return 'username';
   }
   
Coba buka web browser kamu dan akses alamat installan laravel maka akan otomatis muncul halaman login.
Masukkan username admin dan password admin, maka akan langsung ke halaman utama.
Jika username/password salah akan muncul feedback pesan error.

Untuk membuat tombol logout maka Ikuti langkah berikut:
1. Buka file resources/views/templates/header.blade.php
2. Edit line 173, menjadi : 
 <form action='{{ url("logout") }}' method="POST">
    {{ csrf_field() }}
   <button type="submit" class="btn btn-default btn-flat">Sign Out</button>
    

# Upload File
Untuk Tutorial Laravel bisa di ikuti pada link berikut ini: https://drive.google.com/file/d/1qb34ta4QJFzmekmiUAK84CzW6Cy7IXR/view?usp=sharing 
