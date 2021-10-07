<?php
$XMLReader = new XMLReader();
$XMLReader->open('feed_sample.xml');
while ($XMLReader->read()){
    if ($XMLReader->name === 'offer' && $XMLReader->nodeType == XMLReader::ELEMENT){
        $element = array();
        $element = simplexml_load_string($XMLReader->readOuterXml());
    }
}

$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
$doc->load('feed_sample.xml');
$xpath = new DOMXPath($doc);
$nodes = $xpath->query('/*//offer/opening_times');
$offer = $xpath->query('/*//offer');
$now = new DateTime( "now", new DateTimeZone( "Europe/Berlin" ) );
$now_formatted = $now->format( 'H:i' );
$today = date('l');//aktualny dzień

for ($i=0; $i<count($nodes); $i++){
    $opening = $nodes[$i]->childNodes[0]->nodeValue;
    $opening_array = explode('"', $opening);
    //definicja dnia jako liczby 1-7
    if ($today === 'Monday'){
        $day = 1;
    } elseif ($today === 'Tuesday'){
        $day = 2;
    } elseif ($today === 'Wednesday'){
        $day = 3;
    } elseif ($today === 'Thursday'){
        $day = 4;
    } elseif ($today === 'Friday'){
        $day = 5;
    } elseif ($today === 'Saturday'){
        $day = 6;
    } elseif ($today === 'Sunday'){
        $day = 7;
    }
    //definicja dnia jako liczby z pliku feed_sample.xml
    if (isset($opening_array[1])){
        if ($opening_array[1] === '1'){
            $monday = 1;
        } else {
            $monday = 0;
        }
    }
    if (isset($opening_array[11])){
        if ($opening_array[11] === '2'){
            $tuesday = 2;
        } else {
            $tuesday = 0;
        }
    }
    if (isset($opening_array[21])){
        if ($opening_array[21] === '3'){
            $wednesday = 3;
        } else {
            $tuesday = 0;
        }
    }
    if (isset($opening_array[31])){
        if ($opening_array[31] === '4'){
            $thursday = 4;
        } else {
            $thursday = 0;
        }
    }
    if (isset($opening_array[41])){
        if ($opening_array[41] === '5'){
            $friday = 5;
        } else {
            $friday = 0;
        }
    }
    if (isset($opening_array[51])){
        if ($opening_array[51] === '6'){
            $saturday = 6;
        } else {
            $saturday = 0;
        }
    }
    if (isset($opening_array[61])){
        if ($opening_array[61] === '7'){
            $sunday = 7;
        } else {
            $sunday = 0;
        }
    }
    //wybranie obecnego dnia z XML, pobranie danych: godziny otwarcia i zamknięcia oferty z XML, dodanie elementu <is_active> true bądź false w zależności czy obecna godzina jest pomiędzy godzinami otwarcia oferty
    if ($day === $monday){
        if (isset($opening_array[5]) && isset($opening_array[9])){
            if ($now_formatted>$opening_array[5] && $now_formatted<$opening_array[9]){
                $create_true = $doc->createElement('is_active', '<![CDATA[true]]>');
                $append = $offer[$i]->appendChild($create_true);//dodanie TRUE do offera
            } else{
                $create_false = $doc->createElement('is_active', '<![CDATA[false]]>');
                $append = $offer[$i]->appendChild($create_false);//dodanie FALSE do offera
            }
        }
    } elseif ($day === $tuesday){
        if (isset($opening_array[15]) && isset($opening_array[19])){
            if ($now_formatted>$opening_array[15] && $now_formatted<$opening_array[19]){
                $create_true = $doc->createElement('is_active', '<![CDATA[true]]>');
                $append = $offer[$i]->appendChild($create_true);//dodanie TRUE do offera
            } else{
                $create_false = $doc->createElement('is_active', '<![CDATA[false]]>');
                $append = $offer[$i]->appendChild($create_false);//dodanie FALSE do offera
            }
        }
    } elseif ($day === $wednesday){
        if (isset($opening_array[25]) && isset($opening_array[29])){
            if (isset($opening_array[25]) && isset($opening_array[29])){
                    if ($now_formatted>$opening_array[25] && $now_formatted<$opening_array[29]){
                        $create_true = $doc->createElement('is_active', '<![CDATA[true]]>');
                        $append = $offer[$i]->appendChild($create_true);//dodanie TRUE do offera
                    } else{
                        $create_false = $doc->createElement('is_active', '<![CDATA[false]]>');
                        $append = $offer[$i]->appendChild($create_false);//dodanie FALSE do offera
                    }
                }
        }
    } elseif ($day === $thursday){
        if (isset($opening_array[35]) && isset($opening_array[39])){
            if (isset($opening_array[35]) && isset($opening_array[39])){
                if ($now_formatted>$opening_array[35] && $now_formatted<$opening_array[39]){
                    $create_true = $doc->createElement('is_active', '<![CDATA[true]]>');
                    $append = $offer[$i]->appendChild($create_true);//dodanie TRUE do offera
                } else{
                    $create_false = $doc->createElement('is_active', '<![CDATA[false]]>');
                    $append = $offer[$i]->appendChild($create_false);//dodanie FALSE do offera
                }
            }
        }
    } elseif ($day === $friday){
        if (isset($opening_array[45]) && isset($opening_array[49])){
            if ($now_formatted>$opening_array[45] && $now_formatted<$opening_array[49]){
                $create_true = $doc->createElement('is_active', '<![CDATA[true]]>');
                $append = $offer[$i]->appendChild($create_true);//dodanie TRUE do offera
            } else{
                $create_false = $doc->createElement('is_active', '<![CDATA[false]]>');
                $append = $offer[$i]->appendChild($create_false);//dodanie FALSE do offera
            }
        }
    } elseif ($day === $saturday){
        if (isset($opening_array[55]) && isset($opening_array[59])){
            if ($now_formatted>$opening_array[55] && $now_formatted<$opening_array[59]){
                $create_true = $doc->createElement('is_active', '<![CDATA[true]]>');
                $append = $offer[$i]->appendChild($create_true);//dodanie TRUE do offera
            } else{
                $create_false = $doc->createElement('is_active', '<![CDATA[false]]>');
                $append = $offer[$i]->appendChild($create_false);//dodanie FALSE do offera
            }
        }
    } elseif ($day === $sunday){
        if (isset($opening_array[65]) && isset($opening_array[69])){
            if ($now_formatted>$opening_array[65] && $now_formatted<$opening_array[69]){
                $create_true = $doc->createElement('is_active', '<![CDATA[true]]>');
                $append = $offer[$i]->appendChild($create_true);//dodanie TRUE do offera
            } else{
                $create_false = $doc->createElement('is_active', '<![CDATA[false]]>');
                $append = $offer[$i]->appendChild($create_false);//dodanie FALSE do offera
            }
        }
    } else {
        $create_false = $doc->createElement('is_active', '<![CDATA[false]]>');
        $append = $offer[$i]->appendChild($create_false);//dodanie FALSE do offera
    }
}
//zapisanie output'u
$doc->save("feed_sample_wozniak.xml");
?>