<?
session_start();
switch ($_GET['a']) {
	case 'image':
		$im = @imagecreate (80, 21) or die ("Cannot initialize new GD image stream!");
		$bg = imagecolorallocate ($im, 232, 238, 247);
		$char = $_SESSION['code'];

		//������ ��� �� ����
		for ($i=0; $i<=128; $i++) {
			$color = imagecolorallocate ($im, rand(0,255), rand(0,255), rand(0,255)); //����� ����
			imagesetpixel($im, rand(2,80), rand(2,20), $color); //������ �������
		}

		//������� ������� ����
		for ($i = 0; $i < strlen($char); $i++) {
			$color = imagecolorallocate ($im, rand(0,255), rand(0,128), rand(0,255)); //����� ����
			$x = 5 + $i * 20;
			$y = rand(1, 6);
			imagechar ($im, 5, $x, $y, $char[$i], $color);
		}

		/*/���������� �������
		$color = imagecolorallocate($img, 0, 0, 0);
		imagestring($im, 3, 5, 3, $char, $color);*/

		//���������������
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		//�������� ������� � ����������� �� ���������� �������
		if (function_exists("imagepng")) {
		   header("Content-type: image/png");
		   imagepng($im);
		} elseif (function_exists("imagegif")) {
		   header("Content-type: image/gif");
		   imagegif($im);
		} elseif (function_exists("imagejpeg")) {
		   header("Content-type: image/jpeg");
		   imagejpeg($im);
		} else {
		   die("No image support in this PHP server!");
		}
		imagedestroy ($im);	
	break;
	case 'submit':
		//�������� ����
        
		if (empty($_GET['code']) or empty($_SESSION['code'])) {
			echo '�� �� ������� ��� �������������';
		} elseif ($_GET['code'] != $_SESSION['code']) {
			echo '��� ������������� �� ���������';
		} else {
			echo '�� Ok!';
		}
	break;
	default:
		$_SESSION['code'] = substr(md5(uniqid("")),0,4);
		echo '<img align="top" src="core/captcha.php?a=image">';
	break;
}
?>