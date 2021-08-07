<?php namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Statistic Electrical Back-end Controller
 */
class StatisticElectrical extends General
{
    public function __construct() {
        
    }

    public function getListElectrical(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Call API
            $linkThongSoDien = 'http://115.78.130.60:41440/api/UpdatesTableThongKeThongSoDiens/' . $factoryID;
            $dataThongSoDien = $this->callAPI($linkThongSoDien, "GET");

            $linkBieuGiaDien = 'http://115.78.130.60:41440/api/UpdatesTableThongKeChiPhiDiens/' . $factoryID;
            $dataBieuGiaDien = $this->callAPI($linkBieuGiaDien, "GET");

            $thongSoDien = $this->parseContentThongSoDien($dataThongSoDien);
            $dienNangTieuThu = $this->parseContentDienNangTieuThu($dataThongSoDien);
            $bieuGiaDien = $this->parseContentBieuGiaDien($dataBieuGiaDien);
            $chiPhiDien = $this->parseContentChiPhiDienNang($dataBieuGiaDien);

            $return['thong_so_dien'] = $thongSoDien;
            $return['bieu_gia_dien'] = $bieuGiaDien;
            $return['dien_nang_tieu_thu'] = $dienNangTieuThu;
            $return['chi_phi_dien'] = $chiPhiDien;

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
        for ($i = 0; $i < 10; $i++) {
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
                $dataStation['title'] = 'Thông Số Điện - Trạm Mcc'.($i+1);
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
        $stationArr = [];
        $dataLuoiDienArr = [];
        $dataMayPhatArr = [];
        $dataLuoiDien = [];
        $dataMayPhat = [];
        $dataLuoiDien['title'] = 'Lưới Điện:VND/Kwh';
        $dataLuoiDienArr['thap_diem'] = $objData->bieuGiaDienValue1;
        $dataLuoiDienArr['binh_thuong'] = $objData->bieuGiaDienValue2;
        $dataLuoiDienArr['cao_diem'] = $objData->bieuGiaDienValue3;
        $dataLuoiDien['info'] = $dataLuoiDienArr;

        $dataMayPhat['title'] = 'Máy phát:VND/Kwh';
		$dataMayPhatArr['thap_diem'] = '';
        $dataMayPhatArr['binh_thuong'] = $objData->bieuGiaDienValue4;
		$dataMayPhatArr['cao_diem'] = '';
        $dataMayPhat['info'] = $dataMayPhatArr;
        $stationArr['title'] = 'Biểu Giá Điện';
        $stationArr['data_list'][0] = $dataLuoiDien;
        $stationArr['data_list'][1] = $dataMayPhat;
        $return = $stationArr;
        return $return;
    }

    private function parseContentDienNangTieuThu($data) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Foreach Trạm
        for ($i = 0; $i < 10; $i++) {
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

            //if($objData->$field1 && $objData->$field2 && $objData->$field3){
            //Trong ngày
            $dataTrongNgayKwhArr['thap_diem'] = $objData->$field1;
            $dataTrongNgayKwhArr['binh_thuong'] = $objData->$field2;
            $dataTrongNgayKwhArr['cao_diem'] = $objData->$field3;
            $dataTrongNgayKwhArr['tong'] = $objData->$field4;
            $dataTrongNgayKwh['title'] = 'Trong Ngày: Kwh/d';
            $dataTrongNgayKwh['info'] = $dataTrongNgayKwhArr;

            /*$dataTrongNgayKvarhArr['thap_diem'] = $objData->$field5;
            $dataTrongNgayKvarhArr['binh_thuong'] = $objData->$field6;
            $dataTrongNgayKvarhArr['cao_diem'] = $objData->$field7;
            $dataTrongNgayKvarhArr['tong'] = $objData->$field8;
            $dataTrongNgayKvarh['title'] = 'Trong Ngày: Kvrah/d';
            $dataTrongNgayKvarh['info'] = $dataTrongNgayKvarhArr;*/

            //Trong Tháng
            $dataTrongThangKwhArr['thap_diem'] = $objData->$field9;
            $dataTrongThangKwhArr['binh_thuong'] = $objData->$field10;
            $dataTrongThangKwhArr['cao_diem'] = $objData->$field11;
            $dataTrongThangKwhArr['tong'] = $objData->$field12;
            $dataTrongThangKwh['title'] = 'Trong Tháng: Kwh/m';
            $dataTrongThangKwh['info'] = $dataTrongThangKwhArr;

            /*$dataTrongThangKvarhArr['thap_diem'] = $objData->$field13;
            $dataTrongThangKvarhArr['binh_thuong'] = $objData->$field14;
            $dataTrongThangKvarhArr['cao_diem'] = $objData->$field15;
            $dataTrongThangKvarhArr['tong'] = $objData->$field16;
            $dataTrongThangKvarh['title'] = 'Trong Tháng: Kvrah/m';
            $dataTrongThangKvarh['info'] = $dataTrongThangKvarhArr;*/

            //Trong Năm
            $dataTrongNamKwhArr['thap_diem'] = $objData->$field17;
            $dataTrongNamKwhArr['binh_thuong'] = $objData->$field18;
            $dataTrongNamKwhArr['cao_diem'] = $objData->$field19;
            $dataTrongNamKwhArr['tong'] = $objData->$field20;
            $dataTrongNamKwh['title'] = 'Trong Năm: Kwh/y';
            $dataTrongNamKwh['info'] = $dataTrongNamKwhArr;

            /*$dataTrongNamKvarhArr['thap_diem'] = $objData->$field21;
            $dataTrongNamKvarhArr['binh_thuong'] = $objData->$field22;
            $dataTrongNamKvarhArr['cao_diem'] = $objData->$field23;
            $dataTrongNamKvarhArr['tong'] = $objData->$field24;
            $dataTrongNamKvarh['title'] = 'Trong Năm: Kvrah/y';
            $dataTrongNamKvarh['info'] = $dataTrongNamKvarhArr;*/

            //Tổng
            $dataTongKwhArr['thap_diem'] = $objData->$field25;
            $dataTongKwhArr['binh_thuong'] = $objData->$field26;
            $dataTongKwhArr['cao_diem'] = $objData->$field27;
            $dataTongKwhArr['tong'] = $objData->$field28;
            $dataTongKwh['title'] = 'Tổng: Kwh/t';
            $dataTongKwh['info'] = $dataTongKwhArr;

            /*$dataTongKvrahArr['thap_diem'] = $objData->$field29;
            $dataTongKvrahArr['binh_thuong'] = $objData->$field30;
            $dataTongKvrahArr['cao_diem'] = $objData->$field31;
            $dataTongKvrahArr['tong'] = $objData->$field32;
            $dataTongKvrah['title'] = 'Tổng: Kvrah/t';
            $dataTongKvrah['info'] = $dataTongKvrahArr;*/

            $stationArr['title'] = 'Trạm ' . ($i + 1) . ':' . $this->getNameStationStatistic($i + 1);
            $stationArr['data_list'][0] = $dataTrongNgayKwh;
            //$stationArr['data_list'][1] = $dataTrongNgayKvarh;
            $stationArr['data_list'][1] = $dataTrongThangKwh;
            //$stationArr['data_list'][3] = $dataTrongThangKvarh;
            $stationArr['data_list'][2] = $dataTrongNamKwh;
            //$stationArr['data_list'][5] = $dataTrongNamKvarh;
            $stationArr['data_list'][3] = $dataTongKwh;
            //$stationArr['data_list'][7] = $dataTongKvrah;
            $return[$i] = $stationArr;
            //}                        
        }
        return $return;
    }

