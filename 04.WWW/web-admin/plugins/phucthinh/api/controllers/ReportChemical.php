<?php namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Report Chemical Back-end Controller
 */
class ReportChemical extends General
{    

    public function __construct()
    {        
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
}
