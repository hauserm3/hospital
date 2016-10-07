<?php
ini_set('html_errors', false);
$post = json_decode(file_get_contents('php://input'),true);
echo json_encode($post);
if (isset($_FILES)){

    foreach ($_FILES['file']['name'] as $k=>$v){
        $uploaddir = $_SERVER['DOCUMENT_ROOT'] ."room/app/icons/";
        //новое имя изображения
        echo $uploaddir;
        echo json_encode($_FILES);
//        $apend=date('YmdHis').rand(100,1000).'.png';
//        //путь к новому изображению
//        $uploadfile = "$uploaddir$apend";
//
//        //Проверка расширений загружаемых изображений
//        if($_FILES['file']['type'][$k] == "image/gif" || $_FILES['file']['type'][$k] == "image/png" ||
//            $_FILES['file']['type'][$k] == "image/jpg" || $_FILES['file']['type'][$k] == "image/jpeg")
//        {
//            //черный список типов файлов
//            $blacklist = array(".php", ".phtml", ".php3", ".php4");
//            foreach ($blacklist as $item)
//            {
//                if(preg_match("/$item\$/i", $_FILES['file']['name'][$k]))
//                {
//                    echo "Нельзя загружать скрипты.";
//                    exit;
//                }
//            }
//
//            //перемещаем файл из временного хранилища
//            if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $uploadfile))
//            {
//                //получаем размеры файла
//                $size = getimagesize($uploadfile);
//                //проверяем размеры файла, если они нам подходят, то оставляем файл
//                if ($size[0] < $pic_weight && $size[1] < $pic_height)
//                {
//                    //.....код
//                    //я обычно заношу пути к изображениям в бд
//                    //.....код
//
//                    echo "<center><br>Файл ($uploadfile) загружен.</center>";
//                }
//                //если размеры файла нам не подходят, то удаляем файл unlink($uploadfile);
//                else
//                {
//                    echo "<center><br>Размер пикселей превышает допустимые нормы.</center>";
//                    unlink($uploadfile);
//                }
//            }
//            else
//                echo "<center><br>Файл не загружен, вернитесь и попробуйте еще раз.</center>";
//        }
//        else
//            echo "<center><br>Можно загружать только изображения в форматах jpg, jpeg, gif и png.</center>";
    }
}
?>