<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Device Back-end Controller
 */
class Device extends General {

    public function __construct() {
        
    }

    //API Get List Sensor
    public function getListSenSor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Get Station
            $stations = $this->getStation($factoryID);

            //Get Info Select
            $selects = $this->getInfoSelect($factoryID);
            
            //Get Info Device
            $deviceName = $this->getDeviceName($factoryID);
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/UpdatesTableSensors/' . $factoryID,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            $return = $this->parseContentSensor($resp, $stations, $selects, $deviceName);
            curl_close($curl);
            return $this->respondWithSuccess($return, "Get List Sensor succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    //API Get List Motor
    public function getListMotor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/UpdatesTableMotors/' . $factoryID,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);

            //Get Station
            $stations = $this->getStation($factoryID);
			
			//Get Info Device
			$deviceName = $this->getDeviceName($factoryID);
		
            $return = $this->parseContentMotor($resp, $stations, $deviceName);

            curl_close($curl);
            return $this->respondWithSuccess($return, "Get List Motor succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    //API Get List Valve
    public function getListValve(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/UpdatesTableValves/' . $factoryID,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);

            //Get Station
            $stations = $this->getStation($factoryID);
			
			//Get Info Device
			$deviceName = $this->getDeviceName($factoryID);
		
            $return = $this->parseContentValve($resp, $stations, $deviceName);

            curl_close($curl);
            return $this->respondWithSuccess($return, "Get List Valve succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    //API Update Setpoint Sensor
    public function updateSetPoint(Request $request) {
        try {
            $factoryID = $request->get('id_set_point');
            $fieldSetPoint = $request->get('field_set_point');
            $valueSetPoint = $request->get('value_set_point');
            $now = date('Y-m-d H:i:s');
            $curl = curl_init();

            $data = array("id" => (int)$factoryID, "timeStamp" => $now, $fieldSetPoint => $valueSetPoint);            
            $postdata = json_encode($data);

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/SelectsTableSensors',
                CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            curl_exec($curl);

            curl_close($curl);
            return $this->respondWithMessage("Update Setpoint succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentSensor($data, $stations, $selectTable, $deviceName) {        

        //Parse Json
        $objData = json_decode($data);
        $objData = $objData[0];
        $objStation = json_decode($stations);
        $deviceName = json_decode($deviceName);
        $selectTable = json_decode($selectTable);
        $return = [];

        //Parse Data               
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
					$fieldSetPoint = "sensor" . $numberStart . "SetPer";
					
					$sensorName = $this->translateAuto(trim($deviceName[$numberStart - 1]->sensorName));
                    $dataStationArr[$j]['name'] = $sensorName;
                    $dataStationArr[$j]['symbol'] = trim($deviceName[$numberStart - 1]->sensorSymbol);
					$dataStationArr[$j]['set_point'] = isset($selectTable->$fieldSetPoint) ? trim($selectTable->$fieldSetPoint) : 0;
					$dataStationArr[$j]['edit_set_point'] = trim($deviceName[$numberStart - 1]->setpoint) == 1 ? 'true' : 'false';
					$dataStationArr[$j]['field_set_point'] = $fieldSetPoint;
					$dataStationArr[$j]['id_set_point'] = trim($selectTable->id);
					$loopSensor = 0;
                    for ($k = 0; $k < 3; $k++) {						
						$isPercent = 'false';
						$field = "sensor" . $numberStart . "Value" . ($k + 1);						
						$paramSensor = "sensorUnit" . ($k + 1);
						if(isset($objData->$field) && $objData->$field > 0){
							/*echo "<prev>";
							echo $field;		
							echo "</prev>";*/
							if (trim($deviceName[$numberStart - 1]->$paramSensor) == '%')
								$isPercent = 'true';
							$dataSensor[$loopSensor]['value'] = isset($objData->$field) ? trim($objData->$field) : 0;
							$dataSensor[$loopSensor]['unit'] = isset($deviceName[$numberStart - 1]->$paramSensor) ? trim($deviceName[$numberStart - 1]->$paramSensor) : '';
							$dataSensor[$loopSensor]['is_percent'] = $isPercent;		
							$loopSensor++;
						}                                             
                    }
                    $dataStationArr[$j]['data_sensor'] = $dataSensor;
                    $numberStart++;
                }
            }
            $stationArr['title'] = trim($station->stationName);
            $stationArr['data_list'] = $dataStationArr;
            $return[$index] = $stationArr;
        }
        return $return;
    }

    private function parseContentMotor($data, $stations, $deviceName) {        

        //Parse Json
        $objData = json_decode($data);
        $objData = $objData[0];
        $objStation = json_decode($stations);
        $deviceName = json_decode($deviceName);
        $return = [];

        //Parse Data               
        foreach ($objStation as $index => $station) {
            //Define Variable
            $stationArr = [];
            $dataStationArr = [];

            //Foreach Data
            $numberMotor = $station->numberMotor;
            $numberStart = $station->numberStartMotor;
			$start = ($numberStart - 1);
			$end = ($numberMotor + $numberStart - 1);
			$loop = 0;
            //Loop Item Motor            
            for ($j = $start; $j < $end; $j++) {
                if (isset($deviceName[$numberStart - 1]->motorName)) {
                    $fieldStatus = 'motor' . ($j + 1) . 'ModeStatus';
                    $fieldOperationStatus = 'motor' . ($j + 1) . 'OperationStatus';
                    $fieldTotalOvl = 'motor' . ($j + 1) . 'TotalOvl';
                    $fieldTotalNrf = 'motor' . ($j + 1) . 'TotalNrf';
                    $fieldTotalRt = 'motor' . ($j + 1) . 'TotalRt';
                    
                    $dataStatus = $this->parseStatusDevice($objData->$fieldStatus);
                    $statusName = $dataStatus['name'];
                    $statusColor = $dataStatus['color'];
                    
                    $dataOperationStatus = $this->parseOperationStatusMotor($objData->$fieldOperationStatus);
                    $operationStatusName = $dataOperationStatus['name'];
                    $operationStatusColor = $dataOperationStatus['color'];

					$motorName = $this->translateAuto(trim($deviceName[$numberStart - 1]->motorName));
                    $dataStationArr[$loop]['name'] = $motorName;
                    $dataStationArr[$loop]['symbol'] = trim($deviceName[$numberStart - 1]->motorSymbol);
                    $dataStationArr[$loop]['status'] = $objData->$fieldStatus;
					$dataStationArr[$loop]['status_identity'] = $fieldStatus;
                    $dataStationArr[$loop]['status_name'] = $statusName;
                    $dataStationArr[$loop]['status_color'] = $statusColor;
                    $dataStationArr[$loop]['operation_status'] = $objData->$fieldOperationStatus;
                    $dataStationArr[$loop]['operation_status_name'] = $operationStatusName;
                    $dataStationArr[$loop]['operation_status_color'] = $operationStatusColor;
                    $dataStationArr[$loop]['totalovl'] = $objData->$fieldTotalOvl;
                    $dataStationArr[$loop]['totalnrf'] = $objData->$fieldTotalNrf;
                    $dataStationArr[$loop]['totalrt'] = $objData->$fieldTotalRt;                    
                }
				$numberStart++;
				$loop++;
            }
            $stationArr['title'] = trim($station->stationName);
            $stationArr['data_motor'] = $dataStationArr;
            $return[$index] = $stationArr;
        }
        return $return;
    }

    private function parseContentValve($data, $stations, $deviceName) {        

        //Parse Json
        $objData = json_decode($data);
        $objData = $objData[0];
        $objStation = json_decode($stations);
        $deviceName = json_decode($deviceName);
        $return = [];

        //Parse Data               
        foreach ($objStation as $index => $station) {
            //Define Variable
            $stationArr = [];
            $dataStationArr = [];

            //Foreach Data
            $numberValve = $station->numberValve;
            $numberStart = $station->numberStartValve;
			$start = ($numberStart - 1);
			$end = ($numberValve + $numberStart - 1);
			$loop = 0;
            //Loop Item Valve            
            for ($j = $start; $j < $end; $j++) {
                if (isset($deviceName[$numberStart - 1]->valveName)) {
                    $fieldStatus = 'valve' . ($j + 1) . 'ModeStatus';
                    $fieldOperationStatus = 'valve' . ($j + 1) . 'OperationStatus';
                    $fieldTotalFO = 'valve' . ($j + 1) . 'TotalFo';
                    $fieldTotalFC = 'valve' . ($j + 1) . 'TotalFc';
                    $fieldTotalOC = 'valve' . ($j + 1) . 'TotalOc';
                    
                    $dataStatus = $this->parseStatusDevice($objData->$fieldStatus);
                    $statusName = $dataStatus['name'];
                    $statusColor = $dataStatus['color'];
                    
                    $dataOperationStatus = $this->parseOperationStatusValve($objData->$fieldOperationStatus);
                    $operationStatusName = $dataOperationStatus['name'];
                    $operationStatusColor = $dataOperationStatus['color'];

					$valveName = $this->translateAuto(trim($deviceName[$numberStart - 1]->valveName));
                    $dataStationArr[$loop]['name'] = $valveName;
                    $dataStationArr[$loop]['symbol'] = trim($deviceName[$numberStart - 1]->valveSymbol);
                    $dataStationArr[$loop]['status'] = $objData->$fieldStatus;
                    $dataStationArr[$loop]['status_name'] = $statusName;
                    $dataStationArr[$loop]['status_color'] = $statusColor;
                    $dataStationArr[$loop]['operation_status'] = $objData->$fieldOperationStatus;
                    $dataStationArr[$loop]['operation_status_name'] = $operationStatusName;
                    $dataStationArr[$loop]['operation_status_color'] = $operationStatusColor;
                    $dataStationArr[$loop]['totalfo'] = $objData->$fieldTotalFO;
                    $dataStationArr[$loop]['totalfc'] = $objData->$fieldTotalFC;
                    $dataStationArr[$loop]['totaloc'] = $objData->$fieldTotalOC;
                }
				$numberStart++;
				$loop++;
            }
            $stationArr['title'] = trim($station->stationName);
            $stationArr['data_valve'] = $dataStationArr;
            $return[$index] = $stationArr;
        }
        return $return;
    }

    private function parseStatusDevice($status) {
        $result = [];
        switch ($status) {
            case 0:
                $result['name'] = "None";
                $result['color'] = "#ffffff";
                break;
            case 1:
                $result['name'] = "Local";
                $result['color'] = "#ffffff";
                break;
            case 2:
                $result['name'] = "Manu";
                $result['color'] = "#ffffff";
                break;
            case 3:
                $result['name'] = "Auto";
                $result['color'] = "#ffffff";
                break;
            case 4:
                $result['name'] = "Udf";
                $result['color'] = "#808080";
                break;
        }
        return $result;
    }

    private function parseOperationStatusMotor($status) {
        $result = [];
        switch ($status) {
            case 0:
                $result['name'] = "None";
                $result['color'] = "#ffffff";
                break;
            case 1:
                $result['name'] = "Stop";
                $result['color'] = "#FF0000";
                break;
            case 2:
                $result['name'] = "Run";
                $result['color'] = "#008000";
                break;
            case 3:
                $result['name'] = "F.OVL";
                $result['color'] = "#FFFF00";
                break;
            case 4:
                $result['name'] = "F.NRF";
                $result['color'] = "#FFFF00";
                break;
            case 5:                
                $result['name'] = "Ack";
                $result['color'] = "#FFFF00";
                break;
            case 6:
                $result['name'] = "Udf";
                $result['color'] = "#808080";
                break;
        }
        return $result;
    }

    private function parseOperationStatusValve($status) {
        $result = [];
        switch ($status) {
            case 0:
                $result['name'] = "None";
                $result['color'] = "#ffffff";
                break;
            case 1:
                $result['name'] = "Close";
                $result['color'] = "#FF0000";
                break;
            case 2:
                $result['name'] = "Mid";
                $result['color'] = "#FF0000";
                break;
            case 3:
                $result['name'] = "Open";
                $result['color'] = "#008000";
                break;
            case 4:
                $result['name'] = "F.O";
                $result['color'] = "#FFFF00";
                break;
            case 5:
                $result['name'] = "F.C";
                $result['color'] = "#FFFF00";
                break;
            case 6:
                $result['name'] = "Ack";
                $result['color'] = "#FFFF00";
                break;
            case 7:
                $result['name'] = "Udf";
                $result['color'] = "#808080";
                break;
        }
        return $result;
    }

    private function getStation($factoryID) {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/TableStations/' . $factoryID,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    private function getStatusDevice() {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/TableMotorValveSensorStatus',
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    private function getDeviceName($factoryId) {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/TableMotorValveSensors/'.$factoryId,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    private function getInfoSelect($factoryId) {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/SelectsTableSensors/' . $factoryId,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
	
	private function translateAuto($string){
		$original = ["Luu","luong","Muc","Ap","suat","Bom", "gieng", "Quat", "hoa", "Khuay","Hut","xa","bun","hoi","gio","rua","loc","nuoc","sach","vao","cap","khi","be","Nhiet","do"];
		$modify   = ["Lưu","lượng","Mực","Áp","suất","Bơm", "Giếng", "Quạt", "hóa", "Khuấy","Hút","xả","bùn","hồi","gió","rửa","lọc","nước","sạch","vào","cấp","khí","bể","Nhiệt","độ"];
		return str_replace($original, $modify, $string);        
	}

}
