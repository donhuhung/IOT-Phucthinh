<?php namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Report Flowmeter Back-end Controller
 */
class ReportFlowmeter extends General
{    

    public function __construct()
    {        
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

                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat,'isMonth' => $parseDataByMonth);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60/api/InsertsTableThongKeLuuLuongHoaChatPts';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentFlowmeter($resp, $parseDataByMonth);
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

    private function parseContentFlowmeter($data, $isMonth) {
        $objData = json_decode($data);
        $return = [];
        foreach ($objData as $index => $obj) {
            if($isMonth)
                $timeStamp = "Tháng ".date_format(date_create($obj->timeStamp), 'm-Y');
            else 
                $timeStamp = date_format(date_create($obj->timeStamp), 'd-m-Y');
            
            $return[$index]['id'] = $obj->id;
            $return[$index]['timeStamp'] = $timeStamp;
            $return[$index]['total'] = $obj->doanhSoBanNuocValue1;
            $return[$index]['total_station'] = 1;
        }
        return $return;
    }
}
