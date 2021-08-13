<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Statistic Electrical Back-end Controller
 */
class StatisticElectrical extends General {

    public function __construct() {
        
    }

    public function getListElectrical(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Call API
            $linkThongSoDien = 'http://115.78.130.60/api/UpdatesTableThongKeThongSoDiens/' . $factoryID;
            $dataThongSoDien = $this->callAPI($linkThongSoDien, "GET");

            $linkBieuGiaDien = 'http://115.78.130.60/api/UpdatesTableThongKeChiPhiDiens/' . $factoryID;
            $dataBieuGiaDien = $this->callAPI($linkBieuGiaDien, "GET");

            $thongSoDien = $this->parseContentThongSoDien($dataThongSoDien);
            $dienNangTieuThu = $this->parseContentDienNangTieuThu($dataThongSoDien, $dataBieuGiaDien);
            $bieuGiaDien = $this->parseContentBieuGiaDien($dataBieuGiaDien);

            $return['thong_so_dien'] = $thongSoDien;
            $return['bieu_gia_dien'] = $bieuGiaDien;
            $return['dien_nang_tieu_thu'] = $dienNangTieuThu;

            return $this->respondWithSuccess($return, "Get List Electrical succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentThongSoDien($data) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        $dataStation = [];
        //Foreach Trạm
        for ($i = 0; $i < 8; $i++) {
            //Define Variable
            $stationArr = [];
            $stationTotalArr = [];
            $dataStationArr = [];
            $dataStationTotalArr = [];
            //Foreach Thông Số
            $field1 = 'thongSoDien' . ($i + 1) . 'Value1';
            $field2 = 'thongSoDien' . ($i + 1) . 'Value2';
            $field3 = 'thongSoDien' . ($i + 1) . 'Value3';
            $field4 = 'thongSoDien' . ($i + 1) . 'Value4';
            $field5 = 'thongSoDien' . ($i + 1) . 'Value5';
            $field6 = 'thongSoDien' . ($i + 1) . 'Value6';
            $field7 = 'thongSoDien' . ($i + 1) . 'Value7';
            $field8 = 'thongSoDien' . ($i + 1) . 'Value8';
            $field9 = 'thongSoDien' . ($i + 1) . 'Value9';
            $field10 = 'thongSoDien' . ($i + 1) . 'Value10';
            $field11 = 'thongSoDien' . ($i + 1) . 'Value11';
            $field12 = 'thongSoDien' . ($i + 1) . 'Value12';
            $field13 = 'thongSoDien' . ($i + 1) . 'Value13';
            $field14 = 'thongSoDien' . ($i + 1) . 'Value14';
            $field15 = 'thongSoDien' . ($i + 1) . 'Value15';
            $field16 = 'thongSoDien' . ($i + 1) . 'Value16';
            $field17 = 'thongSoDien' . ($i + 1) . 'Value17';
            $field18 = 'thongSoDien' . ($i + 1) . 'Value18';
            $field19 = 'thongSoDien' . ($i + 1) . 'Value19';
            $field20 = 'thongSoDien' . ($i + 1) . 'Value20';
            $field21 = 'thongSoDien' . ($i + 1) . 'Value21';
            $field22 = 'thongSoDien' . ($i + 1) . 'Value22';
            $field23 = 'thongSoDien' . ($i + 1) . 'Value23';
            $field24 = 'thongSoDien' . ($i + 1) . 'Value24';
            $field25 = 'thongSoDien' . ($i + 1) . 'Value25';

            if ($objData->$field1 && $objData->$field2 && $objData->$field3 && $objData->$field4 && $objData->$field5) {
                //Parse Data Thông số tức thời
                $dataStationArr['v1-v2'] = $objData->$field1;
                $dataStationArr['v1-n'] = $objData->$field2;
                $dataStationArr['v2-v3'] = $objData->$field3;
                $dataStationArr['v2-n'] = $objData->$field4;
                $dataStationArr['v3-v1'] = $objData->$field5;
                $dataStationArr['v3-n'] = $objData->$field6;
                $dataStationArr['v-n'] = $objData->$field7;
                $dataStationArr['a1'] = $objData->$field8;
                $dataStationArr['a2'] = $objData->$field9;
                $dataStationArr['a3'] = $objData->$field10;
                $dataStationArr['an'] = $objData->$field11;
                $dataStationArr['hz'] = $objData->$field12;
                $dataStationArr['cosp'] = $objData->$field13;
                $dataStationArr['kwh'] = $objData->$field14;
                $dataStationArr['kvarh'] = $objData->$field15;
                $dataStationArr['kvah'] = $objData->$field16;
                $dataStationArr['thd'] = $objData->$field17;

                //Parse Data Thông số tổng
                $dataStationTotalArr['kwh-day'] = $objData->$field18;
                $dataStationTotalArr['kvarh-day'] = $objData->$field19;
                $dataStationTotalArr['kwh-month'] = $objData->$field20;
                $dataStationTotalArr['kvarh-month'] = $objData->$field21;
                $dataStationTotalArr['kwh-year'] = $objData->$field22;
                $dataStationTotalArr['kvarh-year'] = $objData->$field23;
                $dataStationTotalArr['kwh-total'] = $objData->$field24;
                $dataStationTotalArr['kvarh-total'] = $objData->$field25;

                //Parse Data Thông số Tổng                
                $stationArr['title'] = 'Thông số tức thời - mcc' . ($i + 1);
                $stationArr['info'] = $dataStationArr;
                $stationTotalArr['title'] = 'Thông số tổng - mcc' . ($i + 1);
                $stationTotalArr['info'] = $dataStationTotalArr;
                $dataStation['title'] = 'Thông Số Điện - Trạm Mcc' . ($i + 1);
                $dataStation['data_list'][0] = $stationArr;
                $dataStation['data_list'][1] = $stationTotalArr;
                $return[$i] = $dataStation;
            }
        }
        return $return;
    }

    private function parseContentBieuGiaDien($data) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];

