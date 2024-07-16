<?php

declare(strict_types=1);

use pocketmine\Server;
use venndev\vplaceholder\VPlaceHolder;
use onebone\economyapi\EconomyAPI;
use cooldogedev\bedrockeconomy\BedrockEconomy;
use cooldogedev\bedrockeconomy\api\BedrockEconomyAPI;
use DaPigGuy\PiggyEconomy\PiggyEconomy;

VPlaceHolder::registerPlaceHolder("{ecoapi}", function (string $player): string {
    $playerInstance = Server::getInstance()->getPlayerExact($player);
    if ($playerInstance === null) return "Plugin not found";
    
    if (class_exists(EconomyAPI::class)) {
        $money = EconomyAPI::getInstance()->myMoney($playerInstance);
        return $money !== false ? (string)$money : "0";
    }
    
    return "Plugin not found";
});

VPlaceHolder::registerPlaceHolder("{bedrockeco}", function (string $player): string {
    $playerInstance = Server::getInstance()->getPlayerExact($player);
    if ($playerInstance === null) return "Plugin not found";

    if (class_exists(BedrockEconomy::class)) {
        $api = BedrockEconomy::getInstance()->getAPI();
        $balance = $api->getPlayerBalance($playerInstance->getName());
        return $balance !== null ? (string)$balance : "0";
    }

    return "Plugin not found";
});

VPlaceHolder::registerPlaceHolder("{piggyeco}", function (string $player): string {
    $playerInstance = Server::getInstance()->getPlayerExact($player);
    if ($playerInstance === null) return "Plugin not found";

    if (class_exists(PiggyEconomy::class)) {
        $money = PiggyEconomy::getInstance()->getMoney($playerInstance);
        return $money !== null ? (string)$money : "0";
    }

    return "Plugin not found";
});
