<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

<<<<<<< HEAD
    // Method untuk mendapatkan daftar program studi
    public function getjenis(){
=======
    // Method untuk mendapatkan daftar jenis lomba
    public function getJenis(){
>>>>>>> be4672b2b590d4dda481042957900c5ea1f38386
        $query = "SELECT * FROM tb_jenislomba";
        $result = $this->conn->query($query);
        $jenis = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // ✅ Disesuaikan dengan kolom di tabel: kode_jenislomba & nama_jenislomba
                $jenis[] = [
                    'kode_jenislomba' => $row['kode_jenislomba'] ?? '',
                    'nama_jenislomba' => $row['nama_jenislomba'] ?? ''
                ];
            }
        }
        return $jenis;
    }

    // Method untuk mendapatkan daftar kelas
    public function getKelas(){
        $query = "SELECT * FROM tb_kelas";
        $result = $this->conn->query($query);
        $kelas = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $kelas[] = [
                    'id' => $row['id_kelas'] ?? '',
                    'nama' => $row['nama_kelas'] ?? ''
                ];
            }
        }
        return $kelas;
    }

    // Method untuk mendapatkan daftar jurusan
    public function getJurusan(){
        return [
            ['id' => 1, 'nama' => 'Ilmu Pengetahuan Alam'],
            ['id' => 2, 'nama' => 'Ilmu Pengetahuan Sosial'],
            ['id' => 3, 'nama' => 'Bahasa'],
        ];
    }

    // Method untuk input data jenis lomba
    public function inputJenis($data){
<<<<<<< HEAD
        $kodeJenis = $data['id_jenislomba'];
        $namaJenis = $data['nm_lomba'];
        $query = "INSERT INTO tb_jenislomba (id_jenislomba, nm_lomba) VALUES (?, ?)";
=======
        // ✅ Disesuaikan field tabel tb_jenislomba
        $kodeJenis = $data['kode_jenislomba'] ?? '';
        $namaJenis = $data['nama_jenislomba'] ?? '';
        $query = "INSERT INTO tb_jenislomba (kode_jenislomba, nama_jenislomba) VALUES (?, ?)";
>>>>>>> be4672b2b590d4dda481042957900c5ea1f38386
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeJenis, $namaJenis);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data jenis lomba berdasarkan kode
    public function getUpdateJenis($kode){
        $query = "SELECT * FROM tb_jenislomba WHERE kode_jenislomba = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $kode);
        $stmt->execute();
        $result = $stmt->get_result();
        $jenis = null;
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $jenis = [
                'kode_jenislomba' => $row['kode_jenislomba'] ?? '',
                'nama_jenislomba' => $row['nama_jenislomba'] ?? ''
            ];
        }
        $stmt->close();
        return $jenis;
    }

    // Method untuk mengedit data jenis lomba
    public function updateJenis($data){
        $kodeJenis = $data['kode_jenislomba'] ?? '';
        $namaJenis = $data['nama_jenislomba'] ?? '';
        $query = "UPDATE tb_jenislomba SET nama_jenislomba = ? WHERE kode_jenislomba = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaJenis, $kodeJenis);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data jenis lomba
    public function deleteJenis($kode){
        $query = "DELETE FROM tb_jenislomba WHERE kode_jenislomba = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $kode);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data kelas
    public function inputKelas($data){
        $namaKelas = $data['nama'] ?? '';
        $query = "INSERT INTO tb_kelas (nama_kelas) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaKelas);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data kelas berdasarkan id
    public function getUpdateKelas($id){
        $query = "SELECT * FROM tb_kelas WHERE id_kelas = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $kelas = null;
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $kelas = [
                'id' => $row['id_kelas'] ?? '',
                'nama' => $row['nama_kelas'] ?? ''
            ];
        }
        $stmt->close();
        return $kelas;
    }

    // Method untuk mengedit data kelas
    public function updateKelas($data){
        $idKelas = $data['id'] ?? '';
        $namaKelas = $data['nama'] ?? '';
        $query = "UPDATE tb_kelas SET nama_kelas = ? WHERE id_kelas = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaKelas, $idKelas);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data kelas
    public function deleteKelas($id){
        $query = "DELETE FROM tb_kelas WHERE id_kelas = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>
