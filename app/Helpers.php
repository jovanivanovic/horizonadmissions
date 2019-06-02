<?php

function slotAvailable($from, $to, $events){
    foreach($events as $event){
        $eventStart = \Carbon::instance(new DateTime($event['created_at']));
        $eventEnd = \Carbon::instance(new DateTime($event['updated_at']));

        if($from->between($eventStart, $eventEnd) && $to->between($eventStart, $eventEnd)){
            return false;
        }
    }
    return true;
}