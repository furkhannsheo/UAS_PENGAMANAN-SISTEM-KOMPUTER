# UAS Keamanan Komputer

## Identitas
- Nama: Danny Firmansyah
- NIM: 221080200083
- Kelas: 6B
- Repo GitHub: [[link](https://github.com/furkhannsheo/UAS_PENGAMANAN-SISTEM-KOMPUTER.git)]

---

## Bagian A – Bug Fixing JWT REST API

### Bug 1: Token tetap aktif setelah logout
**Penjelasan:**  
API tidak menyimpan token aktif yang disebut assesions, sehingga logout tidak memerlukan verifikasi token, jadinya meski user sudah logout, token tersebut masih bisa digunakan kembali untuk mengakses.

**Solusi:**  
Tambahkan token aktif di redis/database dengan tambahkan validasi token saat masuk. dan ketika user logout, hapus token dari daftar redis.

**PHP**
// Contoh logika logout di CodeIgniter
public function logout()
{
    $token = $this->request->getHeaderLine('Authorization');
    if ($token) {
        $cleaned = str_replace('Bearer ', '', $token);
        // Simpan token ini ke tabel blacklist
        $this->tokenModel->blacklist($cleaned);
    }
    return $this->respond(['message' => 'Logout successful']);
}-----------
Tidak ada pembatasan akses berdasarkan role
Penjelasan:
Semua bisa diakses oleh siapa saja yang memiliki token valid, tanpa memeriksa role user. Akibatnya, user biasa bisa mengakses role admin.


## Bagian B – Simulasi Serangan dan Solusi

### Jenis Serangan: Broken Access Control
Serangan terjadi karena tidak adanya pembatasan akses berdasarkan identitas pengguna. Ini memungkinkan user biasa mengubah data user lain (termasuk admin) dengan memanipulasi user_id di body request. Ini merupakan Broken Object Level Authorization.
**Simulasi Postman:**  
// Endpoint: PUT /api/users/update
{
  "user_id": 1,   // ID Admin
  "name": "admin",
  "email": "admin@example.com"
}

**Solusi Implementasi:**  
Middleware/Filter Akses
Langkah:

Tambahkan middleware atau filter yang membaca payload JWT.

Cocokkan user_id di body/param dengan user_id di token.

Jika tidak cocok dan bukan admin, tolak permintaan.

Contoh Kode Middleware (CodeIgniter):

php
public function before(RequestInterface $request, $arguments = null)
{
    $token = $request->getHeaderLine('Authorization');
    $decoded = JWT::decode($token, new Key(SECRET_KEY, 'HS256'));
    
    $requestBody = json_decode($request->getBody(), true);
    $requestUserId = $requestBody['user_id'] ?? null;

    if ($decoded->role !== 'admin' && $decoded->user_id != $requestUserId) {
        return Services::response()
            ->setStatusCode(403)
            ->setJSON(['message' => 'Forbidden']);
    }
}
---

## Bagian C – Refleksi Teori & Etika

### 1. CIA Triad dalam Keamanan Informasi  
Prinsip dasar keamanan informasi CIA Triad, terdiri dari tiga komponen utama:

- Confidentiality (rahasia): Menjamin bahwa informasi hanya dapat diakses oleh pihak yang berwenang. 
- Integrity (Integritas): Memastikan bahwa informasi tetap akurat dan tidak diubah tanpa izin. Mencakup penggunaan checksum, hashing, dan mencegah perubahan yang tidak sah pada data.
- Availability (Ketersediaan): Menjamin bahwa informasi dan sistem selalu tersedia untuk pengguna yang berwenang ketika dibutuhkan. Melibatkan pengelolaan sumber daya, pemulihan bencana, dan perlindungan terhadap serangan yang dapat mengganggu akses ke data.

### 2. UU ITE yang relevan 
- Pasal 30: Mengatur tentang larangan akses ilegal terhadap sistem elektronik. Setiap orang sengaja dan tanpa hak mengakses sistem elektronik milik orang lain dapat dikenakan sanksi pidana.

- Pasal 32: Mengatur tentang larangan penyebaran informasi yang dapat merugikan pihak lain. 

### 3. Pandangan Al-Qur'an  
- Surah Al-Baqarah: 205  
Ayat ini menekankan pentingnya menjaga dan tidak merusak apa yang ada di bumi, termasuk sistem yang ada. Dalam konteks cyber etika, merusak sistem informasi atau data dapat dianggap sebagai tindakan yang tidak sesuai dengan ajaran Islam, karena dapat merugikan orang lain dan menciptakan kerusakan. Karena itulah etika dalam dunia maya harus mencerminkan nilai-nilai keadilan dan tanggung jawab.

### 4. Etika Cyber dan Kejujuran  
Dalam dunia cybersecurity, nilai kejujuran dan amanah sangat penting. Profesional keamanan siber harus: Jujur dalam menganalisis sistem dan melaporkan kerentanannya. Amanah dalam menjaga kerahasiaan data klien dan tidak menyalahgunakan akses yang dimiliki.
