<?php

namespace PhucThinh\API\Controllers;

use \Illuminate\Routing\Controller;
use RainLab\User\Models\User AS UserModel;
use RainLab\User\Models\UserGroup;
use Illuminate\Http\Response;

/**
 * General Back-end Controller
 */
class General extends Controller {

    protected $statusCode = Response::HTTP_OK;

    const HTTP_NOT_FOUND = Response::HTTP_NOT_FOUND;
    const HTTP_INTERNAL_SERVER_ERROR = Response::HTTP_INTERNAL_SERVER_ERROR;
    const HTTP_BAD_REQUEST = Response::HTTP_BAD_REQUEST;
    const HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;
    const HTTP_METHOD_NOT_ALLOWED = Response::HTTP_METHOD_NOT_ALLOWED;

    public function __construct() {
        
    }

    protected function getStatusCode() {
        return $this->statusCode;
    }

    protected function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function respondWithError($message = null, $statusCode = null) {
        if (is_null($statusCode)) {
            $this->setStatusCode(200);
        } else {
            $this->setStatusCode($statusCode);
        }
        $response = [
            'status' => true,
            'status_code' => $this->getStatusCode(),
            'message' => $message,
        ];

        return $this->respondWithArray($response);
    }

    protected function respondWithArray(array $array, array $headers = []) {
        return response()->json($array, $this->statusCode, $headers);
    }

    protected function respondWithSuccess($data = [], $message = 'Action Successfully') {
        if (isset($data['data'])) {
            $data = $data['data'];
        }
        $response = [
            'status' => false,
            'status_code' => $this->getStatusCode(),
            'message' => $message,
            'data' => $data,
        ];

        return $this->respondWithArray($response);
    }

    protected function respondWithGiftSuccess($data = [], $totalGift, $message = 'Action Successfully') {
        if (isset($data['data'])) {
            $data = $data['data'];
        }
        $response = [
            'status' => false,
            'status_code' => $this->getStatusCode(),
            'message' => $message,
            'totalGift' => $totalGift,
            'data' => $data,
        ];

        return $this->respondWithArray($response);
    }

    protected function respondWithData($data = [], array $headers = []) {
        $array = array_merge([
            'status' => false,
            'status_code' => $this->getStatusCode(),
            'data' => $data,
        ]);
        return $this->respondWithArray($array, $headers);
    }

    protected function respondWithDataPaging($data = [], $pagination = []) {
        $array = array_merge([
            'status' => false,
            'status_code' => $this->getStatusCode(),
            'data' => $data,
            'paging' => $pagination
        ]);
        return $this->respondWithArray($array);
    }

    protected function respondWithMessage($message, array $headers = []) {
        $array = array_merge([
            'status' => false,
            'status_code' => $this->getStatusCode(),
            'message' => $message,
        ]);
        return $this->respondWithArray($array, $headers);
    }

    protected function checkAuthUser($request) {
        $user = $request->user();
        if (!$user) {
            return $this->respondWithError('user is invalid', 404);
        }
    }

