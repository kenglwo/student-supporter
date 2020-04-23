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

	$name = $_POST['student_name'];
	$name_furigana = $_POST['student_name_furigana'];
	$student_id = $_POST['student_id'];
	$affiliation = $_POST['affiliation'];
	$grade = $_POST['grade'];
	$tel = $_POST['tel'];
	$email_university = $_POST['email_university'];
	$email_private = $_POST['email_private'];

	$interest_pc_note = $_POST['interest_pc_note'];
	$interest_hand_note = $_POST['interest_hand_note'];
	$interest_caption = $_POST['interest_caption'];
	$interest_guide = $_POST['interest_guide'];
	$interest_audiobook = $_POST['interest_audiobook'];

	$ability_pc = $_POST['ability_pc'];
	$ability_typing = $_POST['ability_typing'];
	$ability_sign_language = $_POST['ability_sign_language'];
	$ability_fast_writing = $_POST['ability_fast_writing'];
	$ability_english = $_POST['ability_english'];

	$class = $_POST['class']; // may be array
	$boki = "履修していない";
	$statistics = "履修していない";
	$teaching = "履修していない";
	
	if (in_array("簿記", $class)) { $boki = "履修している"; } 
	if (in_array("統計", $class)) { $statistics = "履修している"; } 
	if (in_array("教員免許", $class)) { $teaching = "履修している"; } 

	$line = $_POST['line'];
	$insurance1_if_subscribe = $_POST['insurance1_if_subscribe'];
	$insurance2_if_subscribe = $_POST['insurance2_if_subscribe'];
	$if_confirmation = $_POST['if_confirmation'];
	$application_reason = $_POST['application_reason'];

	$data = "{$date}, {$name}, {$name_furigana}, {$student_id}, {$affiliation}, {$grade}, {$tel}, {$email_university}, {$email_private}, {$interest_pc_note}, {$interest_hand_note}, {$interest_caption}, {$interest_guide}, {$interest_audiobook}, {$ability_pc}, {$ability_typing}, {$ability_sign_language}, {$ability_fast_writing}, {$ability_english}, {$boki}, {$statistics}, {$teaching}, {$line}, {$insurance1_if_subscribe}, {$insurance2_if_subscribe}, {$if_confirmation}, {$application_reason}\n";
	$data_quarantined = str_replace( "\0", "", $data );
	$data_quarantined = htmlspecialchars($data_quarantined, ENT_QUOTES, "UTF-8");
	$data_quarantined = mb_convert_encoding($data_quarantined, "SJIS", "UTF-8");


	file_put_contents($file, $data_quarantined, FILE_APPEND);

	// require("./send_mail.php");

?>
