<?php

class responses
{

    public $response = [
        'status' => '',
        'result' => array()
    ];

    #2XX -> Success
    public function response_200($success_msg = 'Ok')
    {
        $this->response['status'] = 'Success';
        $this->response['result'] = array(
            'success_id' => '200',
            'success_msg' => $success_msg
        );
        return $this->response;
    }
    public function response_201($success_msg = 'Created')
    {
        $this->response['status'] = 'Success';
        $this->response['result'] = array(
            'success_id' => '201',
            'success_msg' => $success_msg
        );
        return $this->response;
    }

    #4XX -> Client Error
    public function error_400($error_msg = 'Bad Request')
    {
        $this->response['status'] = 'Error';
        $this->response['result'] = array(
            'error_id' => '400',
            'error_msg' => $error_msg
        );
        return $this->response;
    }
    public function error_401($error_msg = 'Unauthorized')
    {
        $this->response['status'] = 'Error';
        $this->response['result'] = array(
            'error_id' => '401',
            'error_msg' => $error_msg
        );
        return $this->response;
    }

    public function error_403($error_msg = 'Forbidden'){
        $this->response['status'] = 'Error';
        $this->response['result'] = array(
            'error_id' => '403',
            'error_msg' => $error_msg
        );
        return $this->response;
    }

    public function error_404($error_msg = 'Not Found'){
        $this->response['status'] = 'Error';
        $this->response['result'] = array(
            'error_id' => '404',
            'error_msg' => $error_msg
        );
        return $this->response;
    }

    public function error_405($error_msg = 'Method not Allowed')
    {
        $this->response['status'] = 'Error';
        $this->response['result'] = array(
            'error_id' => '405',
            'error_msg' => $error_msg
        );
        return $this->response;
    }

    #5XX -> Server Error

    public function error_500($internal_error_msg = 'Internal Server Error')
    {
        $this->response['status'] = 'Error';
        $this->response['result'] = array(
            'error_id' => '200',
            'error_msg' => $internal_error_msg
        );
        return $this->response;
    }
}
