<?php

namespace PhucThinh\API\Classes;

class HelperClass {

    public static function callAPI($link, $type, $postData = null) {
        $curl = curl_init();
        if ($type == "POST") {
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_URL => $link,
                CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $link,
                CURLOPT_SSL_VERIFYPEER => false,
            ));
        }
        $resp = curl_exec($curl);
		if (curl_errno($curl)) {
			$error_msg = curl_error($curl);
		}
		curl_close($curl);
		if (isset($error_msg)) {
			return $error_msg;
		}
        return $resp;
        
    }

    public static function getStation($factoryID) {
        try {
            //Call API
            $link = 'http://115.78.130.60/api/TableStations/' . $factoryID;
            $resp = self::callAPI($link, "GET");
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getDeviceName($factoryId) {
        try {
            //Call API
            $link = 'http://115.78.130.60/api/TableMotorValveSensors/' . $factoryId;
            $resp = self::callAPI($link, "GET");
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function getDataSensor($factoryID) {
        //Call API
        //Get Station
        $stations = self::getStation($factoryID);

        //Get Info Device
        $deviceName = self::getDeviceName($factoryID);

        $link = 'http://115.78.130.60/api/UpdatesTableSensors/' . $factoryID;
        $data = self::callAPI($link, "GET");
        //Parse Json
        $objData = json_decode($data);
		
        $objData = $objData[0];
        $objStation = json_decode($stations);
        $deviceName = json_decode($deviceName);
        $return = [];
        $loopSensor = 0;
        $dataSensor = [];

        foreach ($objStation as $index => $station) {
            //Define Variable
            $stationArr = [];
            $dataStationArr = [];

            //Foreach Data
            $numberSensor = $station->numberSensor;
            $numberStart = $station->numberStartSensor;
            //Loop Item Sensor            
            for ($j = 0; $j < $numberSensor; $j++) {
                $dataSensor = [];
                if (isset($deviceName[$numberStart - 1]->sensorName)) {
                    $dataStationArr[$j]['symbol'] = trim($deviceName[$numberStart - 1]->sensorSymbol);
                    $loopSensor = 0;
                    for ($k = 0; $k < 3; $k++) {
                        $field = "sensor" . $numberStart . "Value" . ($k + 1);
                        if (isset($objData->$field) && $objData->$field > 0) {
                            $dataSensor[$loopSensor]['value'] = isset($objData->$field) ? trim($objData->$field) : 0;
                            $loopSensor++;
                        }
                    }
                    $dataStationArr[$j]['data_sensor'] = $dataSensor;
                    $numberStart++;
                }
            }
            $return[$index] = $dataStationArr;
        }
        return $return;
    }

    public static function drawTextImageHaThanh($file, $factoryID) {
        $dataSensor = HelperClass::getDataSensor($factoryID);
        $sensorFT01A = $dataSensor[0][0]['data_sensor'][0]['value'];
        $sensorFT01B = $dataSensor[0][1]['data_sensor'][0]['value'];
        $sensorFT01C = $dataSensor[0][2]['data_sensor'][0]['value'];
        $sensorLT06_01 = $dataSensor[4][0]['data_sensor'][0]['value'];
        $sensorLT06_02 = $dataSensor[4][0]['data_sensor'][1]['value'];
        $sensorLT06_03 = $dataSensor[4][0]['data_sensor'][2]['value'];
        $sensorCL06 = $dataSensor[4][2]['data_sensor'][0]['value'];
        $sensorPH06 = $dataSensor[4][3]['data_sensor'][0]['value'];
        $sensorNTU06 = $dataSensor[4][4]['data_sensor'][0]['value'];
        $sensorFT06_01 = $dataSensor[4][5]['data_sensor'][0]['value'];
        $sensorFT06_02 = $dataSensor[4][5]['data_sensor'][1]['value'];
        $sensorFT06_03 = $dataSensor[4][5]['data_sensor'][2]['value'];
		$arrayData = [
			"ft01A" => [
				'text' => $sensorFT01A,
				'x' => 297,
				'y' => 180
			],
			"ft01B" => [
				'text' => $sensorFT01B,
				'x' => 297,
				'y' => 450
			],
			"ft01C" => [
				'text' => $sensorFT01C,
				'x' => 297,
				'y' => 720
			],
			"lT06_01" => [
				'text' => $sensorLT06_01,
				'x' => 1675,
				'y' => 485
			],
			"lT06_02" => [
				'text' => $sensorLT06_02,
				'x' => 1675,
				'y' => 500
			],
			"lT06_03" => [
				'text' => $sensorLT06_03,
				'x' => 1675,
				'y' => 515
			],
			"sensorCL06" => [
				'text' => $sensorCL06,
				'x' => 1840,
				'y' => 785
			],
			"sensorPH06" => [
				'text' => $sensorPH06,
				'x' => 1840,
				'y' => 800
			],
			"sensorNTU06" => [
				'text' => $sensorNTU06,
				'x' => 1840,
				'y' => 815
			],
			"sensorFT06_01" => [
				'text' => $sensorFT06_01,
				'x' => 1760,
				'y' => 962
			],
			"sensorFT06_02" => [
				'text' => $sensorFT06_02,
				'x' => 1760,
				'y' => 980
			],
			"sensorFT06_03" => [
				'text' => $sensorFT06_03,
				'x' => 1760,
				'y' => 1001
			],
			
		];
        $file = HelperClass::drawSensor($file, $factoryID, $arrayData);
        
        $fileOverview = url('').'/storage/app/media/overview/'.'overview-' . $factoryID . '.png';
        return $fileOverview;
    }

    private static function drawSensor($file, $factoryID, $arrayData) {
        $fileName = $file->getPath();
        $extensionFile = $file->getExtension();
		//$extensionFile = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($extensionFile == 'png') {
            // Create Image From Existing File
			if(exif_imagetype($fileName) != IMAGETYPE_JPEG){
				$source = imagecreatefrompng($fileName);
			}
			else
				return false;
        } else {
            // Create Image From Existing File
            $source = imagecreatefromjpeg($fileName);
        }

        // Allocate A Color For The Text
        $black = imagecolorallocate($source, 0, 9, 169);

        // Set Path to Font File
        $font_path = storage_path() . '/app/assets/fonts/Roboto-Regular.ttf';
		foreach($arrayData as $data){
			$text = $data['text'];
			$x = $data['x'];
			$y = $data['y'];
			imagefttext($source, 7, 0, $x, $y, $black, $font_path, $text);
		}
				
        $path = storage_path().'/app/media/overview/';
        $fileNameRotate = 'overview-' . $factoryID . '.' . $extensionFile;
        $fileSave = $path . $fileNameRotate;

        // Send Image to Browser
        if ($extensionFile == 'png') {
            imagepng($source, $fileSave);
        } else {
            imagejpeg($source, $fileSave, 100);
        }
        return $fileSave;
    }

}

?>