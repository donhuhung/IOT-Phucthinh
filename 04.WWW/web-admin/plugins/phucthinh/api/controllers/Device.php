<?php

namespace PhucThinh\API\Controllers;

use Illuminate\Http\Request;

/**
 * Device Back-end Controller
 */
class Device extends General {

    public function __construct() {
        
    }

    public function getListSenSor(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/UpdatesTables/' . $factoryID,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            $return = $this->parseContentSensor($resp);

            curl_close($curl);
            return $this->respondWithSuccess($return, "Get List Sensor succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    public function getListDevice(Request $request) {
        try {
            $factoryID = $request->get('factory_id');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://115.78.130.60:41440/api/UpdatesTables/' . $factoryID,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
            $resp = curl_exec($curl);
            $return = $this->parseContentDevice($resp);

            curl_close($curl);
            return $this->respondWithSuccess($return, "Get List Device succesful!");
        } catch (\Exception $ex) {
            return $this->respondWithError($ex->getMessage(), self::HTTP_BAD_REQUEST);
        }
    }

    private function parseContentSensor($data) {
        $obj = json_decode($data);
        $return = [];
        //Raw Station
        $rawStation = [];
        $dataRawStation = [];
        
        $dataSensor = [];
        $dataRawStation[0]['name'] = 'Flow rate';
        $dataRawStation[0]['symbol'] = 'FT01.01';
        $dataSensor[0]['value'] = $obj->ft0101;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = 'm3/h';
        $dataSensor[0]['id'] = '1';
        $dataSensor[0]['is_percent'] = 'false';
        $dataRawStation[0]['data_sensor'] = $dataSensor;

        $dataSensor = [];
        $dataRawStation[1]['name'] = 'Flow rate';
        $dataRawStation[1]['symbol'] = 'FT01.02';
        $dataSensor[0]['value'] = $obj->ft0102;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = 'm3/h';
        $dataSensor[0]['id'] = '2';
        $dataSensor[0]['is_percent'] = 'false';
        $dataRawStation[1]['data_sensor'] = $dataSensor;

        $dataSensor = [];
        $dataRawStation[2]['name'] = 'Flow rate';
        $dataRawStation[2]['symbol'] = 'FT01.03';
        $dataSensor[0]['value'] = $obj->ft0103;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = 'm3/h';
        $dataSensor[0]['id'] = '3';
        $dataSensor[0]['is_percent'] = 'false';
        $dataRawStation[2]['data_sensor'] = $dataSensor;

        $rawStation['title'] = 'Raw Station';
        $rawStation['data'] = $dataRawStation;

        //Process Station
        $processStation = [];
        $dataProcessStation = [];
        $processStation['title'] = 'Process Station';
        $processStation['data'] = $dataProcessStation;

        //Chemical Station
        $chemicalStation = [];
        $dataChemicalStation = [];
        $chemicalStation['title'] = 'Chemical Station';
        $chemicalStation['data'] = $dataChemicalStation;

        //Sludge Station
        $sludgeStation = [];
        $dataSludgeStation = [];
        $sludgeStation['title'] = 'Sludge Station';
        $sludgeStation['data'] = $dataSludgeStation;

        //Supply Station
        $supplyStation = [];
        $dataSupplyStation = [];

        $dataSensor = [];
        $dataSupplyStation[0]['name'] = 'Chlorine';
        $dataSupplyStation[0]['symbol'] = 'CL05';
        $dataSensor[0]['value'] = $obj->cl05;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = 'ppm';
        $dataSensor[0]['id'] = '4';
        $dataSensor[0]['is_percent'] = 'false';
        $dataSupplyStation[0]['data_sensor'] = $dataSensor;

        $dataSensor = [];
        $dataSupplyStation[1]['name'] = 'pH';
        $dataSupplyStation[1]['symbol'] = 'pH05';
        $dataSensor[0]['value'] = $obj->pH05;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = 'pH';
        $dataSensor[0]['id'] = '5';
        $dataSensor[0]['is_percent'] = 'false';
        $dataSupplyStation[1]['data_sensor'] = $dataSensor;

        $dataSensor = [];
        $dataSupplyStation[2]['name'] = 'Turbidity';
        $dataSupplyStation[2]['symbol'] = 'NTU05';
        $dataSensor[0]['value'] = $obj->ntu05;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = 'ppm';
        $dataSensor[0]['id'] = '6';
        $dataSensor[0]['is_percent'] = 'false';
        $dataSupplyStation[2]['data_sensor'] = $dataSensor;

        $dataSensor = [];
        $dataSupplyStation[3]['name'] = 'Level';
        $dataSupplyStation[3]['symbol'] = 'LT05';
        $dataSensor[0]['value'] = $obj->lt05P1;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = 'm';
        $dataSensor[0]['id'] = '7';
        $dataSensor[0]['is_percent'] = 'false';

        $dataSensor[1]['value'] = $obj->lt05P2;
        $dataSensor[1]['type'] = 'real';
        $dataSensor[1]['unit'] = 'm3';
        $dataSensor[1]['id'] = '8';
        $dataSensor[1]['is_percent'] = 'false';

        $dataSensor[2]['value'] = $obj->lt05P3;
        $dataSensor[2]['type'] = 'real';
        $dataSensor[2]['unit'] = '%';
        $dataSensor[2]['id'] = '9';
        $dataSensor[2]['is_percent'] = 'true';
        $dataSupplyStation[3]['data_sensor'] = $dataSensor;

        $dataSensor = [];
        $dataSupplyStation[4]['name'] = 'Presure';
        $dataSupplyStation[4]['symbol'] = 'PT05';
        $dataSensor[0]['value'] = $obj->pt05;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = '';
        $dataSensor[0]['id'] = '10';
        $dataSensor[0]['is_percent'] = 'false';
        $dataSupplyStation[4]['data_sensor'] = $dataSensor;

        $dataSensor = [];
        $dataSupplyStation[5]['name'] = 'Flow rate';
        $dataSupplyStation[5]['symbol'] = 'FT05';
        $dataSensor[0]['value'] = $obj->ft05P1;
        $dataSensor[0]['type'] = 'real';
        $dataSensor[0]['unit'] = 'm3/h';
        $dataSensor[0]['id'] = '11';
        $dataSensor[0]['is_percent'] = 'false';
        
        $dataSensor[1]['value'] = $obj->ft05P2;
        $dataSensor[1]['type'] = 'real';
        $dataSensor[1]['unit'] = 'm3/d';
        $dataSensor[1]['id'] = '12';
        $dataSensor[1]['is_percent'] = 'false';
        
        $dataSensor[2]['value'] = $obj->ft05P3;
        $dataSensor[2]['type'] = 'int';
        $dataSensor[2]['unit'] = 'm3';
        $dataSensor[2]['id'] = '13';
        $dataSensor[2]['is_percent'] = 'false';
        $dataSupplyStation[5]['data_sensor'] = $dataSensor;
                        

        $supplyStation['title'] = 'Supply Station';
        $supplyStation['data'] = $dataSupplyStation;

        $return[0] = $rawStation;
        $return[1] = $processStation;
        $return[2] = $chemicalStation;
        $return[3] = $sludgeStation;
        $return[4] = $supplyStation;
        return $return;
    }

    private function parseContentDevice($data) {
        $obj = json_decode($data);
        //print_r($obj);die;
        $return = [];
        //Raw Station
        $rawStation = [];
        $dataRawStation = [];
        for ($i = 0; $i < 14; $i++) {
            $param = 'wp010' . ($i + 1);
            $dataRawStation[$i]['name'] = 'Well Pump';
            $dataRawStation[$i]['symbol'] = 'WP01.0' . ($i + 1);
            $dataRawStation[$i]['status'] = $obj->$param;
            $dataRawStation[$i]['forces_control'] = '';
            $dataRawStation[$i]['total_runtime'] = '';
            $dataRawStation[$i]['total_trip'] = '';
            $dataRawStation[$i]['setz'] = '';
            $dataRawStation[$i]['feedback'] = '';
            $dataRawStation[$i]['id'] = 1;
        }

        $rawStation['title'] = 'Raw Station';
        $rawStation['data'] = $dataRawStation;

        //Process Station
        $processStation = [];
        $dataProcessStation = [];
        for ($i = 0; $i < 6; $i++) {
            $param;
            $symbol;
            switch ($i) {
                case 0:
                    $symbol = 'EF02.01A';
                    $param = 'ef0201a';
                    break;
                case 1:
                    $symbol = 'EF02.01B';
                    $param = 'ef0201b';
                    break;
                case 2:
                    $symbol = 'EF02.02A';
                    $param = 'ef0202a';
                    break;
                case 3:
                    $symbol = 'EF02.02B';
                    $param = 'ef0202b';
                    break;
                case 4:
                    $symbol = 'EF02.03A';
                    $param = 'ef0203a';
                    break;
                case 5:
                    $symbol = 'EF02.03B';
                    $param = 'ef0203b';
                    break;
            }
            $dataProcessStation[$i]['name'] = 'Blower Fan';
            $dataProcessStation[$i]['symbol'] = $symbol;
            $dataProcessStation[$i]['status'] = $param;
            $dataProcessStation[$i]['forces_control'] = '';
            $dataProcessStation[$i]['total_runtime'] = '';
            $dataProcessStation[$i]['total_trip'] = '';
            $dataProcessStation[$i]['setz'] = '';
            $dataProcessStation[$i]['feedback'] = '';
            $dataProcessStation[$i]['id'] = 2;
        }
        $dataProcessStation[6]['name'] = 'Reaction Stirrer';
        $dataProcessStation[6]['symbol1'] = 'MK02.01A';
        $dataProcessStation[6]['status'] = $obj->mk0201aP1;
        $dataProcessStation[6]['forces_control'] = '';
        $dataProcessStation[6]['total_runtime'] = '';
        $dataProcessStation[6]['total_trip'] = '';
        $dataProcessStation[6]['setz'] = '';
        $dataProcessStation[6]['feedback'] = $obj->mk0201aP2;
        $dataProcessStation[6]['id'] = 3;

        $dataProcessStation[7]['name'] = 'Reaction Stirrer';
        $dataProcessStation[7]['symbol1'] = 'MK02.01B';
        $dataProcessStation[7]['status'] = $obj->mk0201bP1;
        $dataProcessStation[7]['forces_control'] = '';
        $dataProcessStation[7]['total_runtime'] = '';
        $dataProcessStation[7]['total_trip'] = '';
        $dataProcessStation[7]['setz'] = '';
        $dataProcessStation[7]['feedback'] = $obj->mk0201bP2;
        $dataProcessStation[7]['id'] = 4;

        $dataProcessStation[8]['name'] = 'Reaction Stirrer';
        $dataProcessStation[8]['symbol1'] = 'MK02.02A';
        $dataProcessStation[8]['status'] = $obj->mk0202aP1;
        $dataProcessStation[8]['forces_control'] = '';
        $dataProcessStation[8]['total_runtime'] = '';
        $dataProcessStation[8]['total_trip'] = '';
        $dataProcessStation[8]['setz'] = '';
        $dataProcessStation[8]['feedback'] = $obj->mk0202aP2;
        $dataProcessStation[8]['id'] = 5;

        $dataProcessStation[9]['name'] = 'Reaction Stirrer';
        $dataProcessStation[9]['symbol1'] = 'MK02.02B';
        $dataProcessStation[9]['status'] = $obj->mk0202bP1;
        $dataProcessStation[9]['forces_control'] = '';
        $dataProcessStation[9]['total_runtime'] = '';
        $dataProcessStation[9]['total_trip'] = '';
        $dataProcessStation[9]['setz'] = '';
        $dataProcessStation[9]['feedback'] = $obj->mk0202bP2;
        $dataProcessStation[9]['id'] = 6;

        $dataProcessStation[10]['name'] = 'Reaction Stirrer';
        $dataProcessStation[10]['symbol1'] = 'MK02.03A';
        $dataProcessStation[10]['status'] = $obj->mk0203aP1;
        $dataProcessStation[10]['forces_control'] = '';
        $dataProcessStation[10]['total_runtime'] = '';
        $dataProcessStation[10]['total_trip'] = '';
        $dataProcessStation[10]['setz'] = '';
        $dataProcessStation[10]['feedback'] = $obj->mk0203aP2;
        $dataProcessStation[10]['id'] = 7;

        $dataProcessStation[11]['name'] = 'Reaction Stirrer';
        $dataProcessStation[11]['symbol1'] = 'MK02.03B';
        $dataProcessStation[11]['status'] = $obj->mk0203aP1;
        $dataProcessStation[11]['forces_control'] = '';
        $dataProcessStation[11]['total_runtime'] = '';
        $dataProcessStation[11]['total_trip'] = '';
        $dataProcessStation[11]['setz'] = '';
        $dataProcessStation[11]['feedback'] = $obj->mk0203aP2;
        $dataProcessStation[12]['id'] = 7;

        $processStation['title'] = 'Process Station';
        $processStation['data'] = $dataProcessStation;

        //Chemical Station
        $chemicalStation = [];
        $dataChemicalStation = [];
        $chemicalStation['title'] = 'Chemical Station';
        $chemicalStation['data'] = $dataChemicalStation;


        //Sludge Station
        $sludgeStation = [];
        $dataSludgeStation = [];
        $sludgeStation['title'] = 'Sludge Station';
        $sludgeStation['data'] = $dataSludgeStation;

        //Supply Station
        $supplyStation = [];
        $dataSupplyStation = [];

        $supplyStation['title'] = 'Supply Station';
        $supplyStation['data'] = $dataSupplyStation;

        $return[0] = $rawStation;
        $return[1] = $processStation;
        $return[2] = $chemicalStation;
        $return[3] = $sludgeStation;
        $return[4] = $supplyStation;
        return $return;
    }

}
