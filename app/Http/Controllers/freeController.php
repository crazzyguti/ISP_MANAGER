<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use \DateTime;
use \DateInterval;
use \DatePeriod;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


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

        $villages = [
            "bata", "belodol", "cherna_mogila", "dubnik", "gaberovo", "galabec", "koseovec", "medovo", "mrejichko", "nadur", "podgorec", "pripek", "prosenik", "razboina", "rojden", "rudina", "ruen", "rujica", "sini_rid", "sredna_mahala", "stracin",
        ];

        $randomVillage = $villages[array_rand($villages)];

        $curl = curl_init();

        $serverURLs = [
            "addUser" => "http://85.187.243.9:9999/cgi-bin/add_pppoe_user.cgi",
            "searchUser" => "http://85.187.243.9:9999/cgi-bin/search_user.cgi",
            "showOnlineUser" => "https://85.187.243.6:2224/cgi-bin/pppoe_server/search_user_pppoe_server.cgi",
            "editUser" => "http://85.187.243.9:9999/cgi-bin/change_pppoe_user_.cgi",
            "deleteUser" => ""
        ];

        //all villages = 65535

        $curlOpt = [
            CURLOPT_URL => $serverURLs["searchUser"],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('realm_id' => "65535", "username" => ""),
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

            $thbg = ["номер", "връзка", "потребител", "ай пи адрес", "на линия от", "влан", "локация", '<table border="0" width="height=" cellpadding="1" cellspacing="1">','<title>Search Page</title>','<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">'];
            $th = ["ID", "CONECTION", "USERNAME", "IP", "OnlineTime", "Wlan", "Locale", "<table id='serverTable' class='table table-striped table-dark'>","",""];

            return (str_replace($thbg, $th, $buffer));
        }

        curl_close($curl);

        $response = callback($response);

        $html = <<<EOF
 <div>
     <h1>$randomVillage</h1>
    <div> $response </div>
</div>
EOF;

 //   $html = $response;

        $html = iconv("windows-1251", "UTF-8", $response);

        // $parsedTable = $this->parseTable($html);

        // $demo = $parsedTable->item(0)->getElementsByTagName("td")->item(2);
        // $demo->saveHTML();
        // print_r($demo);

        $params = ["html" => $html];
       return view("datatable.table", $params);
    }

    public function parseTable($tableData = ""){
        $dom = new \DOMDocument;

        @$dom->loadHTML($tableData);
        $dom->preserveWhiteSpace = false;
        $dom->encoding = "UTF-8";
        $tables = $dom->getElementsByTagName('table');

        // $rows = $tables->item(1)->getElementsByTagName('tr');
        // dd($rows);
        // $params = ["html" => $rows];
        // return view("datatable.table", $params);

        return $tables;

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
     * jsonEditor a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jsonEditor(Request $request)
    {
    //    $data =  File::get(storage_path('app/marquee.json'));
        $file = file_get_contents(public_path("manifest.webmanifest"));
        $params = ["file" => $file];
        return view("editor.index",$params);
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
        return $this->datePerion();
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


    public function datePerion()
    {

        $begin = new DateTime('first day of this month');
        $now = new DateTime();
        $end = new DateTime('last day of this month');
        $end = $end->modify('+1 day');

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);

        foreach ($daterange as $date) {
            if ($now->format("d") == $date->format("d")) {
                echo "<span style='color:red;'>{$date->format("d")}</span> <br>";
            } else {
                echo $date->format("d") . "<br>";
            }
        }
    }
}
