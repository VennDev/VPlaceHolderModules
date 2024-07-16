<?php

declare(strict_types=1);

use pocketmine\Server;
use venndev\vplaceholder\VPlaceHolder;

$version = "1.0.0";
$author = "VennDev";

VPlaceHolder::registerPlaceHolder("{player_xuid_by_name}", function (string $playerName): string {
    $player = Server::getInstance()->getPlayerExact($playerName);
    if ($player === null) return "";
    return $player->getXuid();
});
