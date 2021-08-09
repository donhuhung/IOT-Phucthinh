<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Report Back-end Controller
 */
class Report extends General {

    public function __construct() {
        
    }

    public function getListMotor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $fromDate = $request->get('from_date');
            $toDate = $request->get('to_date');
            $numberStart = $request->get('number_start');
            $numberEnd = $request->get('number_end');

            $type = "Motor";
            $checkStation = $this->checkStation($factoryID, $type, $numberStart, $numberEnd);
            if ($fromDate && $toDate) {
                //Get Device Name
                $deviceName = $this->getDeviceName($factoryID);


                $fromDate = date_create($fromDate);

                $toDate = date_create($toDate);

                $fromDateFormat = date_format($fromDate, "Y/n/d H:i:s");
                $fromDateFormat = $fromDateFormat;
                $toDateFormat = date_format($toDate, "Y/n/d H:i:s");
                $toDateFormat = $toDateFormat;
                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60:41440/api/InsertsTableMotors';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentMotor($resp, $deviceName, $numberStart);
                    if ($return) {
                        return $this->respondWithSuccess($return, "Get List Motor succesful!");
                    } else {
                        return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                    }
                } else {
                    return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                }
            } else {
                return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
            }
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function checkStation($factoryID, $type, $numberStart) {
        //Get Station        
        $stations = $this->getStation($factoryID);
        $stations = json_decode($stations);
        foreach ($stations As $station) {
            $fieldTotal = 'number' . $type;
            $fieldNumberStartType = 'numberStart' . $type;
            $total = $station->$fieldTotal;
            $numberStartType = $station->$fieldNumberStartType;
        }
    }

    private function parseContentMotor($data, $deviceName, $numberStart) {
        $objData = json_decode($data);
        $deviceName = json_decode($deviceName);
        //print_r($objData);die;
        $return = [];
        $loop = 0;
        $loopNumberStart = $numberStart;
        $dataMotor = [];
        $dataMotorArr = [];
        foreach ($objData as $index => $obj) {
            $fieldModeStatus = 'motor' . $loopNumberStart . 'ModeStatus';
            $fieldOperationStatus = 'motor' . $loopNumberStart . 'OperationStatus';
            $fieldTotalOvl = 'motor' . $loopNumberStart . 'TotalOvl';
            $fieldTotalNrf = 'motor' . $loopNumberStart . 'TotalNrf';
            $fieldTotalRt = 'motor' . $loopNumberStart . 'TotalRt';

            if (!isset($obj->$fieldModeStatus)) {
                return false;
            }

            $dataStatus = $this->parseStatusDevice($obj->$fieldModeStatus);
            $statusName = $dataStatus['name'];

            $dataOperationStatus = $this->parseOperationStatusValve($obj->$fieldOperationStatus);
            $operationStatusName = $dataOperationStatus['name'];

            $dataMotorArr['id'] = $obj->id;
            $dataMotorArr['timeStamp'] = $obj->timeStamp;
            $dataMotorArr['mode_status'] = $statusName;
            $dataMotorArr['operation_status'] = $operationStatusName;
            $dataMotorArr['total_ovl'] = $obj->$fieldTotalOvl;
            $dataMotorArr['total_nrf'] = $obj->$fieldTotalNrf;
            $dataMotorArr['total_rt'] = $obj->$fieldTotalRt;
            $return[$index] = $dataMotorArr;
        }
        return $return;
    }

    public function getListValve(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $fromDate = $request->get('from_date');
            $toDate = $request->get('to_date');
            $numberStart = $request->get('number_start');

            $type = "Valve";
            $checkStation = $this->checkStation($factoryID, $type, $numberStart);
            if ($fromDate && $toDate) {
                //Get Device Name
                $deviceName = $this->getDeviceName($factoryID);


                $fromDate = date_create($fromDate);

                $toDate = date_create($toDate);

                $fromDateFormat = date_format($fromDate, "Y/n/d H:i:s");
                $fromDateFormat = $fromDateFormat;
                $toDateFormat = date_format($toDate, "Y/n/d H:i:s");
                $toDateFormat = $toDateFormat;
                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60:41440/api/InsertsTableValves';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentValve($resp, $deviceName, $numberStart);
                    if ($return)
                        return $this->respondWithSuccess($return, "Get List Valve succesful!");
                    else
                        return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                } else {
                    return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                }
            } else {
                return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
            }
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentValve($data, $deviceName, $numberStart) {
        $objData = json_decode($data);
        $deviceName = json_decode($deviceName);
        //print_r($objData);die;
        $return = [];
        $loop = 0;
        $loopNumberStart = $numberStart;
        $dataMotorArr = [];
        foreach ($objData as $index => $obj) {
            $fieldModeStatus = 'valve' . $loopNumberStart . 'ModeStatus';
            $fieldOperationStatus = 'valve' . $loopNumberStart . 'OperationStatus';
            $fieldTotalFO = 'valve' . $loopNumberStart . 'TotalFo';
            $fieldTotalFC = 'valve' . $loopNumberStart . 'TotalFc';
            $fieldTotalOC = 'valve' . $loopNumberStart . 'TotalOc';

            if (!isset($obj->$fieldModeStatus)) {
                return false;
            }

            $dataStatus = $this->parseStatusDevice($obj->$fieldModeStatus);
            $statusName = $dataStatus['name'];

            $dataOperationStatus = $this->parseOperationStatusValve($obj->$fieldOperationStatus);
            $operationStatusName = $dataOperationStatus['name'];

            $dataMotorArr['id'] = $obj->id;
            $dataMotorArr['timeStamp'] = $obj->timeStamp;
            $dataMotorArr['mode_status'] = $statusName;
            $dataMotorArr['operation_status'] = $operationStatusName;
            $dataMotorArr['total_fo'] = $obj->$fieldTotalFO;
            $dataMotorArr['total_fc'] = $obj->$fieldTotalFC;
            $dataMotorArr['total_oc'] = $obj->$fieldTotalOC;
            $return[$index] = $dataMotorArr;
        }
        return $return;
    }

    public function getListSensor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $fromDate = $request->get('from_date');
            $toDate = $request->get('to_date');
            $numberStart = $request->get('number_start');

            $type = "Sensor";
            if ($fromDate && $toDate) {
                //Get Device Name
                $deviceName = $this->getDeviceName($factoryID);


                $fromDate = date_create($fromDate);

                $toDate = date_create($toDate);

                $fromDateFormat = date_format($fromDate, "Y/n/d H:i:s");
                $fromDateFormat = $fromDateFormat;
                $toDateFormat = date_format($toDate, "Y/n/d H:i:s");
                $toDateFormat = $toDateFormat;
                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60:41440/api/InsertsTableSensors';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentSensor($resp, $deviceName, $numberStart);
                    if ($return)
                        return $this->respondWithSuccess($return, "Get List Sensor succesful!");
                    else
                        return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                } else {
                    return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                }
            } else {
                return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
            }
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentSensor($data, $deviceName, $numberStart) {
        $objData = json_decode($data);
        $deviceName = json_decode($deviceName);
        //print_r($objData);die;
        $return = [];
        $loop = 0;
        $dataMotor = [];
        $dataMotorArr = [];
        foreach ($objData as $index => $obj) {
            $fieldModeStatus = 'sensor' . $numberStart . 'Status';
            if (!isset($obj->$fieldModeStatus)) {
                return false;
            }
            $fieldValue1 = 'sensor' . $numberStart . 'Value1';
            $fieldValue2 = 'sensor' . $numberStart . 'Value2';
            $fieldValue3 = 'sensor' . $numberStart . 'Value3';
            $fieldTotalF = 'sensor' . $numberStart . 'TotalF';

            $dataStatus = $this->parseStatusDevice($obj->$fieldModeStatus);
            $statusName = $dataStatus['name'];

            $dataMotorArr['id'] = $obj->id;
            $dataMotorArr['timeStamp'] = $obj->timeStamp;
            $dataMotorArr['mode_status'] = $statusName;
            $dataMotorArr['value1'] = $obj->$fieldValue1;
            $dataMotorArr['value2'] = $obj->$fieldValue2;
            $dataMotorArr['value3'] = $obj->$fieldValue3;
            $dataMotorArr['total_f'] = $obj->$fieldTotalF;
            $dataMotor[$index] = $dataMotorArr;
        }
        return $dataMotor;
    }

}
