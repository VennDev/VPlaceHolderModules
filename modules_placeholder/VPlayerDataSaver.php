<?php

declare(strict_types=1);

use venndev\vapmdatabase\database\ResultQuery;
use venndev\vplaceholder\VPlaceHolder;
use venndev\vplayerdatasaver\VPlayerDataSaver;
use vennv\vapm\Async;

$version = "1.0.0";
$author = "VennDev";

/**
 * This is a placeholder for VPlayerDataSaver plugin
 * It contains some `async` methods from VPlayerDataSaver
 */

if (!class_exists(VPlayerDataSaver::class)) {
    throw new RuntimeException("VPlayerDataSaver class not found! Install here: https://github.com/VennDev/VPlayerDataSaver");
}

if (!class_exists(Async::class)) {
    throw new RuntimeException("Async class not found! Install here: https://github.com/VennDev/LibVapmPMMP");
}

if (!class_exists(ResultQuery::class)) {
    throw new RuntimeException("ResultQuery class not found! Install here: https://github.com/VennDev/VapmDatabasePMMP");
}

VPlaceHolder::registerPlaceHolder("{vpds_get_name_player_by_xuid}", function (string $xuid): Async {
    return new Async(function () use ($xuid) {
        $data = Async::await(Async::await(VPlayerDataSaver::getDataByXuid($xuid)));
        if ($data instanceof ResultQuery) $data = $data->getResult();
        return $data["name"];
    });
}, true);
