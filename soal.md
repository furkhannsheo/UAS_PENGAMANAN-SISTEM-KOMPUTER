🔧 Bagian A – Pemecahan Bug \& Error JWT REST API (40%)

Studi Kasus:

Diberikan project API sederhana berbasis CodeIgniter 4 atau Node.js (silakan pilih salah satu), dengan fitur CRUD menggunakan JWT untuk autentikasi. Namun, API ini memiliki beberapa bug dan kelemahan keamanan seperti:

* Token tidak valid saat login ulang
* Tidak ada pembatasan akses endpoint
* User lain bisa mengakses data user lain
* Logout tidak menghapus token aktif



Instruksi:

* Fork repositori berikut: https://github.com/f4uz4n/project-uas-pengamanan.git
* Temukan dan perbaiki minimal 3 bug/error terkait autentikasi dan otorisasi JWT.
* Tulis penjelasan bug dan solusinya di dalam file README.md.
* Lakukan commit terpisah untuk tiap bug fix dengan penjelasan jelas.



🛡️ Bagian B – Analisis Serangan dan Solusi (30%)

Kasus:

Server Anda menerima laporan bahwa endpoint /api/users/update bisa digunakan oleh user biasa untuk mengubah data admin lain, hanya dengan mengubah user\_id di JSON body request.



Tugas:

* Jelaskan jenis serangan yang terjadi.
* Simulasikan bagaimana serangan dilakukan (gunakan Postman/curl).
* Tunjukkan implementasi middleware atau filter yang tepat untuk mencegah serangan ini.
* Berikan potongan kode asli Anda dan commit hasil perbaikannya.



📚 Bagian C – Refleksi Teori dan Pandangan Etis (30%)

* Apa prinsip dasar keamanan informasi menurut cybersecurity framework (CIA Triad)?
* Jelaskan 2 pasal dalam UU ITE Indonesia yang berkaitan dengan pelanggaran keamanan data atau akses ilegal.
* Uraikan pandangan Al-Qur’an tentang larangan merusak sistem (cyber ethics), sertakan minimal 1 ayat dan penafsirannya.
* Menurut Anda, bagaimana penerapan nilai kejujuran dan amanah dalam dunia cybersecurity modern?



💯 Kriteria Penilaian

&nbsp;	Kriteria			Bobot

* Bug Fixing dan Dokumentasi		40%
* Analisis dan Solusi Serangan		30%
* Jawaban Teori dan Etika		20%
* Struktur Git, Commit Message, README	10%
