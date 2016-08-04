<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 8/3/16
 * Time: 2:52 PM
 */

$config['host'] = "localhost";
$config['user'] = "root";
$config['password'] = "redhat@11111p";
$config['database'] = "bluenet_v3";

$db_handle = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);

function getIcard($logo, $photo, $name, $service, $id, $office, $emg, $locAdd, $qrCode){

    return  '<div style=" height: 3.7in !important;
            width: 4.6in;
            background-color: #fff;text-align: center;border:thin solid #fff;float: right;">

    <div style="width: 2.3in;float: left;">
        <img src="http://api.file-dog.shatkonlabs.com/files/rahul/'.

    $logo.'"
             style="margin-top:0.1in;max-width: 2in;height: 0.8in;"/>

        <div  style="height: 1.2in;width: 2.3in;background-color:#2aafc3 ;">

            <img src="http://api.file-dog.shatkonlabs.com/files/rahul/'.

    $photo.'"
                 style="border-radius: 15px;max-width: 2in;height: 1.2in;"/>
        </div>

        <div style="height: 0.9in;text-align:Center;width: 2.3in;float: left;">
            <br/>
            <b style="font-size:large;">'.
    $name.'</b><br/>
            <span style="font-size:small;">'.
    $service.'</span><br/>
            '.
    $id.'
        </div>

        <div style="height: 0.3in;width: 2.3in;float: left;border-top: thick solid #2aafc3;font-size:small;	">
            '.
    $office.'


        </div>
    </div>


    <div style="height: 3.5in;width: 2.3in;float: right;">

        <div style="height: 0.7in;width: 2.3in;background-color:#2aafc3 ;">

            <div style="font-size:small;margin-left: 0.1in;text-align: left;">


                <b>Emergnecy No :</b> '.
    $emg.'<br/>

                <b>Address :</b> '.
    $locAdd.'


            </div>
        </div>
        <div style="height: 0.72in;width: 2.3in;background-color: #2aafc3;float: left;border-top: thick solid #fff;">
            <div style="width: 0.7in;float: left;"
            >
                <img src="http://localhost/dpower4/campaning_engine/drawable-xxhdpi-icon.png"
                     style="width: 0.5in;height:0.5in;margin-top:0.1in; "/>
            </div>
            <div style="font-size: small; margin-top:0.1in;">
                <b style="font-size: smaller;">
                    Check Authenticity By<br/>Install "Blueteam" App & scan below QR code</b>
            </div>
        </div>
        <div style="height: 1.55in;text-align: Center;">
            <img src="'.
    $qrCode.'"
                 style=" border:thin solid black;margin-top:0.1in;max-width: 100%;height: 1.35in;"/>


        </div>

        <div style="height: 0.4in;width: 2.3in;background-color: #2aafc3;float: left;">
                <span style="font-size: smaller;">
            Maid|Cook|Driver|Babysitter

                <b >
                    SUPPORT : 95990 75355</b>
                </span>

        </div>
    </div>

</div>
';

}
if (mysqli_connect_errno()) {
    /* send 500 html header*/
    internalServerError("Error description: " . mysqli_error($db_handle));
    echo("Error description: " . mysqli_error($db_handle));
    die();

}

if($_GET['ids']){

    $id_un = explode(",",$_GET['ids']);
    $id = null;
    foreach($id_un as $v){

        if(substr_compare($v,"-")){

            $from_to = explode("-",$v);
            $from = intval($from_to[0]);
            $to = intval($from_to[1]);
            for($from;$from<=$to;$from++)
                $id[] = $from;

        }else{
            $id[] = $v;
        }

    }

    $sqlStr = "";
    foreach($id as $i){
        $sqlStr .= $i . " or ";
    }
    $sqlStr .= $i;

$sql = "SELECT  u.`name` , u.`mobile` , u.`email`  , u.`address` , u.`area` , " .
    " u.`rating`, u.`photo`, w.`status`, w.`emergency_no`,w.`native_place`,w.`dob` ".
    "FROM `bluenet_v3`.`users` as u left join `bluenet_v3`.`workers` AS w ON w.user_id = u.id WHERE id = " . $sqlStr . "; ";

$result = mysqli_query($db_handle, $sql);

    for($candArr = array(); $cand = mysqli_fetch_assoc($result); $candArr[] = $cand);



    $html = '
<style>
@page {

    margin-top: 1cm;
    margin-bottom: 0cm;
    margin-left: 1cm;
    margin-right: 1cm;
}
</style>';

    for($i=0;$i<count($candArr);) {
        $html .= '<div style=" height: 7.5in !important;
            width: 10in;
            background-color: #fff;text-align: center;border:thin solid #fff;">

            <div style=" height: 3.6in !important;
            width: 10in;
            background-color: #fff;text-align: center;border:thin solid #fff;">';

        $html .= getIcard($candArr[$i]['logo'], $candArr[$i]['photo'], $candArr[$i]['name'], $candArr[$i]['service'], $candArr[$i]['id'],
                    $candArr[$i]['office'], $candArr[$i]['emg'], $candArr[$i]['locAdd'], $candArr[$i]['qrCode']);

        $i++;
        if($i>=count($candArr)) { $html .= '</div></div>'; break;}

        $html .= getIcard($candArr[$i]['logo'], $candArr[$i]['photo'], $candArr[$i]['name'], $candArr[$i]['service'], $candArr[$i]['id'],
            $candArr[$i]['office'], $candArr[$i]['emg'], $candArr[$i]['locAdd'], $candArr[$i]['qrCode']);

        $i++;
        if($i>=count($candArr)) { $html .= '</div></div>'; break;}
        $html .= '</div><div style=" height: 3.6in !important;
            width: 10in;
            background-color: #fff;text-align: center;border:thin solid #fff;">';

        $html .= getIcard($candArr[$i]['logo'], $candArr[$i]['photo'], $candArr[$i]['name'], $candArr[$i]['service'], $candArr[$i]['id'],
            $candArr[$i]['office'], $candArr[$i]['emg'], $candArr[$i]['locAdd'], $candArr[$i]['qrCode']);

        $i++;
        if($i>=count($candArr)) { $html .= '</div></div>'; break;}

        $html .= getIcard($candArr[$i]['logo'], $candArr[$i]['photo'], $candArr[$i]['name'], $candArr[$i]['service'], $candArr[$i]['id'],
            $candArr[$i]['office'], $candArr[$i]['emg'], $candArr[$i]['locAdd'], $candArr[$i]['qrCode']);


        $html .= '</div></div>';

    }

include("./library/mpdf60/mpdf.php");


$mpdf=new mPDF('','A4-L');  

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

}
//echo "hello";