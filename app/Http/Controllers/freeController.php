<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;


class freeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = User::find(1);
        $Resource = new UserResource($User);
        return $Resource;
    }

    public function getServerData()
    {

        $curl = curl_init();

        $curlOpt = [
            CURLOPT_URL => "https://85.187.243.6:2224/cgi-bin/pppoe_server/search_user_pppoe_server.cgi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('realm_id' => 'gaberovo'),
        ];



        curl_setopt_array($curl, $curlOpt);

        $response = curl_exec($curl);

        if (curl_exec($curl) === false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            //echo 'Operation completed without any errors';
        }

        $curl = curl_init();

        $curlOpt = [
            CURLOPT_URL => "https://85.187.243.6:2224/cgi-bin/pppoe_server/search_user_pppoe_server.cgi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('realm_id' => 'gaberovo'),
        ];



        curl_setopt_array($curl, $curlOpt);

        $response = curl_exec($curl);

        if (curl_exec($curl) === false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            //echo 'Operation completed without any errors';
        }

        function callback($buffer)
        {
            // replace all the apples with oranges

            $thbg = ["номер", "връзка", "потребител", "ай пи адрес", "на линия от", "влан", "локация", "<TABLE>"];
            $th = ["ID", "CONECTION", "USERNAME", "IP", "OnlineTime", "Wlan", "Locale", "<table id='onlineTable' class='table table-striped table-dark'>"];

            return (str_replace($thbg, $th, $buffer));
        }

        curl_close($curl);
        ob_start("callback");
        $html = <<<EOF
 <div>
    <?= $response; ?>
</div>
EOF;
        ob_end_flush();

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return new User($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
