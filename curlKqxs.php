<?php
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Cấu hình cho CURL
	curl_setopt($ch, CURLOPT_URL, "https://ketqua.net/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// Thực thi CURL
	$html = curl_exec($ch);
	// Ngắt CURL, giải phóng
	curl_close($ch);
	// $html = file_get_contents('https://ketqua.net/');
	
	$result = array();
	if (preg_match('#<span class="pull-left col-sm-5 chu15" id="result_date">(.*?)</span>#', $html, $match)) {
		$result['day']=$match[1];
	}

	if (preg_match('#<td style="width:16%;vertical-align:middle;font-size:16px;color:red;">Đặc biệt</td><td id="rs_0_0" colspan="12" style="width:84%;" class="phoi-size chu22 gray need_blank vietdam phoi-size chu30 maudo stop-reload" rs_len="5">(.*?)</td>#', $html, $match)) {
		$result['dacbiet']=$match[1];
	}
	if (preg_match('#<td style="width:16%;vertical-align:middle;font-size:16px;">Giải nhất</td><td id="rs_1_0" colspan="12" style="width:84%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td>#', $html, $match)) {
		$result['giainhat']=$match[1];
	}
	if (preg_match('#<td style="width:16%;vertical-align:middle;font-size:16px;">Giải nhì</td><td id="rs_2_0" colspan="6" style="width:42%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td><td id="rs_2_1" colspan="6" style="width:42%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td>#', $html, $match)) {
		$result['giainhi1']=$match[1];
		$result['giainhi2']=$match[2];
	}
	if (preg_match('#<td rowspan="2" style="width:16%;vertical-align:middle;font-size:16px;">Giải ba</td><td id="rs_3_0" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td><td id="rs_3_1" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td><td id="rs_3_2" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td></tr><tr><td style="display:none"></td><td id="rs_3_3" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td><td id="rs_3_4" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td><td id="rs_3_5" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="5">(.*?)</td>#', $html, $match)) {
		$result['giaiba1']=$match[1];
		$result['giaiba2']=$match[2];
		$result['giaiba3']=$match[3];
		$result['giaiba4']=$match[4];
		$result['giaiba5']=$match[5];
		$result['giaiba6']=$match[6];
	}
	if (preg_match('#<td style="width:16%;vertical-align:middle;font-size:16px;">Giải tư</td><td id="rs_4_0" colspan="3" style="width:21%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td><td id="rs_4_1" colspan="3" style="width:21%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td><td id="rs_4_2" colspan="3" style="width:21%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td><td id="rs_4_3" colspan="3" style="width:21%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td>#', $html, $match)) {
		$result['giaitu1']=$match[1];
		$result['giaitu2']=$match[2];
		$result['giaitu3']=$match[3];
		$result['giaitu4']=$match[4];
	}
	if (preg_match('#<td rowspan="2" style="width:16%;vertical-align:middle;font-size:16px;">Giải năm</td><td id="rs_5_0" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td><td id="rs_5_1" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td><td id="rs_5_2" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td></tr><tr><td style="display:none"></td><td id="rs_5_3" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td><td id="rs_5_4" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td><td id="rs_5_5" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="4">(.*?)</td>#', $html, $match)) {
		$result['giainam1']=$match[1];
		$result['giainam2']=$match[2];
		$result['giainam3']=$match[3];
		$result['giainam4']=$match[4];
		$result['giainam5']=$match[5];
		$result['giainam6']=$match[6];
	}
	if (preg_match('#<td style="width:16%;vertical-align:middle;font-size:16px;">Giải sáu</td><td id="rs_6_0" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="3">(.*?)</td><td id="rs_6_1" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="3">(.*?)</td><td id="rs_6_2" colspan="4" style="width:28%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="3">(.*?)</td>#', $html, $match)) {
		$result['giaisau1']=$match[1];
		$result['giaisau2']=$match[2];
		$result['giaisau3']=$match[3];
	}
	if (preg_match('#<td style="width:16%;vertical-align:middle;font-size:16px;">Giải bảy</td><td id="rs_7_0" colspan="3" style="width:21%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="2">(.*?)</td><td id="rs_7_1" colspan="3" style="width:21%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="2">(.*?)</td><td id="rs_7_2" colspan="3" style="width:21%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="2">(.*?)</td><td id="rs_7_3" colspan="3" style="width:21%;" class="phoi-size chu22 gray need_blank vietdam" rs_len="2">(.*?)</td>#', $html, $match)) {
		$result['giaibay1']=$match[1];
		$result['giaibay2']=$match[2];
		$result['giaibay3']=$match[3];
		$result['giaibay4']=$match[4];
	}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Kết quả xổ số</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<h2><caption>Kết quả xổ số <?php echo $result['day']; ?></caption></h2>
		<table class="table table-bordered" style="font-size: 20px">
			<tr>
				<th>Đặc biệt</th>
				<td class="text-danger"><b><?php echo $result['dacbiet']; ?></b></td>
			</tr>
			<tr>
				<th>Giải nhất</th>
				<td class="text-warning"><?php echo $result['giainhat']; ?></td>
			</tr>
			<tr>
				<th>Giải nhì</th>
				<td class="text-primary"><?php echo $result['giainhi1'].' - '.$result['giainhi2']; ?></td>
			</tr>
			<tr>
				<th>Giải ba</th>
				<td class="text-warning"><?php echo $result['giaiba1'].' - '.$result['giaiba2'].' - '.$result['giaiba3'].' - '.$result['giaiba4'].' - '.$result['giaiba5'].' - '.$result['giaiba6']; ?></td>
			</tr>
			<tr>
				<th>Giải tư</th>
				<td class="text-success"><?php echo $result['giaitu1'].' - '.$result['giaitu2'].' - '.$result['giaitu3'].' - '.$result['giaitu4']; ?></td>
			</tr>
			<tr>
				<th>Giải năm</th>
				<td class="text-info"><?php echo $result['giainam1'].' - '.$result['giainam2'].' - '.$result['giainam3'].' - '.$result['giainam4'].' - '.$result['giainam5'].' - '.$result['giainam6']; ?></td>
			</tr>
			<tr>
				<th>Giải sáu</th>
				<td class="text-primary"><?php echo $result['giaisau1'].' - '.$result['giaisau2'].' - '.$result['giaisau3']; ?></td>
			</tr>
			<tr>
				<th>Giải bảy</th>
				<td class="text-success"><?php echo $result['giaibay1'].' - '.$result['giaibay2'].' - '.$result['giaibay3'].' - '.$result['giaibay4']; ?></td>
			</tr>
		</table>
	</div>
</body>
</html>
