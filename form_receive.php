<?php

	$html_file = './form.html';
	$raw_html  = '';
	$pattern   = '/<(h[1])>(.*)<\/h[1]>/';
	$header    = [];

	try { $raw_html = file_get_contents($html_file); }
		catch(Exception $e){ var_dump($e->getMessage()); }

	if(preg_match_all($pattern, $raw_html, $matches, PREG_SET_ORDER) === false){
		exit(); // or 'return false', 'throw new Exception(...)', ...
	}

	foreach($matches as $match){
		$header = $match[2];
	}

	$file = "./submitted_data.csv";
	if(filesize($file) == 0){
		$header = mb_convert_encoding($header, "SJIS", "UTF-8");
		file_put_contents($file, "{$header}\n");
	};

	$date = date("Y/m/d H:i:s");
	$affiliation = $_POST['affiliation'];
	$student_id = $_POST['student_id'];
	$name = $_POST['name'];
	$name_furigana = $_POST['name_furigana'];
	$email = $_POST['email'];
	$tel = $_POST['tel'];

	$data = "{$date}, {$affiliation}, {$student_id}, {$name}, {$name_furigana}, {$email}, {$tel}\n";
	$data_quarantined = str_replace( "\0", "", $data );
	$data_quarantined = htmlspecialchars($data_quarantined, ENT_QUOTES, "UTF-8");
	$data_quarantined = mb_convert_encoding($data_quarantined, "SJIS", "UTF-8");

	file_put_contents($file, $data_quarantined, FILE_APPEND);

	require("./send_mail.php");

?>