<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Report Electrical Back-end Controller
 */
class ReportElectrical extends General {

    public function __construct() {
        
    }

    public function getListElectrical(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $fromDate = $request->get('from_date');
            $toDate = $request->get('to_date');
            $parseDataByMonth = false;
            if ($fromDate && $toDate) {
                $fromDate = date_create($fromDate);
                $toDate = date_create($toDate);

                $fromDateFormat = date_format($fromDate, "Y/m/d");
                $fromDateFormat = $fromDateFormat . ' 00:00:00';
                $toDateFormat = date_format($toDate, "Y/m/d");
                $toDateFormat = $toDateFormat . '23:59:00';

                $ts1 = strtotime($fromDateFormat);
                $ts2 = strtotime($toDateFormat);
                $month1 = date('m', $ts1);
                $month2 = date('m', $ts2);
                $numberMonth = $month2 - $month1;

                $year1 = date('Y', $ts1);
                $year2 = date('Y', $ts2);
                $numberYear = $year2 - $year1;
                if ($numberYear > 0 || $numberMonth > 2)
                    $parseDataByMonth = true;

                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60:41440/api/InsertsTableThongKeChiPhiDiens';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentElectrical($resp, $parseDataByMonth);
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

    private function parseContentElectrical($data, $isMonth) {
        $objData = json_decode($data);
        $return = [];
        $timeStampCurrent = '';
        $timeStamp = '';
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

            $timeStamp = date_format(date_create($obj->timeStamp), 'd-m-Y');
            //if ($timeStampCurrent != $timeStamp) {
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
                $return[$index]['date'] = $timeStamp;
                $timeStampCurrent = $timeStamp;
            //}
        }
        return $return;
    }
    

}
