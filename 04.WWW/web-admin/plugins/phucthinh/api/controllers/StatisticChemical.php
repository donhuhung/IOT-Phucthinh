<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Statistic Chemical Back-end Controller
 */
class StatisticChemical extends General {

    public function __construct() {
        
    }

    public function getListChemical(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Call API
            $link = 'http://115.78.130.60:41440/api/UpdatesTableThongKeLuuLuongHoaChats/' . $factoryID;
            $data = $this->callAPI($link, "GET");

            $return['voi'] = $this->parseArrayChemical($data, 1);
            $return['pac'] = $this->parseArrayChemical($data, 2);
            $return['polyme'] = $this->parseArrayChemical($data, 3);
            $return['clo'] = $this->parseArrayChemical($data, 4);
            $return['other'] = $this->parseArrayChemical($data, 5);

            return $this->respondWithSuccess($return, "Get List Chemical succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentCongThucPhaHoaChat($data, $index) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $stationArr = [];
        $stationArr['title'] = 'Công Thức Pha Hóa Chất';
        //Define Variable
        $dataStationArr = [];
        $dataHoaChatArr = [];
        //Foreach Thông Số
        $fieldKg = 'congThucPhaHoaChat' . ($index) . 'Value1';
        $fieldNuoc = 'congThucPhaHoaChat' . ($index) . 'Value2';
        $fieldThoiGian = 'congThucPhaHoaChat' . ($index) . 'Value3';
        $dataHoaChatArr['kg'] = $objData->$fieldKg;
        $dataHoaChatArr['l'] = $objData->$fieldNuoc;
        $dataHoaChatArr['s'] = $objData->$fieldThoiGian;
        $dataStationArr['title'] = $this->getNameHoaChat($index);
        $dataStationArr['info'] = $dataHoaChatArr;
        $stationArr['data_list'][$index-1] = $dataStationArr;
        return $stationArr;
    }

    private function parseContentKhoHoaChat($data, $index) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Define Variable
        $dataStationArr = [];
        $dataHoaChatConArr = [];
        $dataHoaChatNhapArr = [];
        $dataKhoiLuongConLaiArr = [];
        $dataKhoiLuongDaNhapArr = [];
        //Foreach Thông Số
        $fieldKhoiLuongConLai = 'khoHoaChat' . ($index) . 'Value1';
        $fieldKhoiLuongDaNhap = 'khoHoaChat' . ($index) . 'Value3';
        $dataHoaChatConArr['khoi_luong_con_lai'] = $objData->$fieldKhoiLuongConLai;
        $dataKhoiLuongConLaiArr['title'] = 'Khối lượng còn lại';
        $dataKhoiLuongConLaiArr['info'] = $dataHoaChatConArr;

        $dataHoaChatNhapArr['khoi_luong_da_nhap'] = $objData->$fieldKhoiLuongDaNhap;
        $dataKhoiLuongDaNhapArr['title'] = 'Tổng Khối lượng đã nhập';
        $dataKhoiLuongDaNhapArr['info'] = $dataHoaChatNhapArr;

        $dataStationArr['title'] = $this->getNameHoaChat($index);
        $dataStationArr['unit'] = $this->getNameHoaChat($index) == 'PAC' ? 'lít' : 'kg';
        $dataStationArr['data_list'][0] = $dataKhoiLuongConLaiArr;
        $dataStationArr['data_list'][1] = $dataKhoiLuongDaNhapArr;
        $return = $dataStationArr;
        return $return;
    }

    private function parseContentHoaChatTieuThu($data, $index) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Define Variable
        $dataStationArr = [];

        $dataTrongNgay = [];
        $dataTrongThang = [];
        $dataTrongNam = [];
        $dataTong = [];

        $dataTrongNgayArr = [];
        $dataTrongThangArr = [];
        $dataTrongNamArr = [];
        $dataTongArr = [];

        //Foreach Thông Số
        $fieldTrongNgay = 'hoaChatTieuThu' . ($index) . 'Value1';
        $dataTrongNgayArr['value'] = $objData->$fieldTrongNgay;
        $dataTrongNgay['title'] = 'Trong Ngày';
        $dataTrongNgay['info'] = $dataTrongNgayArr;

        $fieldTrongThang = 'hoaChatTieuThu' . ($index) . 'Value2';
        $dataTrongThangArr['value'] = $objData->$fieldTrongThang;
        $dataTrongThang['title'] = 'Trong Tháng';
        $dataTrongThang['info'] = $dataTrongThangArr;

