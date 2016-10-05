<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('currency_format'))

{

    function currency_format($number)

    {

        return 'Rp '.number_format($number,2,',','.');

    }

    function tglinsertdata($tgl) {
    $tglex = explode("-", $tgl);
    $tgl = $tglex[2]."-".$tglex[1]."-".$tglex[0];
    return $tgl;
	}

     function viewtglweb($tgl){
 	$tgl=  substr($tgl, 0,10);
    $tglex = explode("-", $tgl);
    $tgl = $tglex[2] . "-" . $tglex[1] . "-" . $tglex[0];
    return $tgl;
 }





}