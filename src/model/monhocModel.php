<?php
  require_once 'config/database.php';
  class monhocModel{
      private $mamonhoc;
      private $ten_mh;
      private $sotinchi;
      private $sotiet_lt;
      private $sotiet_bt;
      private $sotiet_thtn;
      private $sogio_tuhoc;
      //định nghĩa phương thức để sau này nhận các thao tác tương ứng với action
      public function index() {
          //khởi tạo kết nối
        $conn = $this->connectDb();
        //truy vấn
        $sql = "SELECT * FROM MONHOC";
        $results = mysqli_query($conn,$sql);
        //khai báo biến trả về mảng
        $arr_monhocs = [];
        //Xử lý(ko show hết quả) trả về kết quả
        if (mysqli_num_rows($results) > 0) {
            $arr_monhocs = mysqli_fetch_all($results, MYSQLI_ASSOC);
        }
        $this->closeDb($conn);

        return $arr_monhocs;
    }
    public function update($monhoc = []) {
        $conn = $this->connectDb();
        $sql = "UPDATE MONHOC 
    SET ten_mh = '{$user['ten_mh']}', sotinchi = '{$user['sotinchi']}', sotiet_lt = '{$user['sotiet_lt']}', sotiet_bt = '{$user['sotiet_bt']}', sotiet_thtn = '{$user['sotiet_thtn']}', sogio_tuhoc = '{$user['sogio_tuhoc']}' WHERE mamonhoc = {$user['mamonhoc']}";
        $isUpdate = mysqli_query($conn, $sql);
        $this->closeDb($conn);

        return $isUpdate;
    }

      public function connectDb() {
        $connection = mysqli_connect(DB_HOST,
            DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (!$connection) {
            die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
        }

        return $connection;
    }

    public function closeDb($connection = null) {
        mysqli_close($connection);
    }
  }


?>