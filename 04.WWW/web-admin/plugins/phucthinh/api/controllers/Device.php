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

            //Call API
            $link = 'http://115.78.130.60/api/UpdatesTableSensors/' . $factoryID;
            $resp = $this->callAPI($link, "GET");
            $return = $this->parseContentSensor($resp, $stations, $selects, $deviceName);

            return $this->respondWithSuccess($return, "Get List Sensor succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    //API Get List Sensor
    public function getListNameSenSor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Get Station
            $stations = $this->getStation($factoryID);

            //Get Info Select
            $selects = $this->getInfoSelect($factoryID);

            //Get Info Device
            $deviceName = $this->getDeviceName($factoryID);

            //Call API
            $link = 'http://115.78.130.60/api/UpdatesTableSensors/' . $factoryID;
            $resp = $this->callAPI($link, "GET");
            $return = $this->parseContentNameSensor($resp, $stations, $selects, $deviceName);

            return $this->respondWithSuccess($return, "Get List Sensor succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    //API Get List Motor
    public function getListMotor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Get Station
            $stations = $this->getStation($factoryID);

            //Get Info Device
            $deviceName = $this->getDeviceName($factoryID);

            //Call API
            $link = 'http://115.78.130.60/api/UpdatesTableMotors/' . $factoryID;
            $resp = $this->callAPI($link, "GET");

            $return = $this->parseContentMotor($resp, $stations, $deviceName);

            return $this->respondWithSuccess($return, "Get List Motor succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    //API Get List Motor Name
    public function getListNameMotor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Get Station
            $stations = $this->getStation($factoryID);

            //Get Info Device
            $deviceName = $this->getDeviceName($factoryID);

            //Call API
            $link = 'http://115.78.130.60/api/UpdatesTableMotors/' . $factoryID;
            $resp = $this->callAPI($link, "GET");

            $return = $this->parseContentNameMotor($resp, $stations, $deviceName);

            return $this->respondWithSuccess($return, "Get List Motor succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    //API Get List Valve
    public function getListValve(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Get Station
            $stations = $this->getStation($factoryID);

            //Get Info Device
            $deviceName = $this->getDeviceName($factoryID);

            //Call API
            $link = 'http://115.78.130.60/api/UpdatesTableValves/' . $factoryID;
            $resp = $this->callAPI($link, "GET");

            $return = $this->parseContentValve($resp, $stations, $deviceName);

            return $this->respondWithSuccess($return, "Get List Valve succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    //API Get List Valve Name
    public function getListNameValve(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Get Station
            $stations = $this->getStation($factoryID);

            //Get Info Device
            $deviceName = $this->getDeviceName($factoryID);

            //Call API
            $link = 'http://115.78.130.60/api/UpdatesTableMotors/' . $factoryID;
            $resp = $this->callAPI($link, "GET");

            $return = $this->parseContentNameValve($resp, $stations, $deviceName);

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

            $data = array("id" => (int) $factoryID, "timeStamp" => $now, $fieldSetPoint => $valueSetPoint);
            $postdata = json_encode($data);

            //Call API
            $link = 'http://115.78.130.60/api/SelectsTableSensors';
            $this->callAPI($link, "POST", $postdata);

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
                        if (isset($objData->$field) && $objData->$field > 0) {
                            /* echo "<prev>";
                              echo $field;
                              echo "</prev>"; */
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

    private function parseContentNameSensor($data, $stations, $selectTable, $deviceName) {

        //Parse Json
        $objData = json_decode($data);
        $objData = $objData[0];
        $objStation = json_decode($stations);
        $deviceName = json_decode($deviceName);
        $selectTable = json_decode($selectTable);
        $return = [];
        $loopSensor = 0;
        $dataSensor = [];

        //Parse Data               
        foreach ($objStation as $index => $station) {

            //Foreach Data
            $numberSensor = $station->numberSensor;
            $numberStart = $station->numberStartSensor;
            //Loop Item Sensor            
            for ($j = 0; $j < $numberSensor; $j++) {
                if (isset($deviceName[$numberStart - 1]->sensorName)) {
                    $sensorName = $this->translateAuto(trim($deviceName[$numberStart - 1]->sensorName));
                    $dataSensor[$loopSensor]['name'] = $sensorName . ' - ' . trim($deviceName[$numberStart - 1]->sensorSymbol);
                    $dataSensor[$loopSensor]['id'] = $numberStart;
                    $numberStart++;
                    $loopSensor++;
                }
            }
        }
        return $dataSensor;
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

    private function parseContentNameMotor($data, $stations, $deviceName) {

        //Parse Json
        $objData = json_decode($data);
        $objData = $objData[0];
        $objStation = json_decode($stations);
        $deviceName = json_decode($deviceName);
        $return = [];
        $loopSensor = 0;
        $dataSensor = [];

        //Parse Data               
        foreach ($objStation as $index => $station) {

            //Foreach Data
            $numberMotor = $station->numberMotor;
            $numberStart = $station->numberStartMotor;
            $start = ($numberStart - 1);
            $end = ($numberMotor + $numberStart - 1);
            //Loop Item Sensor            
            for ($j = $start; $j < $end; $j++) {
                if (isset($deviceName[$numberStart - 1]->motorName)) {
                    $motorName = $this->translateAuto(trim($deviceName[$numberStart - 1]->motorName));
                    $dataSensor[$loopSensor]['name'] = $motorName . ' - ' . trim($deviceName[$numberStart - 1]->motorSymbol);
                    $dataSensor[$loopSensor]['id'] = $numberStart;
                    $numberStart++;
                    $loopSensor++;
                }
            }
        }
        return $dataSensor;
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

    private function parseContentNameValve($data, $stations, $deviceName) {

        //Parse Json
        $objData = json_decode($data);
        $objData = $objData[0];
        $objStation = json_decode($stations);
        $deviceName = json_decode($deviceName);
        $return = [];
        $loopSensor = 0;
        $dataSensor = [];

        //Parse Data               
        foreach ($objStation as $index => $station) {

            //Foreach Data
            $numberValve = $station->numberValve;
            $numberStart = $station->numberStartValve;
            $start = ($numberStart - 1);
            $end = ($numberValve + $numberStart - 1);
            //Loop Item Sensor            
            for ($j = $start; $j < $end; $j++) {
                if (isset($deviceName[$numberStart - 1]->valveName)) {
                    $valveName = $this->translateAuto(trim($deviceName[$numberStart - 1]->valveName));
                    $dataSensor[$loopSensor]['name'] = $valveName . ' - ' . trim($deviceName[$numberStart - 1]->valveSymbol);
                    $dataSensor[$loopSensor]['id'] = $numberStart;
                    $numberStart++;
                    $loopSensor++;
                }
            }
        }
        return $dataSensor;
    }

    private function getStatusDevice() {
        try {
            //Call API
            $link = 'http://115.78.130.60/api/TableMotorValveSensorStatus';
            $resp = $this->callAPI($link, "GET");
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    private function getInfoSelect($factoryId) {
        try {
            //Call API
            $link = 'http://115.78.130.60/api/SelectsTableSensors/' . $factoryId;
            $resp = $this->callAPI($link, "GET");
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}
