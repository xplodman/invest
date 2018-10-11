<?php
	$national_id = $_POST['national_id'];
	// start posting and checking system
	if (strlen($national_id) == 14 ) { //checking the length

		if (is_numeric($national_id)){ //checking numeric
			$century = substr($national_id,0,1);

			if ($century > 1 && $century < 4){ // 2 or 3
				$year = substr($national_id,1,2);
				$month = substr($national_id,3,2);

				if ($month > 0 && $month < 13){
					$day = substr($national_id,5,2);

					if ($day > 0 && $day < 32){
						$birth_city = substr($national_id,7,2);
						$birth_citys =  array('01', '02', '03', '04', '11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '23', '24', '25', '26', '27', '28', '29', '31', '32', '33', '34', '35', '88');

						if ( in_array( $birth_city, $birth_citys ) ){
							$gender = substr($national_id,12,1);

							if ($century == 2){
								$year = '19'.$year;
							}elseif ($century == 3){
								$year = '20'.$year;
							}

							switch ($birth_city) {
								case "01":
									$birth_city = "القاهرة";
									break;
								case "02":
									$birth_city = "الإسكندرية";
									break;
								case "03":
									$birth_city = "بورسعيد";
									break;
								case "04":
									$birth_city = "السويس";
									break;
								case "11":
									$birth_city = "دمياط";
									break;
								case "12":
									$birth_city = "الدقهلية";
									break;
								case "13":
									$birth_city = "الشرقية";
									break;
								case "14":
									$birth_city = "القليوبية";
									break;
								case "15":
									$birth_city = "كفر الشيخ";
									break;
								case "16":
									$birth_city = "الغربية";
									break;
								case "17":
									$birth_city = "المنوفية";
									break;
								case "18":
									$birth_city = "البحيرة";
									break;
								case "19":
									$birth_city = "الإسماعيلية";
									break;
								case "21":
									$birth_city = "الجيزة";
									break;
								case "22":
									$birth_city = "بني سويف";
									break;
								case "23":
									$birth_city = "الفيوم";
									break;
								case "24":
									$birth_city = "المنيا";
									break;
								case "25":
									$birth_city = "أسيوط";
									break;
								case "26":
									$birth_city = "سوهاج";
									break;
								case "27":
									$birth_city = "قنا";
									break;
								case "28":
									$birth_city = "أسوان";
									break;
								case "29":
									$birth_city = "الأقصر";
									break;
								case "31":
									$birth_city = "البحر الأحمر";
									break;
								case "32":
									$birth_city = "الوادي الجديد";
									break;
								case "33":
									$birth_city = "مطروح";
									break;
								case "34":
									$birth_city = "شمال سيناء";
									break;
								case "35":
									$birth_city = "جنوب سيناء";
									break;
								case "88":
									$birth_city = "خارج مصر";
									break;
							}

							if ($gender % 2 == 0) {
								$gender = "أنثى";
							}else{
								$gender = "ذكر";
							}
$_POST['gender'] =$gender;
							echo "0";//right
							exit();
						}else{
							echo "1";//wrong_city
							exit;
						}
					}else{
						echo "2";//wrong_day
						exit;
					}
				}else{
					echo "3";//wrong_month
					exit;
				}
			}else{
				echo "4";//wrong_century
				exit;
			}
		}else{
			echo "5";//wrong_type
			exit;
		}
	}else{
		echo "6";//wrong_lengh
		exit;
	}

?>
