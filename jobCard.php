<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 8/29/16
 * Time: 11:10 AM
 */


if($_GET['ids']) {

    //var_dump($_GET);
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
    //var_dump($id);


    //echo $sql;echo count($candArr); die();

    $html = '
<style>
@page {

    margin-top: 0cm;
    margin-bottom: 0cm;
    margin-left: 0cm;
    margin-right: 0cm;
}
</style>';

    for($i=0;$i<count($id);) {
        $html .= '<div style=" height: 30cm !important;width: 21cm; background-color: #fff;text-align: center;border:thin solid #fff;">

            <div style=" height: 6cm !important;width: 21cm;background-color: #fff;">';

        for($j=0;$j<10;$j++) {
            $con = ($j%2==0)?'left':'right';

            $html .= '<div style="height: 5.9cm !important;background-image: url(\'images/jobCard.png\');background-position: center top;
    background-size: 100% auto;width: 10.47cm;background-color: #fff;float: '.$con.';">
                <div style="float:left;margin-left:-6cm;margin-top:0.4cm;font-size:small; "> S.No. '.date("Ymd") .$id[($i+$j)].'</div>

            </div>';
            if($i+$j+2 > count($id))
                break;
        }


        $html .=    '</div>

            </div>';

        $i +=10;

    }
    include("./library/mpdf60/mpdf.php");


    $mpdf = new mPDF('', 'A4');

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
}