        $stationArrLuoiDien = [];
        $stationArrTuPhat = [];

        //Lưới Điện
        $dataBieuGiaLuoiDienArr = [];
        $dataDienNangLuoiDienArr = [];
        $dataChiPhiLuoiDienArr = [];

        //Tự phát
        $dataBieuGiaMayPhatArr = [];
        $dataDienNangMayPhatArr = [];
        $dataChiPhiMayPhatArr = [];

        $dataBieuGiaLuoiDien = [];
        $dataDienNangLuoiDien = [];
        $dataChiPhiLuoiDien = [];

        $dataBieuGiaMayPhat = [];
        $dataDienNangMayPhat = [];
        $dataChiPhiMayPhat = [];

        //Group Lưới Điện
        $dataBieuGiaLuoiDien['title'] = 'Biểu Giá Điện Lưới:VND/Kwh';
        $dataBieuGiaLuoiDienArr['thap_diem'] = $objData->bieuGiaDienValue1;
        $dataBieuGiaLuoiDienArr['binh_thuong'] = $objData->bieuGiaDienValue2;
        $dataBieuGiaLuoiDienArr['cao_diem'] = $objData->bieuGiaDienValue3;
        $dataBieuGiaLuoiDien['info'] = $dataBieuGiaLuoiDienArr;

        $dataDienNangLuoiDien['title'] = 'Điện Năng Tiêu Thụ:Kwh';
        $dataDienNangLuoiDienArr['trong_ngay'] = $objData->chiPhiDien7Value4;
        $dataDienNangLuoiDienArr['trong_thang'] = $objData->chiPhiDien7Value13;
        $dataDienNangLuoiDienArr['trong_nam'] = $objData->chiPhiDien7Value22;
        $dataDienNangLuoiDienArr['tong'] = $objData->chiPhiDien7Value31;
        $dataDienNangLuoiDien['info'] = $dataDienNangLuoiDienArr;

