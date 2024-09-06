<?php

function postback () {
 

  // 1. 校验参数的完整性
  if (empty($_POST['username'])) {
    // 没有提交用户名 或 用户名为空字符串
    $GLOBALS['message'] = 'Please enter your name';
    echo "<script>alert('123');</script>";exit;
    return;
  }

  
  if (empty($_POST['email'])) {
    $GLOBALS['message'] = 'Please enter your email';
    echo "<script>";
    echo "alert('123')";
    echo "</script>";
    echo "exit";
    return;
  }

  if (empty($_POST['institution'])) {
    $GLOBALS['message'] = 'Please enter your institution';
    echo "<script>alert('123');</script>";exit;
    return;
  }

  if (!(isset($_POST['agree']) && $_POST['agree'] === 'on')) {
    echo "<script>alert('123');</script>";exit;
    $GLOBALS['message'] = '必须同意注册协议';
    return;
  }

  // 所有的校验都OK
  $username = $_POST['username'];
  $email = $_POST['email'];
  $institution = $_POST['institution'];
  $message = $_POST['message'];
  
  $merge = $username .','. $email . ',' . $institution;

  // 将数据保存到文本文件中
  file_put_contents('users.txt',  $merge . "\n", FILE_APPEND);
  
  //存入csv
  // 文件名，这里都要将utf-8编码转为gbk，要不可能出现乱码现象
  $filename = iconv('utf-8','GBK','a.csv');
  $fileData = iconv('utf-8','GBK','Name, E-mail, Istitution') . "\n";
  $fileData .= iconv('utf-8','GBK',$merge) . "\n";
  $filePath = __DIR__ . '/' . $filename;

  file_put_contents($filePath, $fileData . "\n", FILE_APPEND);
  return $filePath;
  $GLOBALS['message'] = 'submit is done';
}




if ($_SERVER['REQUEST_METHOD'] === 'post') {
  postback();
}

?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>submit</title>
</head>
<body>

<font size = "8">ARIC</font>
</p><br/>  
Thank you for your interest in our ARIC dataset!By requesting access to the multimodal dataset,
I confirm that I will adhere to the following terms of use.
<p><br/>
1. The user will only use this dataset for
non-commericial academic research, e.g., exploring the methods for the task of
person grounding.
</p><br/>
2. If the user wishs to use ARIC for
additional purposes, please clarify the purpose in adavance and request the
approvemnet of the authors.
</p><br/>
3. Access to the dataset is restricted to
applicants who have been granted access.
</p><br/>
4. If the user uses ARIC in his
research, please cite the reference in this publications.5. The user will not redistribute ARIC or
its derivatives, unless given specific and prior approval from the authors.Please provide the following information for
requesting access to our ARIC dataset.
</p><br/>
  <!--<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">-->
  <form action="a.php" method="post">
    <table border="1">
      <tr>
          <td><label for="username">Name</label></td>
          <td><input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"></td>
      </tr>
		
	    <tr>
			    <td><label for="email">E-mail</label></td>
          <td><input type="email" name="email" id="email"></td>
	    </tr>		

      <tr>
			    <td><label for="institution">Institution</label></td>
          <td><input type="text" name="institution" id="institution"></td>
	    </tr>	
		
      <tr>
        <td></td>
        <td><label><input type="checkbox" name="agree" value="on"> I agree</label></td>
      </tr>
      
      <?php if (isset($message)): ?>
      <tr>
        <td></td>
        <td><?php echo $message; ?></td>
      </tr>
      <?php endif ?>

      <tr>
        <td></td>
        <td><button>submit</button></td>
      </tr>
    </table>
  </form>
</body>
</html>