    private function parseContentChiPhiDienNang($data) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Foreach Trạm
        for ($i = 0; $i < 10; $i++) {
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
            $field1 = 'chiPhiDien' . ($i + 1) . 'Value1';
            $field2 = 'chiPhiDien' . ($i + 1) . 'Value2';
            $field3 = 'chiPhiDien' . ($i + 1) . 'Value3';
            $field4 = 'chiPhiDien' . ($i + 1) . 'Value4';
            $field5 = 'chiPhiDien' . ($i + 1) . 'Value5';
            $field6 = 'chiPhiDien' . ($i + 1) . 'Value6';
            $field7 = 'chiPhiDien' . ($i + 1) . 'Value7';
            $field8 = 'chiPhiDien' . ($i + 1) . 'Value8';
            $field9 = 'chiPhiDien' . ($i + 1) . 'Value9';
            $field10 = 'chiPhiDien' . ($i + 1) . 'Value10';
            $field11 = 'chiPhiDien' . ($i + 1) . 'Value11';
            $field12 = 'chiPhiDien' . ($i + 1) . 'Value12';
            $field13 = 'chiPhiDien' . ($i + 1) . 'Value13';
            $field14 = 'chiPhiDien' . ($i + 1) . 'Value14';
            $field15 = 'chiPhiDien' . ($i + 1) . 'Value15';
            $field16 = 'chiPhiDien' . ($i + 1) . 'Value16';
            $field17 = 'chiPhiDien' . ($i + 1) . 'Value17';
            $field18 = 'chiPhiDien' . ($i + 1) . 'Value18';
            $field19 = 'chiPhiDien' . ($i + 1) . 'Value19';
            $field20 = 'chiPhiDien' . ($i + 1) . 'Value20';
            $field21 = 'chiPhiDien' . ($i + 1) . 'Value21';
            $field22 = 'chiPhiDien' . ($i + 1) . 'Value22';
            $field23 = 'chiPhiDien' . ($i + 1) . 'Value23';
            $field24 = 'chiPhiDien' . ($i + 1) . 'Value24';
            $field25 = 'chiPhiDien' . ($i + 1) . 'Value25';
            $field26 = 'chiPhiDien' . ($i + 1) . 'Value26';
            $field27 = 'chiPhiDien' . ($i + 1) . 'Value27';
            $field28 = 'chiPhiDien' . ($i + 1) . 'Value28';
            $field29 = 'chiPhiDien' . ($i + 1) . 'Value29';
            $field30 = 'chiPhiDien' . ($i + 1) . 'Value30';
            $field31 = 'chiPhiDien' . ($i + 1) . 'Value31';
            $field32 = 'chiPhiDien' . ($i + 1) . 'Value32';
            $field33 = 'chiPhiDien' . ($i + 1) . 'Value33';
            $field34 = 'chiPhiDien' . ($i + 1) . 'Value34';
            $field35 = 'chiPhiDien' . ($i + 1) . 'Value35';
            $field36 = 'chiPhiDien' . ($i + 1) . 'Value36';

            //if($objData->$field1 && $objData->$field2 && $objData->$field3){
            //Trong ngày
            $dataTrongNgayArr['thap_diem'] = $objData->$field1;
            $dataTrongNgayArr['binh_thuong'] = $objData->$field2;
            $dataTrongNgayArr['cao_diem'] = $objData->$field3;
            $dataTrongNgayArr['tong'] = $objData->$field4;
            $dataTrongNgay['title'] = 'Trong Ngày: VNĐ/d';
            $dataTrongNgay['info'] = $dataTrongNgayArr;

            /*$dataTrongNgayStarArr['thap_diem'] = $objData->$field5;
            $dataTrongNgayStarArr['binh_thuong'] = $objData->$field6;
            $dataTrongNgayStarArr['cao_diem'] = $objData->$field7;
            $dataTrongNgayStarArr['tong'] = $objData->$field8;
            $dataTrongNgayStar['title'] = 'Trong Ngày: VNĐ/d*';
            $dataTrongNgayStar['info'] = $dataTrongNgayStarArr;

            $dataTongNgayArr['tong'] = $objData->$field9;
            $dataTongNgay['title'] = 'Tổng ngày:VNĐ/d + VNĐ/d*';
            $dataTongNgay['info'] = $dataTrongNgayStarArr;*/

            //Trong Tháng
            $dataTrongThangArr['thap_diem'] = $objData->$field10;
            $dataTrongThangArr['binh_thuong'] = $objData->$field11;
            $dataTrongThangArr['cao_diem'] = $objData->$field12;
            $dataTrongThangArr['tong'] = $objData->$field13;
            $dataTrongThang['title'] = 'Trong Tháng: VNĐ/m';
            $dataTrongThang['info'] = $dataTrongThangArr;

            /*$dataTrongThangStarArr['thap_diem'] = $objData->$field14;
            $dataTrongThangStarArr['binh_thuong'] = $objData->$field15;
            $dataTrongThangStarArr['cao_diem'] = $objData->$field16;
            $dataTrongThangStarArr['tong'] = $objData->$field17;
            $dataTrongThangStar['title'] = 'Trong Tháng: VNĐ/m*';
            $dataTrongThangStar['info'] = $dataTrongThangStarArr;

            $dataTongThangArr['tong'] = $objData->$field18;
            $dataTongThang['title'] = 'Tổng tháng:VNĐ/m + VNĐ/m*';
            $dataTongThang['info'] = $dataTongThangArr;*/

            //Trong Năm
            $dataTrongNamArr['thap_diem'] = $objData->$field19;
            $dataTrongNamArr['binh_thuong'] = $objData->$field20;
            $dataTrongNamArr['cao_diem'] = $objData->$field21;
            $dataTrongNamArr['tong'] = $objData->$field22;
            $dataTrongNam['title'] = 'Trong Năm: VNĐ/y';
            $dataTrongNam['info'] = $dataTrongNamArr;

            /*$dataTrongNamStarArr['thap_diem'] = $objData->$field23;
            $dataTrongNamStarArr['binh_thuong'] = $objData->$field24;
            $dataTrongNamStarArr['cao_diem'] = $objData->$field25;
            $dataTrongNamStarArr['tong'] = $objData->$field26;
            $dataTrongNamStar['title'] = 'Trong Năm: VNĐ/y*';
            $dataTrongNamStar['info'] = $dataTrongNamStarArr;

            $dataTongNamArr['tong'] = $objData->$field27;
            $dataTongNam['title'] = 'Tổng năm:VNĐ/y + VNĐ/y*';
            $dataTongNam['info'] = $dataTongNamArr;*/

            //Tổng
            $dataTongArr['thap_diem'] = $objData->$field28;
            $dataTongArr['binh_thuong'] = $objData->$field29;
            $dataTongArr['cao_diem'] = $objData->$field30;
            $dataTongArr['tong'] = $objData->$field31;
            $dataTong['title'] = 'Tổng: VNĐ/t';
            $dataTong['info'] = $dataTongArr;

            /*$dataTongStarArr['thap_diem'] = $objData->$field32;
            $dataTongStarArr['binh_thuong'] = $objData->$field33;
            $dataTongStarArr['cao_diem'] = $objData->$field34;
            $dataTongStarArr['tong'] = $objData->$field35;
            $dataTongStar['title'] = 'Tổng: VNĐ/t*';
            $dataTongStar['info'] = $dataTongStarArr;

            $dataTotalArr['tong'] = $objData->$field36;
            $dataTotal['title'] = 'Tổng: VNĐ/t + VNĐ/t*';
            $dataTotal['info'] = $dataTotalArr;*/

            $stationArr['title'] = 'Trạm ' . ($i + 1) . ':' . $this->getNameStationStatistic($i + 1);
            $stationArr['data_list'][0] = $dataTrongNgay;
            //$stationArr['data_list'][1] = $dataTrongNgayStar;
            $stationArr['data_list'][1] = $dataTrongThang;
            //$stationArr['data_list'][3] = $dataTrongThangStar;
            $stationArr['data_list'][2] = $dataTrongNam;
            //$stationArr['data_list'][5] = $dataTrongNamStar;
            $stationArr['data_list'][3] = $dataTong;
            //$stationArr['data_list'][7] = $dataTotal;
            $return[$i] = $stationArr;
            //}                        
        }
        return $return;
    }
}