        $dataChiPhiLuoiDien['title'] = 'Chi Phí Điện Năng:VNĐ';
        $dataChiPhiLuoiDienArr['trong_ngay'] = $objData->chiPhiDien7Value4;
        $dataChiPhiLuoiDienArr['trong_thang'] = $objData->chiPhiDien7Value13;
        $dataChiPhiLuoiDienArr['trong_nam'] = $objData->chiPhiDien7Value22;
        $dataChiPhiLuoiDienArr['tong'] = $objData->chiPhiDien7Value31;
        $dataChiPhiLuoiDien['info'] = $dataChiPhiLuoiDienArr;

        //Group tự Phát
        $dataBieuGiaMayPhat['title'] = 'Biểu Giá Điện Tự Phát:VND/Kwh';
        $dataBieuGiaMayPhatArr['thap_diem'] = $objData->bieuGiaDienValue4;
        $dataBieuGiaMayPhatArr['binh_thuong'] = $objData->bieuGiaDienValue4;
        $dataBieuGiaMayPhatArr['cao_diem'] = $objData->bieuGiaDienValue4;
        $dataBieuGiaMayPhat['info'] = $dataBieuGiaMayPhatArr;

        $dataDienNangMayPhat['title'] = 'Điện Năng Tiêu Thụ:Kwh';
        $dataDienNangMayPhatArr['trong_ngay'] = $objData->bieuGiaDienValue1;
        $dataDienNangMayPhatArr['trong_thang'] = $objData->bieuGiaDienValue2;
        $dataDienNangMayPhatArr['trong_nam'] = $objData->bieuGiaDienValue3;
        $dataDienNangMayPhatArr['tong'] = $objData->bieuGiaDienValue3;
        $dataDienNangMayPhat['info'] = $dataDienNangMayPhatArr;

        $dataChiPhiMayPhat['title'] = 'Chi Phí Điện Năng:VNĐ';
        $dataChiPhiMayPhatArr['trong_ngay'] = $objData->chiPhiDien8Value4;
        $dataChiPhiMayPhatArr['trong_thang'] = $objData->chiPhiDien8Value13;
        $dataChiPhiMayPhatArr['trong_nam'] = $objData->chiPhiDien8Value22;
        $dataChiPhiMayPhatArr['tong'] = $objData->chiPhiDien8Value31;
        $dataChiPhiMayPhat['info'] = $dataChiPhiMayPhatArr;

        //Lưới Điện
        $stationArrLuoiDien['title'] = 'Điện Lưới';
        $stationArrLuoiDien['data_list'][0] = $dataBieuGiaLuoiDien;
        $stationArrLuoiDien['data_list'][1] = $dataDienNangLuoiDien;
        $stationArrLuoiDien['data_list'][2] = $dataChiPhiLuoiDien;

        //Tự phát
        $stationArrTuPhat['title'] = 'Điện Tự Phát';
        $stationArrTuPhat['data_list'][0] = $dataBieuGiaMayPhat;
        $stationArrTuPhat['data_list'][1] = $dataDienNangMayPhat;
        $stationArrTuPhat['data_list'][2] = $dataChiPhiMayPhat;

