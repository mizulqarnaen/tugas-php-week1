<?php

	// inputan data
	$data = <<<'EOD'

	X, -9\\\10\100\-5\\\0\\\\, A

	Y, \\13\\1\, B

	Z, \\\5\\\-3\\2\\\800, C

	EOD;

	// membuat array dari setiap baris
	$array = array_values(array_filter(explode(PHP_EOL,$data)));

	// inisialisasi variabel array yang dibutuhkan
	$numbers = [];
	$counter = [];

	foreach ($array as $key => $value) {
		
		// mengubah data setiap barisnya menjadi array dengan pemisahnya yaitu koma
		$array[$key] = explode(', ',$value);

		// lalu looping array tersebut untuk memisahkan karakter dan angka
		foreach ($array[$key] as $k => $val) {
			
			if(strlen($val) > 1) { // jika datanya lebih dari 1 karakter

				// mengambil semua angka yang ada pada string
				preg_match_all('/-?\\d+(?:\\d+)?/m', $val, $array[$key][$k]);

				// menyimpan angka angka tersebut ke index baru dengan nama 'data'
				$array[$key]['data'] = $array[$key][$k][0];

			} else { // jika datanya terdiri dari 1 karakter

				// menyimpan karakter tersebut ke index baru dengan nama 'key'
				// index 'data' dan 'key' ini hanya untuk mempermudah pembacaan data saja
				$array[$key]['key'][] = $val;

			}

			// hapus array karena sudah digantikan dengan index 'key' dan 'data'
			unset($array[$key][$k]);

		}

		// angka angka pada index data dimasukkan ke array baru
		foreach ($array[$key]['data'] as $number) {
			array_push($numbers, $number);
		}

	}

	// angka-angka yang sudah didapatkan, diurutkan dari yang terkecil
	sort($numbers);

	// looping angka angka yang diurutkan tersebut untuk dicek satu per satu
	foreach ($numbers as $number) {
		
		foreach ($array as $key => $value) {
			
			if(in_array($number, $value['data'])) {

				// setiap angka yang ditemukan, counter akan bertambah berdasarkan $key (index)
				$counter[$key]++;

				// tampilkan data sesuai dengan yang dibutuhkan
				echo $value['key'][0].', '.$number.', '.$value['key'][1].', '.$counter[$key].'<br><br>';

			} else {

				// jika tidak ditemukan, skip ke data selanjutnya
				continue;

			}

		}

	}

?>