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

function getIcard($logo, $photo, $name, $service, $id, $office, $emg, $locAdd, $qrCode,$i, $localId){
    $con = ($i%2==0)?'left':'right';

    return  '<div style=" height: 3.7in !important;
            width: 4.6in;
            background-color: #fff;text-align: center;border:thin solid #fff;float: '.$con.';">

    <div style="width: 2.3in;float: left;background-image: url(\'images/only_card.png\');">
    <div  style="height: 0.8in;width: 2.3in;">
        <img src="http://api.file-dog.shatkonlabs.com/files/rahul/'.

    $logo.'"
             style="margin-top:0.1in;max-width: 2in;height: 0.6in;"/>
             </div>

        <div  style="margin-top: 0.1in;height: 1.2in;width: 2.3in;">

            <img src="http://api.file-dog.shatkonlabs.com/files/rahul/'.

    $photo.'"
                 style="border:thin solid black;border-radius: 15px;max-width: 2in;height: 1.2in;"/>
        </div>

        <div style="height: 0.9in;text-align:Center;width: 2.3in;float: left;">
            <br/>
            <b style="font-size:large;">'.
    ucwords($name).'</b><br/>
            <span style="font-size:small;">'.
    ucwords($service).'</span><br/>
            '.$localId.'<span style="font-size:12px;"> (DE-'.
    $id.')</span>
        </div>

        <div style="height: 0.3in;width: 2.3in;float: left;border-top: thick solid #00a0aa;font-size:small;	">
<div style="width: 1.8in;height: 0.3in;float:left;">            '.
    ucwords($office).'
    </div>
<div style="width: 0.4in;height: 0.3in;float:right;">
<img src="http://api.file-dog.shatkonlabs.com/files/rahul/391" style="max-width: 0.4in;height: 0.3in;float:right"/>
</div>
        </div>
    </div>


    <div style="height: 3.5in;width: 2.3in;float: right;color: #fff;">

        <div style="height: 0.7in;width: 2.3in;background-color:#00a0aa ;">

            <div style="font-size:small;margin-left: 0.1in;text-align: left;font-color: #fff;">


                <b>Emergnecy No :</b> '.
    $emg.'<br/>

                <b>Address :</b> '.
    ucwords($locAdd).'


            </div>
        </div>
        <div style="height: 0.72in;width: 2.3in;background-color: #00a0aa;float: left;border-top: thick solid #fff;">
            <div style="width: 0.7in;float: left;"
            >
                <img src="https://raw.githubusercontent.com/rahullahoria/bjsIonic/master/blueteam/resources/android/icon/drawable-xxhdpi-icon.png"
                     style="width: 0.5in;height:0.5in;margin-top:0.1in; "/>
            </div>
            <div style="font-size: small; margin-top:0.1in;font-color: #fff;">
                <b style="font-size: smaller;">
                    Check Authenticity By<br/>Install "Blueteam" App & scan below QR code</b>
            </div>
        </div>
        <div style="height: 1.55in;text-align: Center;">
            <img src="http://shatkonlabs.com/qr_code_generator/index2.php?data='.
    $qrCode.'&size=4&level=L"
                 style=" border:thin solid black;margin-top:0.1in;max-width: 100%;height: 1.35in;"/>


        </div>

        <div style="height: 0.4in;width: 2.3in;background-color: #00a0aa;float: left;">
                <span style="font-size: smaller;font-color: #fff;">
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

        if(strpos($v,"-")){

            $from_to = explode("-",$v);
            $from = intval($from_to[0]);
            $to = intval($from_to[1]);
            for($from;$from<=$to;$from++)
                $id[] = $from;

        }else{
            $id[] = $v;
        }

    }

    $sqlStr = "(";
    foreach($id as $i){
        $sqlStr .= $i . " , ";
    }
    $sqlStr .= $i.')';

    $sql ="SELECT  * FROM `bluenet_v3`.societies WHERE id = ".$_GET['society_id']." ; ";
    $r = mysqli_query($db_handle, $sql);
    $societyD = mysqli_fetch_assoc($r);

/*
 *
 * */

    $sql = "SELECT Distinct (u.id) AS id, u.md5_id,u.name, u.mobile, u.photo, u.`address` , s.name as service,  w.id AS worker_id, w.emergency_no,".
        " ud.adhar_card, ud.voter_id, ud.driving_license, ud.pan_card, w.`local_id`, w.`status`,w.`native_place`,w.`dob`, ".
        " lu.name as lord_name, lu.mobile as lord_mobile, lu.`address` as lord_address ".
        " FROM `bluenet_v3`.`society_worker_mapping` AS swm ".
        " LEFT JOIN `bluenet_v3`.`workers` AS w on swm.worker_id = w.id".
        " LEFT JOIN `bluenet_v3`.`service_worker_mappings` AS srwm on srwm.worker_id = w.id".
        " LEFT JOIN `bluenet_v3`.`services` AS s on s.id = srwm.service_id".
        " LEFT JOIN `bluenet_v3`.users AS u ON w.user_id = u.id ".
        " LEFT JOIN `bluenet_v3`.users AS lu ON w.ref_id = lu.id".
        "

LEFT JOIN `bluenet_v3`.user_documents AS ud ON u.id = ud.user_id
WHERE swm.`society_id` =". $_GET['society_id'] ." AND u.id in ". $sqlStr . " group by u.id ; ";

//    echo $sql;echocount($candArr); die();


$result = mysqli_query($db_handle, $sql);

    for($candArr = array(); $cand = mysqli_fetch_assoc($result); $candArr[] = $cand);

    //echo $sql;echo count($candArr); die();

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
//1st icard of page
        $html .= getIcard($societyD['logo_id'], $candArr[$i]['photo'], $candArr[$i]['name'], $candArr[$i]['service'], $candArr[$i]['id'],
                    $societyD['address'], $candArr[$i]['emergency_no'], $candArr[$i]['address'], $candArr[$i]['md5_id'],$i,$candArr[$i]['local_id']);

        $i++;
        if($i>=count($candArr)) { $html .= '</div></div>'; break;}
//2st icard of page
        $html .= getIcard($societyD['logo_id'], $candArr[$i]['photo'], $candArr[$i]['name'], $candArr[$i]['service'], $candArr[$i]['id'],
            $societyD['address'], $candArr[$i]['emergency_no'], $candArr[$i]['address'], $candArr[$i]['md5_id'],$i,$candArr[$i]['local_id']);

        $i++;
        if($i>=count($candArr)) { $html .= '</div></div>'; break;}
        $html .= '</div><div style=" height: 3.6in !important;
            width: 10in;
            background-color: #fff;text-align: center;border:thin solid #fff;">';
//3rd icard of page
        $html .= getIcard($societyD['logo_id'], $candArr[$i]['photo'], $candArr[$i]['name'], $candArr[$i]['service'], $candArr[$i]['id'],
            $societyD['address'], $candArr[$i]['emergency_no'], $candArr[$i]['address'], $candArr[$i]['md5_id'],$i,$candArr[$i]['local_id']);

        $i++;
        if($i>=count($candArr)) { $html .= '</div></div>'; break;}
//4th icard of page
        $html .= getIcard($societyD['logo_id'], $candArr[$i]['photo'], $candArr[$i]['name'], $candArr[$i]['service'], $candArr[$i]['id'],
            $societyD['address'], $candArr[$i]['emergency_no'], $candArr[$i]['address'], $candArr[$i]['md5_id'],$i,$candArr[$i]['local_id']);


        $html .= '</div></div>';
        $i++;

    }

include("./library/mpdf60/mpdf.php");


$mpdf=new mPDF('','A4-L');  

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
    //echo $html;

}
//echo "hello";