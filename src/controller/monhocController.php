<?php
     require_once 'model/monhocModel.php';
     class monhocController{
         function index(){
             $monhocModel = new monhocModel();
             $monhocs = $monhocModel->index();
             require_once 'view/monhoc/index.php';
    }
         function edit()
         {
            if (!isset($_GET['mamonhoc'])) {
                $_SESSION['error'] = "Tham số không hợp lệ";
                header("Location: index.php?controller=monhoc&action=index");
                return;
            }
            if (!is_numeric($_GET['mamonhoc'])) {
                $_SESSION['error'] = "Id phải là số";
                header("Location: index.php?controller=monhoc&action=index");
                return;
            }
            $bd_id = $_GET['mamonhoc'];
            //gọi model để lấy ra đối tượng sách theo id
            $monhocModel = new monhocModel();
            $monhocs = $monhocModel->getMonhocById($mamonhoc);

            //xử lý submit form, lặp lại thao tác khi submit lúc thêm mới
            $error = '';
            if (isset($_POST['submit'])) {
                $ten_mh = $_POST['ten_mh'];
                $sotinchi = $_POST['sotinchi'];
                $sotiet_lt = $_POST['sotiet_lt'];
                $sotiet_bt = $_POST['sotiet_bt'];
                $sotiet_thtn = $_POST['sotiet_thtn'];
                $sogio_tuhoc = $_POST['sogio_tuhoc'];
                //check validate dữ liệu
                if (empty($ten_mh)) {
                    $error = "Name không được để trống";
                }
                else {
                    //xử lý update dữ liệu vào hệ thống
                    $monhocModel = new monhocModel();
                    $userArr = [
                        'mamonhoc' => $mamonhoc,
                        'ten_mh' => $ten_mh,
                        'sotinchi' => $sotinchi,
                        'sotiet_lt' => $sotiet_lt,
                        'sotiet_bt' => $sotiet_bt,
                        'sotiet_thtn' => $sotiet_thtn,
                        'sogio_tuhoc' => $sogio_tuhoc
                    ];
                    $isUpdate = $userModel->update($userArr);
                    if ($isUpdate) {
                        $_SESSION['success'] = "Update bản ghi #$bd_id thành công";
                    }
                    else {
                        $_SESSION['error'] = "Update bản ghi #$bd_id thất bại";
                    }
                    header("Location: index.php?controller=monhoc&action=index");
                    exit();
                }
            }
            //truyền ra view
            require_once 'view/monhoc/edit.php';
         }
     



        }
?>