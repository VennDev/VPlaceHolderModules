<?php

declare(strict_types=1);

use pocketmine\Server;
use venndev\vplaceholder\VPlaceHolder;
use vennv\vapm\Async;
use vennv\vapm\FiberManager;

$version = "1.0.0";
$author = "VennDev";

VPlaceHolder::registerPlaceHolder("{player_inventory_contents}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "Can't find player";
    $contents = [];
    foreach ($player->getInventory()->getContents() as $slot => $item) {
        $contents[$slot] = $item->jsonSerialize();
    }
    return json_encode($contents);
});

VPlaceHolder::registerPlaceHolder("{player_inventory_contents_async}", function (string $player): Async {
    return new Async(function () use ($player): string {
        $player = Server::getInstance()->getPlayerExact($player);
        if ($player === null) return "Can't find player";
        $contents = [];
        foreach ($player->getInventory()->getContents() as $slot => $item) {
            FiberManager::wait();
            $contents[$slot] = $item->jsonSerialize();
        }
        return json_encode($contents);
    });
});

VPlaceHolder::registerPlaceHolder("{item_in_hand_name}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "Can't find player";
    return $player->getInventory()->getItemInHand()->getName();
});

VPlaceHolder::registerPlaceHolder("{item_in_hand_custom_name}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "Can't find player";
    return $player->getInventory()->getItemInHand()->getCustomName();
});

VPlaceHolder::registerPlaceHolder("{item_in_hand_count}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "Can't find player";
    return (string)$player->getInventory()->getItemInHand()->getCount();
});

VPlaceHolder::registerPlaceHolder("{item_in_hand_type_id}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "Can't find player";
    return (string)$player->getInventory()->getItemInHand()->getTypeId();
});

VPlaceHolder::registerPlaceHolder("{item_in_hand_can_destroy}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "Can't find player";
    return implode(", ", $player->getInventory()->getItemInHand()->getCanDestroy());
});

VPlaceHolder::registerPlaceHolder("{item_in_hand_can_place_on}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "Can't find player";
    return implode(", ", $player->getInventory()->getItemInHand()->getCanPlaceOn());
});

VPlaceHolder::registerPlaceHolder("{item_in_hand_lore}", function (string $player): string {
    $player = Server::getInstance()->getPlayerExact($player);
    if ($player === null) return "Can't find player";
    return implode(", ", $player->getInventory()->getItemInHand()->getLore());
});