<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;
use PhucThinh\API\Classes\HelperClass;

/**
 * Report Back-end Controller
 */
class Report extends General {

    public function __construct() {
        
    }

    public function getListElectrical(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $fromDate = $request->get('from_date');
            $toDate = $request->get('to_date');
            $filterYear = $request->get('filter_year');
            if ($fromDate && $toDate) {
                $fromDate = date_create($fromDate);
                $toDate = date_create($toDate);

                $fromDateFormat = date_format($fromDate, "Y/m/d");
                $fromDateFormat = $fromDateFormat . ' 00:00:00';
                $toDateFormat = date_format($toDate, "Y/m/d");
                $toDateFormat = $toDateFormat . '23:59:00';

                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60:41440/api/InsertsTableThongKeChiPhiDiens';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentElectrical($resp);
                    return $this->respondWithSuccess($return, "Get List Electrical succesful!");
                } else {
                    return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                }
            } else {
                return $this->respondWithError('Dữ liệu không hợp lệ!!!');
            }
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentElectrical($data) {
        $objData = json_decode($data);
        $return = [];
        foreach ($objData as $index => $obj) {
            $tram1 = (int) $obj->chiPhiDien1Value36;
            $tram2 = (int) $obj->chiPhiDien2Value36;
            $tram3 = (int) $obj->chiPhiDien3Value36;
            $tram4 = (int) $obj->chiPhiDien4Value36;
            $tram5 = (int) $obj->chiPhiDien5Value36;
            $tram6 = (int) $obj->chiPhiDien6Value36;
            $tram7 = (int) $obj->chiPhiDien7Value36;
            $tram8 = (int) $obj->chiPhiDien8Value36;
            $tram9 = (int) $obj->chiPhiDien9Value36;
            $tram10 = (int) $obj->chiPhiDien10Value36;
            $total = $tram1 + $tram2 + $tram3 + $tram4 + $tram5 + $tram6 + $tram7 + $tram8 + $tram9 + $tram10;

            $return[$index]['id'] = $obj->id;
            $return[$index]['timeStamp'] = $obj->timeStamp;
            $return[$index]['tram1'] = $tram1;
            $return[$index]['tram2'] = $tram1;
            $return[$index]['tram3'] = $tram1;
            $return[$index]['tram4'] = $tram1;
            $return[$index]['tram5'] = $tram1;
            $return[$index]['tram6'] = $tram1;
            $return[$index]['tram7'] = $tram1;
            $return[$index]['tram8'] = $tram1;
            $return[$index]['tram9'] = $tram1;
            $return[$index]['tram10'] = $tram1;
            $return[$index]['total'] = $total;
            $return[$index]['total_station'] = 10;
        }
        return $return;
    }

    public function getListChemical(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $fromDate = $request->get('from_date');
            $toDate = $request->get('to_date');
            if ($fromDate && $toDate) {
                $fromDate = date_create($fromDate);
                $toDate = date_create($toDate);

                $fromDateFormat = date_format($fromDate, "Y/m/d");
                $fromDateFormat = $fromDateFormat . ' 00:00:00';
                $toDateFormat = date_format($toDate, "Y/m/d");
                $toDateFormat = $toDateFormat . '23:59:00';

                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60:41440/api/InsertsTableThongKeLuuLuongHoaChats';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentChemical($resp);
                    return $this->respondWithSuccess($return, "Get List Chemical succesful!");
                } else {
                    return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                }
            } else {
                return $this->respondWithError('Dữ liệu không hợp lệ!!!');
            }
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
        
    }

    private function parseContentChemical($data) {
        $objData = json_decode($data);
        $return = [];
        foreach ($objData as $index => $obj) {
            $hoaChat1 = (int) $obj->chiPhiHoaChat1Value1;
            $hoaChat2 = (int) $obj->chiPhiHoaChat2Value1;
            $hoaChat3 = (int) $obj->chiPhiHoaChat3Value1;
            $hoaChat4 = (int) $obj->chiPhiHoaChat4Value1;
            $hoaChat5 = (int) $obj->chiPhiHoaChat5Value1;
            $total = $hoaChat1 + $hoaChat2 + $hoaChat3 + $hoaChat4 + $hoaChat5;

            $return[$index]['id'] = $obj->id;
            $return[$index]['timeStamp'] = $obj->timeStamp;
            $return[$index]['lime'] = $hoaChat1;
            $return[$index]['pac'] = $hoaChat2;
            $return[$index]['polymer'] = $hoaChat3;
            $return[$index]['chlorine'] = $hoaChat4;
            $return[$index]['other'] = $hoaChat5;
            $return[$index]['total'] = $total;
            $return[$index]['total_station'] = 5;
        }
        return $return;
    }

    public function getListFlowmeter(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $fromDate = $request->get('from_date');
            $toDate = $request->get('to_date');
            if ($fromDate && $toDate) {
                $fromDate = date_create($fromDate);
                $toDate = date_create($toDate);

                $fromDateFormat = date_format($fromDate, "Y/m/d");
                $fromDateFormat = $fromDateFormat . ' 00:00:00';
                $toDateFormat = date_format($toDate, "Y/m/d");
                $toDateFormat = $toDateFormat . '23:59:00';

                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60:41440/api/InsertsTableThongKeLuuLuongHoaChats';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentFlowmeter($resp);
                    return $this->respondWithSuccess($return, "Get List Flowrate succesful!");
                } else {
                    return $this->respondWithMessage('Hiện tại Dữ Liệu đang được cập nhật!!!');
                }
            } else {
                return $this->respondWithError('Dữ liệu không hợp lệ!!!');
            }
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentFlowmeter($data) {
        $objData = json_decode($data);
        $return = [];
        foreach ($objData as $index => $obj) {
            $return[$index]['id'] = $obj->id;
            $return[$index]['timeStamp'] = $obj->timeStamp;
            $return[$index]['total'] = $obj->doanhSoBanNuocValue1;
            $return[$index]['total_station'] = 1;
        }
        return $return;
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
                    if($return){
                        return $this->respondWithSuccess($return, "Get List Motor succesful!");
                    }      
                    else{
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
			
			if(!isset($obj->$fieldModeStatus)){
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
                    if($return)
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
			
			if(!isset($obj->$fieldModeStatus)){
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
                    if($return)
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
			if(!isset($obj->$fieldModeStatus)){
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
