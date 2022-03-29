<?php
function checkStatus($status)
{
    switch ($status) {
        case 0:
            return 'To Pay';
            break;
        case 1:
            return 'To Ship';
            break;
        case 2:
            return 'To Receive';
            break;
        case 3:
            return 'Completed';
            break;
        default:
            return 'Cancelled';
    }
}