        $fieldTrongNam = 'hoaChatTieuThu' . ($index) . 'Value3';
        $dataTrongNamArr['value'] = $objData->$fieldTrongNam;
        $dataTrongNam['title'] = 'Trong Năm';
        $dataTrongNam['info'] = $dataTrongNamArr;

        $fieldTong = 'hoaChatTieuThu' . ($index) . 'Value4';
        $dataTongArr['value'] = $objData->$fieldTong;
        $dataTong['title'] = 'Tổng';
        $dataTong['info'] = $dataTongArr;


        $dataStationArr['title'] = $this->getNameHoaChat($index);
        $dataStationArr['unit'] = $this->getNameHoaChat($index) == 'PAC' ? 'lít' : 'kg';
        $dataStationArr['data_list'][0] = $dataTrongNgay;
        $dataStationArr['data_list'][1] = $dataTrongThang;
        $dataStationArr['data_list'][2] = $dataTrongNam;
        $dataStationArr['data_list'][3] = $dataTong;
        $return = $dataStationArr;
        return $return;
    }

    private function parseContentBieuGiaHoaChat($data, $index) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        $stationArr = [];
        $stationArr['title'] = 'Biểu Giá Hóa Chất';
        //Define Variable
        $dataStationArr = [];
        $dataHoaChatArr = [];
        //Foreach Thông Số
        $field = 'bieuGiaHoaChat' . ($index) . 'Value1';
        $dataHoaChatArr['value'] = $objData->$field;
        $dataStationArr['title'] = $this->getNameHoaChat($index);
        $dataStationArr['unit'] = $this->getNameHoaChat($index) == 'PAC' ? 'VNĐ/lít' : 'VNĐ/kg';
        $dataStationArr['info'] = $dataHoaChatArr;
        $stationArr['data_list'][$index-1] = $dataStationArr;
        return $stationArr;
    }

    private function parseContentChiPhiPhaHoaChat($data, $index) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];

        //Define Variable
        $dataStationArr = [];

        $dataTrongNgay = [];
        $dataTrongThang = [];
        $dataTrongNam = [];
        $dataTong = [];

        $dataTrongNgayArr = [];
        $dataTrongThangArr = [];
        $dataTrongNamArr = [];
        $dataTongArr = [];

        //Foreach Thông Số
        $fieldTrongNgay = 'chiPhiHoaChat' . ($index) . 'Value1';
        $dataTrongNgayArr['value'] = $objData->$fieldTrongNgay;
        $dataTrongNgay['title'] = 'Trong Ngày';
        $dataTrongNgay['info'] = $dataTrongNgayArr;

        $fieldTrongThang = 'chiPhiHoaChat' . ($index) . 'Value2';
        $dataTrongThangArr['value'] = $objData->$fieldTrongThang;
        $dataTrongThang['title'] = 'Trong Tháng';
        $dataTrongThang['info'] = $dataTrongThangArr;

        $fieldTrongNam = 'chiPhiHoaChat' . ($index) . 'Value3';
        $dataTrongNamArr['value'] = $objData->$fieldTrongNam;
        $dataTrongNam['title'] = 'Trong Năm';
        $dataTrongNam['info'] = $dataTrongNamArr;

        $fieldTong = 'chiPhiHoaChat' . ($index) . 'Value4';
        $dataTongArr['value'] = $objData->$fieldTong;
        $dataTong['title'] = 'Tổng';
        $dataTong['info'] = $dataTongArr;


        $dataStationArr['title'] = $this->getNameHoaChat($index);
        $dataStationArr['unit'] = 'VNĐ';
        $dataStationArr['data_list'][0] = $dataTrongNgay;
        $dataStationArr['data_list'][1] = $dataTrongThang;
        $dataStationArr['data_list'][2] = $dataTrongNam;
        $dataStationArr['data_list'][3] = $dataTong;
        $return = $dataStationArr;
        return $return;
    }

    private function parseArrayChemical($data, $index) {
        $return = [];
        $return['cong_thuc_hoa_chat'] = $this->parseContentCongThucPhaHoaChat($data, $index);
        $return['kho_hoa_chat'] = $this->parseContentKhoHoaChat($data, $index);
        $return['hoa_chat_tieu_thu'] = $this->parseContentHoaChatTieuThu($data, $index);
        $return['bieu_gia_hoa_chat'] = $this->parseContentBieuGiaHoaChat($data, $index);
        $return['chi_phi_hoa_chat'] = $this->parseContentChiPhiPhaHoaChat($data, $index);
        return $return;
    }

}
