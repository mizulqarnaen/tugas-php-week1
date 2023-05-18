<?php

		$data = <<<'EOD'

		X, -9\\\10\100\-5\\\0\\\\, A

		Y, \\13\\1\, B

		Z, \\\5\\\-3\\2\\\800, C

		EOD;

		$array = array_values(array_filter(explode(PHP_EOL,$data)));

		$numbers = [];
		$counter = [];

		foreach ($array as $key => $value) {
			
			$array[$key] = explode(', ',$value);

			foreach ($array[$key] as $k => $val) {
				
				if(strlen($val) > 1) {
					preg_match_all('/-?\\d+(?:\\d+)?/m', $val, $array[$key][$k]);
					$array[$key]['data'] = $array[$key][$k][0];
				} else {
					$array[$key]['key'][] = $val;
				}

				unset($array[$key][$k]);

			}

			foreach ($array[$key]['data'] as $number) {
				array_push($numbers, $number);
			}

		}

		sort($numbers);

		foreach ($numbers as $number) {
			
			foreach ($array as $key => $value) {
				
				if(in_array($number, $value['data'])) {
					$counter[$key]++;
					echo $value['key'][0].', '.$number.', '.$value['key'][1].', '.$counter[$key].'<br><br>';
				} else {
					continue;
				}

			}

		}
?>