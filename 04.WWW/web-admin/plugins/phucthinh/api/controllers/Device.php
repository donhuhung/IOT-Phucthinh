<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Device Back-end Controller
 */
class Device extends General {

    public function __construct() {
        
    }

    public function getListSenSor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Get Station
            $stations = $this->getStation($factoryID);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/UpdatesTableSensors/' . $factoryID,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            $return = $this->parseContentSensor($resp, $stations);
            curl_close($curl);
            return $this->respondWithSuccess($return, "Get List Sensor succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

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
            $return = $this->parseContentMotor($resp, $stations);

            curl_close($curl);
            return $this->respondWithSuccess($return, "Get List Device succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }
    
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
            $return = $this->parseContentValve($resp, $stations);

            curl_close($curl);
            return $this->respondWithSuccess($return, "Get List Valve succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentSensor($data, $stations) {
        //Get Info Device
        $deviceName = $this->getDeviceName();

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
            $dataSensor = [];
            $dataStationArr = [];

            //Foreach Data
            $numberSensor = $station->numberSensor;
            $numberStart = $station->numberStartSensor;
            //Loop Item Sensor            
            for ($j = 0; $j < $numberSensor; $j++) {
                if (isset($deviceName[$numberStart - 1]->sensorName)) {
                    $dataStationArr[$j]['name'] = trim($deviceName[$numberStart - 1]->sensorName);
                    $dataStationArr[$j]['symbol'] = trim($deviceName[$numberStart - 1]->sensorSymbol);
                    for ($k = 0; $k < 3; $k++) {
                        $isPercent = 'false';
                        $field = "sensor" . $numberStart . "Value" . ($k + 1);
                        $paramSensor = "sensorUnit" . ($k + 1);
                        if ($deviceName[$numberStart - 1]->$paramSensor == '%')
                            $isPercent = 'true';
                        $dataSensor[$k]['value'] = trim($objData->$field);
                        $dataSensor[$k]['unit'] = trim($deviceName[$numberStart - 1]->$paramSensor);
                        $dataSensor[$k]['is_percent'] = $isPercent;
                        $dataSensor[$k]['set_point'] = trim($deviceName[$numberStart - 1]->setpoint);
                        $dataSensor[$k]['field'] = $field;
                    }
                    $dataStationArr[$j]['data_sensor'] = $dataSensor;
                    $numberStart++;
                }
            }
            $stationArr['title'] = trim($station->stationName);
            $stationArr['data'] = $dataStationArr;
            $return[$index] = $stationArr;
        }
        return $return;
    }

    private function parseContentMotor($data, $stations) {
        //Get Info Device
        $deviceName = $this->getDeviceName();

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
            //Loop Item Sensor            
            for ($j = 0; $j < $numberMotor; $j++) {
                if (isset($deviceName[$numberStart - 1]->motorName)) {
                    $fieldStatus = 'motor' . ($j + 1) . 'ModeStatus';
                    $fieldOperationStatus = 'motor' . ($j + 1) . 'OperationStatus';
                    $fieldTotalOvl = 'motor' . ($j + 1) . 'TotalOvl';
                    $fieldTotalNrf = 'motor' . ($j + 1) . 'TotalNrf';
                    $fieldTotalRt = 'motor' . ($j + 1) . 'TotalRt';

                    $dataStationArr[$j]['name'] = trim($deviceName[$numberStart - 1]->motorName);
                    $dataStationArr[$j]['symbol'] = trim($deviceName[$numberStart - 1]->motorSymbol);
                    $dataStationArr[$j]['status'] = $objData->$fieldStatus;
                    $dataStationArr[$j]['status_name'] = $this->parseStatusDevice($objData->$fieldStatus);
                    $dataStationArr[$j]['operation_status'] = $objData->$fieldOperationStatus;
                    $dataStationArr[$j]['operation_status_name'] = $this->parseOperationStatusMotor($objData->$fieldOperationStatus);
                    $dataStationArr[$j]['totalovl'] = $objData->$fieldTotalOvl;
                    $dataStationArr[$j]['totalnrf'] = $objData->$fieldTotalNrf;
                    $dataStationArr[$j]['totalrt'] = $objData->$fieldTotalRt;
                    $numberStart++;
                }
            }
            $stationArr['title'] = trim($station->stationName);
            $stationArr['data'] = $dataStationArr;
            $return[$index] = $stationArr;
        }
        return $return;
    }
    
    private function parseContentValve($data, $stations) {
        //Get Info Device
        $deviceName = $this->getDeviceName();

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
            //Loop Item Sensor            
            for ($j = 0; $j < $numberValve; $j++) {
                if (isset($deviceName[$numberStart - 1]->valveName)) {
                    $fieldStatus = 'valve' . ($j + 1) . 'ModeStatus';
                    $fieldOperationStatus = 'valve' . ($j + 1) . 'OperationStatus';
                    $fieldTotalFO = 'valve' . ($j + 1) . 'TotalFo';
                    $fieldTotalFC = 'valve' . ($j + 1) . 'TotalFc';
                    $fieldTotalOC = 'valve' . ($j + 1) . 'TotalOc';

                    $dataStationArr[$j]['name'] = trim($deviceName[$numberStart - 1]->valveName);
                    $dataStationArr[$j]['symbol'] = trim($deviceName[$numberStart - 1]->valveSymbol);
                    $dataStationArr[$j]['status'] = $objData->$fieldStatus;
                    $dataStationArr[$j]['status_name'] = $this->parseStatusDevice($objData->$fieldStatus);
                    $dataStationArr[$j]['operation_status'] = $objData->$fieldOperationStatus;
                    $dataStationArr[$j]['operation_status_name'] = $this->parseOperationStatusValve($objData->$fieldOperationStatus);
                    $dataStationArr[$j]['totalfo'] = $objData->$fieldTotalFO;
                    $dataStationArr[$j]['totalfc'] = $objData->$fieldTotalFC;
                    $dataStationArr[$j]['totaloc'] = $objData->$fieldTotalOC;
                    $numberStart++;
                }
            }
            $stationArr['title'] = trim($station->stationName);
            $stationArr['data'] = $dataStationArr;
            $return[$index] = $stationArr;
        }
        return $return;
    }

    private function parseStatusDevice($status) {
        $result;
        switch ($status) {
            case 0:
                $result = "None";
                break;
            case 1:
                $result = "Local";
                break;
            case 2:
                $result = "Manu";
                break;  
            case 3:
                $result = "Auto";
                break;  
            case 4:
                $result = "Udf";
                break;  
        }
        return $result;
    }
    
    private function parseOperationStatusMotor($status) {
        $result;
        switch ($status) {
            case 0:
                $result = "None";
                break;
            case 1:
                $result = "Stop";
                break;
            case 2:
                $result = "Run";
                break;  
            case 3:
                $result = "F.OVL";
                break;  
            case 4:
                $result = "F.NRF";
                break;          
            case 5:
                $result = "Ack";
                break;  
            case 6:
                $result = "Udf";
                break;  
        }
        return $result;
    }
    
    private function parseOperationStatusValve($status) {
        $result;
        switch ($status) {
            case 0:
                $result = "None";
                break;
            case 1:
                $result = "Close";
                break;
            case 2:
                $result = "Mid";
                break;  
            case 3:
                $result = "Open";
                break;  
            case 4:
                $result = "F.O";
                break;          
            case 5:
                $result = "F.C";
                break;  
            case 6:
                $result = "Ack";
                break;  
            case 7:
                $result = "Udf";
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

    private function getDeviceName() {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/TableMotorValveSensors',
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}