        $return[0] = $stationArrLuoiDien;
        $return[1] = $stationArrTuPhat;
        return $return;
    }

    private function parseContentDienNangTieuThu($data, $dataChiPhiDien) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Foreach Trạm
        for ($i = 0; $i < 8; $i++) {
            //Define Variable
            $stationArr = [];

            $dataTrongNgayKwh = [];
            //$dataTrongNgayKvarh = [];
            $dataTrongThangKwh = [];
            //$dataTrongThangKvarh = [];
            $dataTrongNamKwh = [];
            //$dataTrongNamKvarh = [];
            $dataTongKwh = [];
            //$dataTongKvrah = [];

            $dataTrongNgayKwhArr = [];
            //$dataTrongNgayKvarhArr = [];
            $dataTrongThangKwhArr = [];
            //$dataTrongThangKvarhArr = [];
            $dataTrongNamKwhArr = [];
            //$dataTrongNamKvarhArr = [];
            $dataTongKwhArr = [];
            //$dataTongKvrahArr = [];
            //Foreach Thông Số
            $field1 = 'dienTieuThu' . ($i + 1) . 'Value1';
            $field2 = 'dienTieuThu' . ($i + 1) . 'Value2';
            $field3 = 'dienTieuThu' . ($i + 1) . 'Value3';
            $field4 = 'dienTieuThu' . ($i + 1) . 'Value4';
            $field5 = 'dienTieuThu' . ($i + 1) . 'Value5';
            $field6 = 'dienTieuThu' . ($i + 1) . 'Value6';
            $field7 = 'dienTieuThu' . ($i + 1) . 'Value7';
            $field8 = 'dienTieuThu' . ($i + 1) . 'Value8';
            $field9 = 'dienTieuThu' . ($i + 1) . 'Value9';
            $field10 = 'dienTieuThu' . ($i + 1) . 'Value10';
            $field11 = 'dienTieuThu' . ($i + 1) . 'Value11';
            $field12 = 'dienTieuThu' . ($i + 1) . 'Value12';
            $field13 = 'dienTieuThu' . ($i + 1) . 'Value13';
            $field14 = 'dienTieuThu' . ($i + 1) . 'Value14';
            $field15 = 'dienTieuThu' . ($i + 1) . 'Value15';
            $field16 = 'dienTieuThu' . ($i + 1) . 'Value16';
            $field17 = 'dienTieuThu' . ($i + 1) . 'Value17';
            $field18 = 'dienTieuThu' . ($i + 1) . 'Value18';
            $field19 = 'dienTieuThu' . ($i + 1) . 'Value19';
            $field20 = 'dienTieuThu' . ($i + 1) . 'Value20';
            $field21 = 'dienTieuThu' . ($i + 1) . 'Value21';
            $field22 = 'dienTieuThu' . ($i + 1) . 'Value22';
            $field23 = 'dienTieuThu' . ($i + 1) . 'Value23';
            $field24 = 'dienTieuThu' . ($i + 1) . 'Value24';
            $field25 = 'dienTieuThu' . ($i + 1) . 'Value25';
            $field26 = 'dienTieuThu' . ($i + 1) . 'Value26';
            $field27 = 'dienTieuThu' . ($i + 1) . 'Value27';
            $field28 = 'dienTieuThu' . ($i + 1) . 'Value28';
            $field29 = 'dienTieuThu' . ($i + 1) . 'Value29';
            $field30 = 'dienTieuThu' . ($i + 1) . 'Value30';
            $field31 = 'dienTieuThu' . ($i + 1) . 'Value31';
            $field32 = 'dienTieuThu' . ($i + 1) . 'Value32';

            //Trong ngày
            $dataTrongNgayKwhArr['thap_diem'] = $objData->$field1;
            $dataTrongNgayKwhArr['binh_thuong'] = $objData->$field2;
            $dataTrongNgayKwhArr['cao_diem'] = $objData->$field3;
            $dataTrongNgayKwhArr['tong'] = $objData->$field4;
            $dataTrongNgayKwh['title'] = 'Trong Ngày: Kwh/d';
            $dataTrongNgayKwh['info'] = $dataTrongNgayKwhArr;


            //Trong Tháng
            $dataTrongThangKwhArr['thap_diem'] = $objData->$field9;
            $dataTrongThangKwhArr['binh_thuong'] = $objData->$field10;
            $dataTrongThangKwhArr['cao_diem'] = $objData->$field11;
            $dataTrongThangKwhArr['tong'] = $objData->$field12;
            $dataTrongThangKwh['title'] = 'Trong Tháng: Kwh/m';
            $dataTrongThangKwh['info'] = $dataTrongThangKwhArr;

            //Trong Năm
            $dataTrongNamKwhArr['thap_diem'] = $objData->$field17;
            $dataTrongNamKwhArr['binh_thuong'] = $objData->$field18;
            $dataTrongNamKwhArr['cao_diem'] = $objData->$field19;
            $dataTrongNamKwhArr['tong'] = $objData->$field20;
            $dataTrongNamKwh['title'] = 'Trong Năm: Kwh/y';
            $dataTrongNamKwh['info'] = $dataTrongNamKwhArr;

            //Tổng
            $dataTongKwhArr['thap_diem'] = $objData->$field25;
            $dataTongKwhArr['binh_thuong'] = $objData->$field26;
            $dataTongKwhArr['cao_diem'] = $objData->$field27;
            $dataTongKwhArr['tong'] = $objData->$field28;
            $dataTongKwh['title'] = 'Tổng: Kwh/t';
            $dataTongKwh['info'] = $dataTongKwhArr;



            $chiPhiDien = $this->parseContentChiPhiDienNang($dataChiPhiDien, $i);
            $stationArr['title'] = 'Trạm ' . ($i + 1) . ':' . $this->getNameStationStatistic($i + 1);
            $stationArr['data_list'][0] = $dataTrongNgayKwh;
            $stationArr['data_list'][1] = $dataTrongThangKwh;
            $stationArr['data_list'][2] = $dataTrongNamKwh;
            $stationArr['data_list'][3] = $dataTongKwh;
            $stationArr['data_list'][4] = $chiPhiDien[0];
            $stationArr['data_list'][5] = $chiPhiDien[1];
            $stationArr['data_list'][6] = $chiPhiDien[2];
            $stationArr['data_list'][7] = $chiPhiDien[3];

            $return[$i] = $stationArr;
        }
        return $return;
    }

    private function parseContentChiPhiDienNang($data, $index) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Define Variable
        $stationArr = [];

        $dataTrongNgay = [];
        //$dataTrongNgayStar = [];
        $dataTrongThang = [];
        //$dataTrongThangStar = [];
        $dataTrongNam = [];
        //$dataTrongNamStar = [];
        $dataTongNgay = [];
        $dataTongThang = [];
        $dataTongNam = [];
        $dataTong = [];
        //$dataTongStar = [];
        $dataTotal = [];

        $dataTrongNgayArr = [];
        //$dataTrongNgayStarArr = [];
        $dataTrongThangArr = [];
        //$dataTrongThangStarArr = [];
        $dataTrongNamArr = [];
        //$dataTrongNamStarArr = [];
        $dataTongNgayArr = [];
        $dataTongThangArr = [];
        $dataTongNamArr = [];
        $dataTongArr = [];
        //$dataTongStarArr = [];
        //$dataTotalArr = [];
        //Foreach Thông Số
        $field1 = 'chiPhiDien' . ($index + 1) . 'Value1';
        $field2 = 'chiPhiDien' . ($index + 1) . 'Value2';
        $field3 = 'chiPhiDien' . ($index + 1) . 'Value3';
        $field4 = 'chiPhiDien' . ($index + 1) . 'Value4';
        $field5 = 'chiPhiDien' . ($index + 1) . 'Value5';
        $field6 = 'chiPhiDien' . ($index + 1) . 'Value6';
        $field7 = 'chiPhiDien' . ($index + 1) . 'Value7';
        $field8 = 'chiPhiDien' . ($index + 1) . 'Value8';
        $field9 = 'chiPhiDien' . ($index + 1) . 'Value9';
        $field10 = 'chiPhiDien' . ($index + 1) . 'Value10';
        $field11 = 'chiPhiDien' . ($index + 1) . 'Value11';
        $field12 = 'chiPhiDien' . ($index + 1) . 'Value12';
        $field13 = 'chiPhiDien' . ($index + 1) . 'Value13';
        $field14 = 'chiPhiDien' . ($index + 1) . 'Value14';
        $field15 = 'chiPhiDien' . ($index + 1) . 'Value15';
        $field16 = 'chiPhiDien' . ($index + 1) . 'Value16';
        $field17 = 'chiPhiDien' . ($index + 1) . 'Value17';
        $field18 = 'chiPhiDien' . ($index + 1) . 'Value18';
        $field19 = 'chiPhiDien' . ($index + 1) . 'Value19';
        $field20 = 'chiPhiDien' . ($index + 1) . 'Value20';
        $field21 = 'chiPhiDien' . ($index + 1) . 'Value21';
        $field22 = 'chiPhiDien' . ($index + 1) . 'Value22';
        $field23 = 'chiPhiDien' . ($index + 1) . 'Value23';
        $field24 = 'chiPhiDien' . ($index + 1) . 'Value24';
        $field25 = 'chiPhiDien' . ($index + 1) . 'Value25';
        $field26 = 'chiPhiDien' . ($index + 1) . 'Value26';
        $field27 = 'chiPhiDien' . ($index + 1) . 'Value27';
        $field28 = 'chiPhiDien' . ($index + 1) . 'Value28';
        $field29 = 'chiPhiDien' . ($index + 1) . 'Value29';
        $field30 = 'chiPhiDien' . ($index + 1) . 'Value30';
        $field31 = 'chiPhiDien' . ($index + 1) . 'Value31';
        $field32 = 'chiPhiDien' . ($index + 1) . 'Value32';
        $field33 = 'chiPhiDien' . ($index + 1) . 'Value33';
        $field34 = 'chiPhiDien' . ($index + 1) . 'Value34';
        $field35 = 'chiPhiDien' . ($index + 1) . 'Value35';
        $field36 = 'chiPhiDien' . ($index + 1) . 'Value36';

        //Trong ngày
        $dataTrongNgayArr['thap_diem'] = $objData->$field1;
        $dataTrongNgayArr['binh_thuong'] = $objData->$field2;
        $dataTrongNgayArr['cao_diem'] = $objData->$field3;
        $dataTrongNgayArr['tong'] = $objData->$field4;
        $dataTrongNgay['title'] = 'Trong Ngày: VNĐ/d';
        $dataTrongNgay['info'] = $dataTrongNgayArr;

        //Trong Tháng
        $dataTrongThangArr['thap_diem'] = $objData->$field10;
        $dataTrongThangArr['binh_thuong'] = $objData->$field11;
        $dataTrongThangArr['cao_diem'] = $objData->$field12;
        $dataTrongThangArr['tong'] = $objData->$field13;
        $dataTrongThang['title'] = 'Trong Tháng: VNĐ/m';
        $dataTrongThang['info'] = $dataTrongThangArr;

        //Trong Năm
        $dataTrongNamArr['thap_diem'] = $objData->$field19;
        $dataTrongNamArr['binh_thuong'] = $objData->$field20;
        $dataTrongNamArr['cao_diem'] = $objData->$field21;
        $dataTrongNamArr['tong'] = $objData->$field22;
        $dataTrongNam['title'] = 'Trong Năm: VNĐ/y';
        $dataTrongNam['info'] = $dataTrongNamArr;

        //Tổng
        $dataTongArr['thap_diem'] = $objData->$field28;
        $dataTongArr['binh_thuong'] = $objData->$field29;
        $dataTongArr['cao_diem'] = $objData->$field30;
        $dataTongArr['tong'] = $objData->$field31;
        $dataTong['title'] = 'Tổng: VNĐ/t';
        $dataTong['info'] = $dataTongArr;
        
        $stationArr[0] = $dataTrongNgay;
        $stationArr[1] = $dataTrongThang;
        $stationArr[2] = $dataTrongNam;
        $stationArr[3] = $dataTong;
        return $stationArr;
    }

}
