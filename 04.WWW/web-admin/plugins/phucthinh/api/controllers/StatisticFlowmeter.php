<?php namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Statistic Flowmeter Back-end Controller
 */
class StatisticFlowmeter extends General
{
    public function __construct() {
        
    }
    
    public function getListFlowmeter(Request $request) {
        try {
            $factoryID = $request->get('factory_id');

            //Call API
            $link = 'http://115.78.130.60:41440/api/UpdatesTableThongKeLuuLuongHoaChats/' . $factoryID;
            $data = $this->callAPI($link, "GET");

            $luuLuongDauVao = $this->parseContenntLuuLuongDauVao($data);
            $luuLuongHaoPhi = $this->parseContentLuuLuongHaoPhi($data);
            $doanhSoBanNuoc = $this->parseContentDoanhSoBanNuoc($data);
            $luuLuongBanRa = $this->parseContentLuuLuongBanRa($data);

            $return['luu_luong_dau_vao'] = $luuLuongDauVao;
            $return['luu_luong_hao_phi'] = $luuLuongHaoPhi;
            //$return['doanh_so_ban_nuoc'] = $doanhSoBanNuoc;
            $return['luu_luong_ban_ra'] = $luuLuongBanRa;

            return $this->respondWithSuccess($return, "Get List FlowMeter succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContenntLuuLuongDauVao($data) {
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Define Variable
        $dataStationArr = [];

        $dataTucThoi = [];
        $dataTrongNgay = [];
        $dataTrongThang = [];
        $dataTrongNam = [];
        $dataTong = [];

        $dataTucThoiArr = [];
        $dataTrongNgayArr = [];
        $dataTrongThangArr = [];
        $dataTrongNamArr = [];
        $dataTongArr = [];

        //Foreach Thông Số
        $fieldTucThoi = 'luuLuongDauVaoValue1';
        $dataTucThoiArr['value'] = $objData->$fieldTucThoi;
        $dataTucThoiArr['unit'] = 'm3/h';
        $dataTucThoi['title'] = 'Tức thời';
        $dataTucThoi['info'] = $dataTucThoiArr;
        
        $fieldTrongNgay = 'luuLuongDauVaoValue2';
        $dataTrongNgayArr['value'] = $objData->$fieldTrongNgay;
        $dataTrongNgayArr['unit'] = 'm3/d';
        $dataTrongNgay['title'] = 'Trong Ngày';
        $dataTrongNgay['info'] = $dataTrongNgayArr;

        $fieldTrongThang = 'luuLuongDauVaoValue3';
        $dataTrongThangArr['value'] = $objData->$fieldTrongThang;
        $dataTrongThangArr['unit'] = 'm3/m';
        $dataTrongThang['title'] = 'Trong Tháng';
        $dataTrongThang['info'] = $dataTrongThangArr;

        $fieldTrongNam = 'luuLuongDauVaoValue4';
        $dataTrongNamArr['value'] = $objData->$fieldTrongNam;
        $dataTrongNamArr['unit'] = 'm3/y';
        $dataTrongNam['title'] = 'Trong Năm';
        $dataTrongNam['info'] = $dataTrongNamArr;

        $fieldTong = 'luuLuongDauVaoValue5';
        $dataTongArr['value'] = $objData->$fieldTong;
        $dataTongArr['unit'] = 'm3/t';
        $dataTong['title'] = 'Tổng';
        $dataTong['info'] = $dataTongArr;


        $dataStationArr['title'] = 'Lưu Lượng đầu vào';
        $dataStationArr['data_list'][0] = $dataTucThoi;
        $dataStationArr['data_list'][1] = $dataTrongNgay;
        $dataStationArr['data_list'][2] = $dataTrongThang;
        $dataStationArr['data_list'][3] = $dataTrongNam;
        $dataStationArr['data_list'][4] = $dataTong;
        $return[0] = $dataStationArr;
        return $return;
    }
    
    private function parseContentLuuLuongHaoPhi($data){
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
        $fieldTrongNgay = 'luuLuongHaoPhiValue1';
        $dataTrongNgayArr['value'] = $objData->$fieldTrongNgay;
        $dataTrongNgayArr['unit'] = 'm3/d';
        $dataTrongNgay['title'] = 'Trong Ngày';
        $dataTrongNgay['info'] = $dataTrongNgayArr;

        $fieldTrongThang = 'luuLuongHaoPhiValue2';
        $dataTrongThangArr['value'] = $objData->$fieldTrongThang;
        $dataTrongThangArr['unit'] = 'm3/m';
        $dataTrongThang['title'] = 'Trong Tháng';
        $dataTrongThang['info'] = $dataTrongThangArr;

        $fieldTrongNam = 'luuLuongHaoPhiValue3';
        $dataTrongNamArr['value'] = $objData->$fieldTrongNam;
        $dataTrongNamArr['unit'] = 'm3/y';
        $dataTrongNam['title'] = 'Trong Năm';
        $dataTrongNam['info'] = $dataTrongNamArr;

        $fieldTong = 'luuLuongHaoPhiValue4';
        $dataTongArr['value'] = $objData->$fieldTong;
        $dataTongArr['unit'] = 'm3/t';
        $dataTong['title'] = 'Tổng';
        $dataTong['info'] = $dataTongArr;


        $dataStationArr['title'] = 'Lưu Lượng hao phí';
        $dataStationArr['data_list'][0] = $dataTrongNgay;
        $dataStationArr['data_list'][1] = $dataTrongThang;
        $dataStationArr['data_list'][2] = $dataTrongNam;
        $dataStationArr['data_list'][3] = $dataTong;
        $return[0] = $dataStationArr;
        return $return;
    }
    
    private function parseContentDoanhSoBanNuoc($data){
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Define Variable
        $dataStationArr = [];
        
        $dataBieuGiaNuoc = [];
        $dataTrongNgay = [];
        $dataTrongThang = [];
        $dataTrongNam = [];
        $dataTong = [];

        $dataBieuGiaNuocArr = [];
        $dataTrongNgayArr = [];
        $dataTrongThangArr = [];
        $dataTrongNamArr = [];
        $dataTongArr = [];

        //Foreach Thông Số        
        $fieldBieuGiaNuoc = 'bieuGiaNuocValue1';
        $dataBieuGiaNuocArr['value'] = $objData->$fieldBieuGiaNuoc;
        $dataBieuGiaNuocArr['unit'] = 'vnđ/m3';
        $dataBieuGiaNuoc['title'] = 'Biểu giá nước hiện tại';
        $dataBieuGiaNuoc['info'] = $dataBieuGiaNuocArr;
        
        $fieldTrongNgay = 'doanhSoBanNuocValue1';
        $dataTrongNgayArr['value'] = $objData->$fieldTrongNgay;
        $dataTrongNgayArr['unit'] = 'vnđ';
        $dataTrongNgay['title'] = 'Trong Ngày';
        $dataTrongNgay['info'] = $dataTrongNgayArr;

        $fieldTrongThang = 'doanhSoBanNuocValue2';
        $dataTrongThangArr['value'] = $objData->$fieldTrongThang;
        $dataTrongThangArr['unit'] = 'vnđ';
        $dataTrongThang['title'] = 'Trong Tháng';
        $dataTrongThang['info'] = $dataTrongThangArr;

        $fieldTrongNam = 'doanhSoBanNuocValue3';
        $dataTrongNamArr['value'] = $objData->$fieldTrongNam;
        $dataTrongNamArr['unit'] = 'vnđ';
        $dataTrongNam['title'] = 'Trong Năm';
        $dataTrongNam['info'] = $dataTrongNamArr;

        $fieldTong = 'doanhSoBanNuocValue4';
        $dataTongArr['value'] = $objData->$fieldTong;
        $dataTongArr['unit'] = 'vnđ';
        $dataTong['title'] = 'Tổng';
        $dataTong['info'] = $dataTongArr;


        $dataStationArr['title'] = 'Doanh số bán nước';
        $dataStationArr['data_list'][0] = $dataBieuGiaNuoc;
        $dataStationArr['data_list'][1] = $dataTrongNgay;
        $dataStationArr['data_list'][2] = $dataTrongThang;
        $dataStationArr['data_list'][3] = $dataTrongNam;
        $dataStationArr['data_list'][4] = $dataTong;
        $return[0] = $dataStationArr;
        return $return;
    }
    
    private function parseContentLuuLuongBanRa($data){
        $objData = json_decode($data);
        $objData = $objData[0];
        $return = [];
        //Define Variable
        $dataStationArr = [];
        
        $dataTucThi = [];
        $dataTrongNgay = [];
        $dataTrongThang = [];
        $dataTrongNam = [];
        $dataTong = [];

        $dataTucThiArr = [];
        $dataTrongNgayArr = [];
        $dataTrongThangArr = [];
        $dataTrongNamArr = [];
        $dataTongArr = [];

        //Foreach Thông Số        
        $fieldTucThi = 'luuLuongBanRaValue1';
        $dataTucThiArr['value'] = $objData->$fieldTucThi;
        $dataTucThiArr['unit'] = 'm3/h';
        $dataTucThi['title'] = 'Tức thời';
        $dataTucThi['info'] = $dataTucThiArr;
        
        $fieldTrongNgay = 'luuLuongBanRaValue2';
        $dataTrongNgayArr['value'] = $objData->$fieldTrongNgay;
        $dataTrongNgayArr['unit'] = 'm3/d';
        $dataTrongNgay['title'] = 'Trong Ngày';
        $dataTrongNgay['info'] = $dataTrongNgayArr;

        $fieldTrongThang = 'luuLuongBanRaValue3';
        $dataTrongThangArr['value'] = $objData->$fieldTrongThang;
        $dataTrongThangArr['unit'] = 'm3/m';
        $dataTrongThang['title'] = 'Trong Tháng';
        $dataTrongThang['info'] = $dataTrongThangArr;

        $fieldTrongNam = 'luuLuongBanRaValue4';
        $dataTrongNamArr['value'] = $objData->$fieldTrongNam;
        $dataTrongNamArr['unit'] = 'm3/y';
        $dataTrongNam['title'] = 'Trong Năm';
        $dataTrongNam['info'] = $dataTrongNamArr;

        $fieldTong = 'luuLuongBanRaValue5';
        $dataTongArr['value'] = $objData->$fieldTong;
        $dataTongArr['unit'] = 'm3/t';
        $dataTong['title'] = 'Tổng';
        $dataTong['info'] = $dataTongArr;


        $dataStationArr['title'] = 'Lưu lượng bán ra';
        $dataStationArr['data_list'][0] = $dataTucThi;
        $dataStationArr['data_list'][1] = $dataTrongNgay;
        $dataStationArr['data_list'][2] = $dataTrongThang;
        $dataStationArr['data_list'][3] = $dataTrongNam;
        $dataStationArr['data_list'][4] = $dataTong;
        $return[0] = $dataStationArr;
        return $return;
    }
}
