<?php
// function TIMESTAMP
// if TYPE defined as 1 there will be only date
// if TYPE defined as 2 there wiil be only time
// if TYPE defined as 3 there wiil be date and time

// 01234567890123
// 20041009225854
function timestmp ($timest, $type = 3)
{
	switch ($type) {
		case 1 :
        	$data = substr($timest,6,2)."-".substr($timest,4,2)."-".substr($timest,0,4);
            break;
		case 2 :
        	$data = substr($timest,8,2).":".substr($timest,10,2).":".substr($timest,12,2);
            break;
		case 3 :
        	$data = substr($timest,6,2)."-".substr($timest,4,2)."-".substr($timest,0,4)." ".substr($timest,8,2).":".substr($timest,10,2).":".substr($timest,12,2);
            break;

    }

    return $data;
}
?>