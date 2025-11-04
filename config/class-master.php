<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar program studi
    public function getjenis(){
        $query = "SELECT * FROM tb_jenislomba";
        $result = $this->conn->query($query);
        $jenis = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jenis[] = [
                    'id' => $row['id_jenislomba'],
                    'nama' => $row['nm_lomba']
                ];
            }
        }
        return $jenis;
    }

    // Method untuk mendapatkan daftar provinsi
    public function getKelas(){
        $query = "SELECT * FROM tb_kelas";
        $result = $this->conn->query($query);
        $kelas = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $kelas[] = [
                    'id' => $row['id_kelas'],
                    'nama' => $row['nama_kelas']
                ];
            }
        }
        return $kelas;
    }

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    public function getJurusan(){
        return [
            ['id' => 1, 'nama' => 'Ilmu Pengetahuan Alam'],
            ['id' => 2, 'nama' => 'lmu Pengetahuan Sosial'],
            ['id' => 3, 'nama' => 'Bahasa'],
        ];
    }

    // Method untuk input data program studi
    public function inputJenis($data){
        $kodeJenis = $data['id_jenislomba'];
        $namaJenis = $data['nm_lomba'];
        $query = "INSERT INTO tb_jenislomba (id_jenislomba, nm_lomba) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeJenis, $namaJenis);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data program studi berdasarkan kode
    public function getUpdateJenis($id){
        $query = "SELECT * FROM tb_jenislomba WHERE id_jenislomba = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $jenis = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $jenis = [
                'id' => $row['id_jenislomba'],
                'nama' => $row['nm_lomba']
            ];
        }
        $stmt->close();
        return $jenis;
    }

    // Method untuk mengedit data program studi
    public function updateJenis($data){
        $kodeJenis = $data['kode'];
        $namaJenis = $data['nama'];
        $query = "UPDATE tb_jenislomba SET nm_lomba = ? WHERE id_jenislomba = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaJenis, $kodeJenis);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data jenis
    public function deleteJenis($id){
        $query = "DELETE FROM tb_jenislomba WHERE id_jenislomba = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputKelas($data){
        $namaKelas = $data['nama'];
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

    // Method untuk mendapatkan data provinsi berdasarkan id
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
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $kelas = [
                'id' => $row['id_kelas'],
                'nama' => $row['nama_kelas']
            ];
        }
        $stmt->close();
        return $kelas;
    }

    // Method untuk mengedit data provinsi
    public function updateKelas($data){
        $idKelas = $data['id'];
        $namaKelas = $data['nama'];
        $query = "UPDATE tb_kelas SET nama_kelas = ? WHERE id_kelas = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namakelas, $idKelas);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data provinsi
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