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
            $station = $request->get('station');
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

                $data = array("factoryID" => (int) $factoryID, "fromDate" => $fromDateFormat, 'toDate' => $toDateFormat, 'isMonth' => $parseDataByMonth);
                $postdata = json_encode($data);

                //Call API
                $link = 'http://115.78.130.60/api/InsertsTableThongKeChiPhiDienPts';
                $resp = $this->callAPI($link, "POST", $postdata);
                if ($resp) {
                    $return = $this->parseContentElectrical($resp, $parseDataByMonth, $station);
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

    private function parseContentElectrical($data, $isMonth, $station) {
        $obj = json_decode($data);
        $return = [];
        if ($obj) {
            foreach ($objData as $index => $obj) {
                $fieldDienThapDiem = 'dienTieuThu' . $station . 'Value1';
                $fieldDienBinhThuong = 'dienTieuThu' . $station . 'Value2';
                $fieldDienCaoDiem = 'dienTieuThu' . $station . 'Value3';
                $fieldDienTong = 'dienTieuThu' . $station . 'Value4';

                $fieldChiPhiDienThapDiem = 'chiPhiDien' . $station . 'Value1';
                $fieldChiPhiDienBinhThuong = 'chiPhiDien' . $station . 'Value2';
                $fieldChiPhiDienCaoDiem = 'chiPhiDien' . $station . 'Value3';
                $fieldChiPhiDienTong = 'chiPhiDien' . $station . 'Value4';

                if ($isMonth)
                    $timeStamp = "Tháng " . date_format(date_create($obj->timeStamp), 'm-Y');
                else
                    $timeStamp = date_format(date_create($obj->timeStamp), 'd-m-Y');

                $return[$index]['id'] = $obj->id;
                $return[$index]['timeStamp'] = $timeStamp;
                $return[$index]['bieu_gia_thap_diem'] = ($station != 8) ? (int) $obj->bieuGiaDienValue1 : (int) $obj->bieuGiaDienValue4;
                $return[$index]['bieu_gia_binh_thuong'] = ($station != 8) ? (int) $obj->bieuGiaDienValue2 : (int) $obj->bieuGiaDienValue4;
                $return[$index]['bieu_gia_cao_diem'] = ($station != 8) ? (int) $obj->bieuGiaDienValue3 : (int) $obj->bieuGiaDienValue4;
                $return[$index]['dien_tieu_thu_thap_diem'] = isset($obj->$fieldDienThapDiem) ? $obj->$fieldDienThapDiem : 0;
                $return[$index]['dien_tieu_thu_binh_thuong'] = isset($obj->$fieldDienBinhThuong) ? $obj->$fieldDienBinhThuong : 0;
                $return[$index]['dien_tieu_thu_cao_Diem'] = isset($obj->$fieldDienCaoDiem) ? $obj->$fieldDienCaoDiem : 0;
                $return[$index]['dien_tieu_thu_tong'] = isset($obj->$fieldDienTong) ? $obj->$fieldDienTong : 0;
                $return[$index]['chi_phi_dien_thap_diem'] = isset($obj->$fieldChiPhiDienThapDiem) ? (int) $obj->$fieldChiPhiDienThapDiem : 0;
                $return[$index]['chi_phi_dien_binh_thuong'] = isset($obj->$fieldChiPhiDienBinhThuong) ? (int) $obj->$fieldChiPhiDienBinhThuong : 0;
                $return[$index]['chi_phi_dien_cao_diem'] = isset($obj->$fieldChiPhiDienCaoDiem) ? $obj->$fieldChiPhiDienCaoDiem : 0;
                $return[$index]['chi_phi_dien_tong'] = isset($obj->$fieldChiPhiDienTong) ? $obj->$fieldChiPhiDienTong : 0;
            }
        }
        return $return;
    }

}
