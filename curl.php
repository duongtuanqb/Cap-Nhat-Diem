<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include ("./Curl/ArrayUtil.php");
include ("./Curl/CaseInsensitiveArray.php");
include ("./Curl/Curl.php");
include ("./Curl/Decoder.php");
include ("./Curl/MultiCurl.php");
include ("./DiDom/Document.php");
include ("./DiDom/Element.php");
include ("./DiDom/Encoder.php");
include ("./DiDom/Errors.php");
include ("./DiDom/Query.php");
	
	if(empty($_GET['mssv'])) {
		echo false;
		die;
	}

	$curl = new Curl();  
	$curl->setOpt(CURLOPT_ENCODING , '');
	$html = $curl->get('http://sinhvien.tdnu.edu.vn/XemDiem.aspx?MSSV='.$_GET['mssv']);

	if(strpos($html, 'MSSV không hợp lệ')) {
		echo false;
		die;
	}

	$doc = new Document();
	$doc->loadHtml($html);

	// Ten sinh vien
	$name = trim($doc->find('.main-content .title-group')[0]->text());
	$name = str_replace("BẢNG KẾT QUẢ HỌC TẬP\r\n            \r\n            ", "", $name);

	$elements = $doc->find('.tblKetQuaHocTap tr');
	
	$elements = array_slice($elements, 3);

	$ketqua = ['name' => $name, 'somonf' => 0, 'somond' => 0, 'somondplus' => 0, 'somona' => 0, 'somonaplus' => 0, 'somonb' => 0, 'somonbplus' => 0, 'somonc' => 0, 'somoncplus' => 0];

	$tinchiArr = [];
	$diemhe10Arr = [];
	$diemhe4Arr = [];

	$KoTinhDiem = ['Giáo dục Quốc phòng', 'Giáo dục thể chất 1', 'Giáo dục thể chất 2', 'Giáo dục thể chất 3'];

	foreach ($elements as $e) {
		if($e->child(15)) {

			if(empty(trim($e->child(15)->text()))) {
				continue;
			}

			if(in_array(trim($e->child(5)->text()), $KoTinhDiem)) {
				continue;
			}

			$diemhe10 = (float)trim($e->child(15)->text());
			array_push($diemhe10Arr, $diemhe10);

			$tinchi = (int)trim($e->child(9)->text());
			array_push($tinchiArr, $tinchi);
			
			$diemhe4 = (float)trim($e->child(21)->text());
			array_push($diemhe4Arr, $diemhe4);
			
			$diemchu = trim($e->child(23)->text());

			switch ($diemchu) {
				case 'A':
					$ketqua['somona']++;
					break;

				case 'A+':
					$ketqua['somonaplus']++;
					break;

				case 'B':
					$ketqua['somonb']++;
					break;

				case 'B+':
					$ketqua['somonbplus']++;
					break;

				case 'C':
					$ketqua['somonc']++;
					break;

				case 'C+':
					$ketqua['somoncplus']++;
					break;

				case 'D':
					$ketqua['somond']++;
					break;
				
				case 'D+':
					$ketqua['somondplus']++;
					break;

				case 'F':
					$ketqua['somonf']++;
					break;

				default:
					break;
			}
		}
	}

	$tongtinchi = array_sum($tinchiArr);
	$ketqua['tongtinchi'] = $tongtinchi;

	$tongdiemhe10 = 0;
	foreach ($diemhe10Arr as $key => $value) {
		$tongdiemhe10 = $tongdiemhe10 + ($value * $tinchiArr[$key]);
	}
	$tbche10 = round($tongdiemhe10 / $tongtinchi, 2);
	$ketqua['tbche10'] = $tbche10;

	$tongdiemhe4 = 0;
	foreach ($diemhe4Arr as $key => $value) {
		$tongdiemhe4 = $tongdiemhe4 + ($value * $tinchiArr[$key]);
	}
	$tbche4 = round($tongdiemhe4 / $tongtinchi, 2);
	$ketqua['tbche4'] = $tbche4;

	print_r(json_encode($ketqua));
