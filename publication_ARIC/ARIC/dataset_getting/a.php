<!--echo "<script>alert('123');</script>";exit;-->

<?php

function postback () {
 

  // 1. 校验参数的完整性
  if (empty($_POST['username'])) {
    // 没有提交用户名 或 用户名为空字符串
    $GLOBALS['message'] = 'Please enter your name';

    echo "<script>alert('Please enter your name');</script>";

    echo "<script>";
    echo "window.location.href='http://121.43.152.254/dataset_getting/index.php'";
    echo "</script>";
    return;
  }

  
  if (empty($_POST['email'])) {

    $GLOBALS['message'] = 'Please enter your email';

    echo "<script>alert('Please enter your email');</script>";

    echo "<script>";
    echo "window.location.href='http://121.43.152.254/dataset_getting/index.php'";
    echo "</script>";
    return;
  }

  if (empty($_POST['institution'])) {
    $GLOBALS['message'] = 'Please enter your institution';
    echo "<script>alert('Please enter your institution');</script>";
    echo "<script>";
    echo "window.location.href='http://121.43.152.254/dataset_getting/index.php'";
    echo "</script>";
    return;
  }

  if (!(isset($_POST['agree']) && $_POST['agree'] === 'on')) {
    $GLOBALS['message'] = '必须同意注册协议';
    echo "<script>alert('You need to agree to the above agreement to use this data set');</script>";
    echo "<script>";
    echo "window.location.href='http://121.43.152.254/dataset_getting/index.php'";
    echo "</script>";
    return;
  }


  // 所有的校验都OK
  $username = $_POST['username'];
 // echo $username;
  $email = $_POST['email'];
  $institution = $_POST['institution'];
  
  $merge = $username .','. $email . ',' . $institution;

  //将merge转为数组
  //$merge_array = explode("   ",$merge);
 

  // 将数据保存到文本文件中
  file_put_contents('users.txt',  $merge . "\n", FILE_APPEND);
  $GLOBALS['message'] = 'submit is done';

  //存入csv


    
    // 文件名，这里都要将utf-8编码转为gbk，要不可能出现乱码现象
    $filename = iconv('utf-8','GBK','user.csv');
   
    
    // 拼接文件信息，这里注意两点
    // 1、字段与字段之间用逗号分隔开
    // 2、行与行之间需要换行符
    $fileData = iconv('utf-8','GBK','Name, E-mail, Istitution') . "\n";
    
    $fileData .= iconv('utf-8','GBK',$merge) . "\n";


    $filePath = __DIR__ . '/' . $filename;
    // 将一个字符串写入文件
    file_put_contents($filePath, $fileData . "\n", FILE_APPEND);

    return $filePath;

}
postback();


?>


<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>submit</title>
</head>
<body>
    <?php if (isset($message)): ?>
      <tr>
        <td>please wait 3 seconds...</td>
        <?php echo $message; 
        if ($message == "submit is done"):
            header("refresh:1;url=http://121.43.152.254/dataset_getting/download.html#download");
        endif;
        ?>
    
      </tr>
    <?php endif ?>
</body>
</html>

