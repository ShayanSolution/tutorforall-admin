<?php

if (! function_exists('dateTimeConverter')) {
    function dateTimeConverter($dateTime) {
        return \Carbon\Carbon::parse($dateTime)->format('M d, Y h:i A');
    }
}