    /**
     * random String Password
     *
     * @return \Illuminate\Http\Response
     */
    public static function randomString($length = 10) {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public function getRandomCode($length = 6) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function callAPI($link, $type, $postData = null) {
        $curl = curl_init();
        if ($type == "POST") {
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_URL => $link,
                CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
        } else {
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $link,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            ));
        }
        $resp = curl_exec($curl);
        return $resp;
        curl_close($curl);
    }

    public function translateAuto($string) {
        $original = ["Luu", "luong", "Muc", "Ap", "suat", "Bom", "gieng", "Quat", "hoa", "Khuay", "Hut", "xa", "bun", "hoi", "gio", "rua", "loc", "nuoc", "sach", "vao", "cap", "khi", "be", "Nhiet", "do"];
        $modify = ["Lưu", "lượng", "Mực", "Áp", "suất", "Bơm", "Giếng", "Quạt", "hóa", "Khuấy", "Hút", "xả", "bùn", "hồi", "gió", "rửa", "lọc", "nước", "sạch", "vào", "cấp", "khí", "bể", "Nhiệt", "độ"];
        return str_replace($original, $modify, $string);
    }

    public function parseStatusDevice($status) {
        $result = [];
        switch ($status) {
            case 0:
                $result['name'] = "None";
                $result['color'] = "#ffffff";
                break;
            case 1:
                $result['name'] = "Local";
                $result['color'] = "#ffffff";
                break;
            case 2:
                $result['name'] = "Manu";
                $result['color'] = "#ffffff";
                break;
            case 3:
                $result['name'] = "Auto";
                $result['color'] = "#ffffff";
                break;
            case 4:
                $result['name'] = "Udf";
                $result['color'] = "#808080";
                break;
        }
        return $result;
    }

    public function parseOperationStatusMotor($status) {
        $result = [];
        switch ($status) {
            case 0:
                $result['name'] = "None";
                $result['color'] = "#ffffff";
                break;
            case 1:
                $result['name'] = "Stop";
                $result['color'] = "#FF0000";
                break;
            case 2:
                $result['name'] = "Run";
                $result['color'] = "#008000";
                break;
            case 3:
                $result['name'] = "F.OVL";
                $result['color'] = "#FFFF00";
                break;
            case 4:
                $result['name'] = "F.NRF";
                $result['color'] = "#FFFF00";
                break;
            case 5:
                $result['name'] = "Ack";
                $result['color'] = "#FFFF00";
                break;
            case 6:
                $result['name'] = "Udf";
                $result['color'] = "#808080";
                break;
        }
        return $result;
    }

    public function parseOperationStatusValve($status) {
        $result = [];
        switch ($status) {
            case 0:
                $result['name'] = "None";
                $result['color'] = "#ffffff";
                break;
            case 1:
                $result['name'] = "Close";
                $result['color'] = "#FF0000";
                break;
            case 2:
                $result['name'] = "Mid";
                $result['color'] = "#FF0000";
                break;
            case 3:
                $result['name'] = "Open";
                $result['color'] = "#008000";
                break;
            case 4:
                $result['name'] = "F.O";
                $result['color'] = "#FFFF00";
                break;
            case 5:
                $result['name'] = "F.C";
                $result['color'] = "#FFFF00";
                break;
            case 6:
                $result['name'] = "Ack";
                $result['color'] = "#FFFF00";
                break;
            case 7:
                $result['name'] = "Udf";
                $result['color'] = "#808080";
                break;
        }
        return $result;
    }
    
    public function getNameStationStatistic($index) {
        $name = '';
        switch ($index) {
            case 1:
                $name = "Nước Thô";
                break;
            case 2:
                $name = "Xử Lý";
                break;
            case 3:
                $name = "Hóa Chất";
                break;
            case 4:
                $name = "Bùn";
                break;
            case 5:
                $name = "Nước Sạch";
                break;
            case 6:
                $name = "Khác";
                break;
            case 7:
                $name = "Máy Phát Điện";
                break;
            case 8:
                $name = "Phân Phối";
                break;
        }
        return $name;
    }
    
    public function getNameHoaChat($index) {
        $name = '';
        switch ($index) {
            case 1:
                $name = "Vôi";
                break;
            case 2:
                $name = "PAC";
                break;
            case 3:
                $name = "Polyme";
                break;
            case 4:
                $name = "Clo";
                break;
            case 5:
                $name = "Khác";
                break;
        }
        return $name;
    }
    
    public function getDeviceName($factoryId) {
        try {
            //Call API
            $link = 'http://115.78.130.60:41440/api/TableMotorValveSensors/' . $factoryId;
            $resp = $this->callAPI($link,"GET");
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function getStation($factoryID) {
        try {            
            //Call API
            $link = 'http://115.78.130.60:41440/api/TableStations/' . $factoryID;
            $resp = $this->callAPI($link,"GET");
            return $resp;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}
