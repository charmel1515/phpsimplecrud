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
        $query = "INSERT INTO tb_peserta ( nip_peserta, nama_peserta, jurusan_peserta, kelas, email,no_telepon, lomba_diikuti) VALUES ( ?, ?, ?, ?, ?, ?, ? )";
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

    // Method untuk mengambil semua data mahasiswa
    public function getAllPeserta(){
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT id_peserta, nip_peserta, nama_peserta, jurusan_peserta, kelas, email, no_telepon, lomba_diikuti 
                  FROM tb_peserta
                  JOIN tb_jenislomba ON nm_lomba = id_jenislomba
                  JOIN tb_kelas ON kelas = id_kelas";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $peserta = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $peserta[] = [
                    'id' => $row['id'],
                    'nip' => $row['nip'],
                    'nama' => $row['nama'],
                    'jurusan' => $row['jurusan'],
                    'kelas' => $row['kelas'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'lomba' => $row['lomba_diikuti'],
                    
                ];
            }
        }
        // Mengembalikan array data mahasiswa
        return $peserta;
    }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdatePeserta($id){
        // Menyiapkan query SQL untuk mengambil data mahasiswa berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_peserta WHERE id_peserta = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data mahasiswa  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id'],
                'nip' => $row['nip'],
                'nama' => $row['nama'],
                'jurusan' => $row['jurusan'],
                'kelas' => $row['kelas'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'lomba' => $row['lomba'],
                
            ];
        }
        $stmt->close();
        // Mengembalikan data mahasiswa
        return $data;
    }

    // Method untuk mengedit data mahasiswa
    public function editPeserta($data){
        // Mengambil data dari parameter $data
        $id       = $data['id'];
        $nip      = $data['nip'];
        $nama     = $data['nama'];
        $jurusan    = $data['jurusan'];
        $kelas       = $data['kelas'];
        $email      = $data['email'];
        $telp    = $data['telp'];
        $lomba     = $data['lomba'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_peserta SET nip_peserta = ?, nama_peserta = ?, jurusan_peserta = ?, kelas = ?, email = ?,  no_telepon = ?, lomba_diikuti = ? WHERE id_peserta = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("sssssssi", $nip, $nama, $jurusan, $kelas, $email, $no_telepon, $lomba_diikuti, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data mahasiswa
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

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
    public function searchPeserta($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_peserta, nip_peserta, nama_peserta, jurusan_peserta, kelas, email, no_telepon, lomba_diikuti
                  JOIN tb_kelas ON kelas = id_kelas
                  WHERE nip LIKE ? OR nama LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $peserta = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data mahasiswa dalam array
                $peserta[] = [
                    'id' => $row['id'],
                    'nip' => $row['nip'],
                    'nama' => $row['nama'],
                    'jurusan' => $row['jurusan'],
                    'kelas' => $row['kelas'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'lomba' => $row['lomba'],
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $peserta;
    }

}

?>