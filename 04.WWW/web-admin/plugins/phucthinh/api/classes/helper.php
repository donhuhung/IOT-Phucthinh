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
        $file = HelperClass::drawSensor(1,$file, $factoryID, $sensorFT01A, 297, 180);        
        $file = HelperClass::drawSensor(2,$file, $factoryID, $sensorFT01B, 297, 450);
        $file = HelperClass::drawSensor(3,$file, $factoryID, $sensorFT01C, 297, 720);
        $file = HelperClass::drawSensor(4,$file, $factoryID, $sensorLT06_01, 1675, 485);
        $file = HelperClass::drawSensor(5,$file, $factoryID, $sensorLT06_02, 1675, 500);
        $file = HelperClass::drawSensor(6,$file, $factoryID, $sensorLT06_03, 1675, 515);
        $file = HelperClass::drawSensor(7,$file, $factoryID, $sensorCL06, 1840, 785);
        $file = HelperClass::drawSensor(8,$file, $factoryID, $sensorPH06, 1840, 800);
        $file = HelperClass::drawSensor(9,$file, $factoryID, $sensorNTU06, 1840, 815);
        $file = HelperClass::drawSensor(10,$file, $factoryID, $sensorFT06_01, 1760, 962);
        $file = HelperClass::drawSensor(11,$file, $factoryID, $sensorFT06_02, 1760, 980);
        $file = HelperClass::drawSensor(11,$file, $factoryID, $sensorFT06_03, 1760, 1001);
        
        $fileOverview = url('').'/storage/app/media/overview/'.'overview-' . $factoryID . '.png';
        return $fileOverview;
    }

    private static function drawSensor($index,$file, $factoryID, $text, $x, $y) {
        $fileName = $index == 1?$file->getPath():$file;
        $extensionFile = $index == 1?$file->getExtension():'png';

        if ($extensionFile == 'png') {
            // Create Image From Existing File
            $source = imagecreatefrompng($fileName);
        } else {
            // Create Image From Existing File
            $source = imagecreatefromjpeg($fileName);
        }

        // Allocate A Color For The Text
        $black = imagecolorallocate($source, 0, 9, 169);

        // Set Path to Font File
        $font_path = storage_path() . '/app/assets/fonts/Roboto-Regular.ttf';

        imagefttext($source, 7, 0, $x, $y, $black, $font_path, $text);
				
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