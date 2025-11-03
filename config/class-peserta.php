<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Peserta extends Database {

    // Method untuk input data peserta
    public function inputPeserta($data){
        // Mengambil data dari parameter $data
        $nip      = $data['nip'];
        $nama     = $data['nama'];
        $jurusan  = $data['jurusan'];
        $kelas    = $data['kelas'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $lomba    = $data['lomba'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_peserta (nip_peserta, nama_peserta, jurusan_peserta, kelas, email, no_telepon, lomba_diikuti) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt) return false;
        
        // Memasukkan parameter ke statement
        $stmt->bind_param("sssssss", $nip, $nama, $jurusan, $kelas, $email, $telp, $lomba );
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data peserta
    public function getAllPeserta(){
        // Menyiapkan query SQL untuk mengambil data peserta beserta nama lomba dan nama kelas
        $query = "
            SELECT 
                p.id_peserta,
                p.nip_peserta,
                p.nama_peserta,
                p.jurusan_peserta,
                COALESCE(k.nama_kelas, p.kelas) AS kelas,
                p.email,
                p.no_telepon,
                COALESCE(j.nm_lomba, p.lomba_diikuti) AS lomba
            FROM tb_peserta p
            LEFT JOIN tb_jenislomba j ON p.lomba_diikuti = j.id_jenislomba
            LEFT JOIN tb_kelas k ON p.kelas = k.id_kelas
        ";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data peserta
        $peserta = [];
        // Mengecek apakah ada data yang ditemukan
        if($result && $result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $peserta[] = [
                    'id' => $row['id_peserta'],
                    'nip' => $row['nip_peserta'],
                    'nama' => $row['nama_peserta'],
                    'jurusan' => $row['jurusan_peserta'],
                    'kelas' => $row['kelas'],
                    'email' => $row['email'],
                    'telp' => $row['no_telepon'],
                    'lomba' => $row['lomba'],
                ];
            }
        }
        // Mengembalikan array data peserta
        return $peserta;
    }

    // Method untuk mengambil data peserta berdasarkan ID
    public function getUpdatePeserta($id){
        // Menyiapkan query SQL untuk mengambil data peserta berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_peserta WHERE id_peserta = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result && $result->num_rows > 0){
            // Mengambil data peserta  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array (sesuai kolom tabel)
            $data = [
                'id' => $row['id_peserta'],
                'nip' => $row['nip_peserta'],
                'nama' => $row['nama_peserta'],
                'jurusan' => $row['jurusan_peserta'],
                'kelas' => $row['kelas'],
                'email' => $row['email'],
                'telp' => $row['no_telepon'],
                'lomba' => $row['lomba_diikuti'],
            ];
        }
        $stmt->close();
        // Mengembalikan data peserta
        return $data;
    }

    // Method untuk mengedit data peserta
    public function editPeserta($data){
        // Mengambil data dari parameter $data
        $id       = $data['id'];
        $nip      = $data['nip'];
        $nama     = $data['nama'];
        $jurusan  = $data['jurusan'];
        $kelas    = $data['kelas'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $lomba    = $data['lomba'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_peserta SET nip_peserta = ?, nama_peserta = ?, jurusan_peserta = ?, kelas = ?, email = ?, no_telepon = ?, lomba_diikuti = ? WHERE id_peserta = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement (sesuai urutan di query)
        $stmt->bind_param("sssssssi", $nip, $nama, $jurusan, $kelas, $email, $telp, $lomba, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data peserta
    public function deletePeserta($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_peserta WHERE id_peserta = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data peserta berdasarkan kata kunci
    public function searchPeserta($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data peserta menggunakan prepared statement
        $query = "
            SELECT 
                p.id_peserta,
                p.nip_peserta,
                p.nama_peserta,
                p.jurusan_peserta,
                COALESCE(k.nama_kelas, p.kelas) AS kelas,
                p.email,
                p.no_telepon,
                COALESCE(j.nm_lomba, p.lomba_diikuti) AS lomba
            FROM tb_peserta p
            LEFT JOIN tb_kelas k ON p.kelas = k.id_kelas
            LEFT JOIN tb_jenislomba j ON p.lomba_diikuti = j.id_jenislomba
            WHERE p.nip_peserta LIKE ? OR p.nama_peserta LIKE ?
        ";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data peserta
        $peserta = [];
        if($result && $result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data peserta dalam array (sesuai kolom)
                $peserta[] = [
                    'id' => $row['id_peserta'],
                    'nip' => $row['nip_peserta'],
                    'nama' => $row['nama_peserta'],
                    'jurusan' => $row['jurusan_peserta'],
                    'kelas' => $row['kelas'],
                    'email' => $row['email'],
                    'telp' => $row['no_telepon'],
                    'lomba' => $row['lomba'],
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data peserta yang ditemukan
        return $peserta;
    }

}
?>
