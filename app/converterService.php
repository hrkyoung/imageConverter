<?php

while (1==1) {
	$db = json_decode(file_get_contents('db.json'), true);

foreach ($db as $key => $value) {
	if ($value['status'] === "Ready") {
		$file = 'public/upload/' . $value["originalFilename"];
		$ext = pathinfo($file);

		if ($ext == 'png') {
			$im = imagecreatefrompng($file);
		} else {
			$im = imagecreatefromjpeg($file);
		}

		var_dump($file);

		imagefilter($im, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
		imagejpeg($im, 'public/upload/converted' . $value["originalFilename"]);

		$db[$key]['status'] = 'Done';
		$db[$key]['convertedFile'] = 'converted' . $value["originalFilename"];
	}
}

file_put_contents('db.json', json_encode($db));

var_dump("done");

sleep(10);
}

