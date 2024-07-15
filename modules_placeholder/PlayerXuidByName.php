<?php

declare(strict_types=1);

use pocketmine\Server;
use venndev\vplaceholder\VPlaceHolder;

VPlaceHolder::registerPlaceHolder("{player_xuid_by_name}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "";
    return $player->getXuid();
});
