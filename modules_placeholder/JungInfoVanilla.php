<?php

declare(strict_types=1);

use pocketmine\Server;
use pocketmine\player\Player;
use venndev\vplaceholder\VPlaceHolder;

$version = "1.0.0";
$author = "junggamyeon";

# {time_zone}
# {second}
# {minute}
# {hour}
# {day}
# {month}
# {year}
# {world_name}
# {health}
# {hunger}
# {id_item}
# {dame_item}
# {duration_item}
# {x}
# {y}
# {z}

# API Key:
# - Create account ipgeolocation.io
# - Copy your api key
const API_KEY = "YOUR_API_KEY"; # Replace API KEY here

function getTimeZoneFromIP(string $ip): string {
    $url = "https://api.ipgeolocation.io/ipgeo?apiKey=" . API_KEY . "&ip=" . $ip;
    $response = @file_get_contents($url);
    
    if ($response === false) return "Timezone not found";

    $data = json_decode($response, true);
    return $data['time_zone'] ?? "Timezone not found";
}

function getTimeForPlayer(string $playerName, string $format): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";

    $ip = $playerInstance->getAddress();
    $timezone = getTimeZoneFromIP($ip);

    $dateTime = new DateTime("now", new DateTimeZone($timezone));
    return $dateTime->format($format);
}

VPlaceHolder::registerPlaceHolder("{time_zone}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";

    $ip = $playerInstance->getAddress();
    return getTimeZoneFromIP($ip);
});

VPlaceHolder::registerPlaceHolder("{second}", function (string $playerName): string {
    return getTimeForPlayer($playerName, "s");
});

VPlaceHolder::registerPlaceHolder("{minute}", function (string $playerName): string {
    return getTimeForPlayer($playerName, "i");
});

VPlaceHolder::registerPlaceHolder("{hour}", function (string $playerName): string {
    return getTimeForPlayer($playerName, "H");
});

VPlaceHolder::registerPlaceHolder("{day}", function (string $playerName): string {
    return getTimeForPlayer($playerName, "d");
});

VPlaceHolder::registerPlaceHolder("{month}", function (string $playerName): string {
    return getTimeForPlayer($playerName, "m");
});

VPlaceHolder::registerPlaceHolder("{year}", function (string $playerName): string {
    return getTimeForPlayer($playerName, "Y");
});

VPlaceHolder::registerPlaceHolder("{world_name}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    return $playerInstance->getWorld()->getFolderName();
});

VPlaceHolder::registerPlaceHolder("{health}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    return (string)$playerInstance->getHealth();
});

VPlaceHolder::registerPlaceHolder("{hunger}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    return (string)$playerInstance->getHungerManager()->getFood();
});

VPlaceHolder::registerPlaceHolder("{id_item}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    $item = $playerInstance->getInventory()->getItemInHand();
    return (string)$item->getId();
});

VPlaceHolder::registerPlaceHolder("{dame_item}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    $item = $playerInstance->getInventory()->getItemInHand();
    return (string)$item->getDamage();
});

VPlaceHolder::registerPlaceHolder("{duration_item}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    $item = $playerInstance->getInventory()->getItemInHand();
    return (string)$item->getMaxDurability();
});

VPlaceHolder::registerPlaceHolder("{x}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    return (string)$playerInstance->getPosition()->getX();
});

VPlaceHolder::registerPlaceHolder("{y}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    return (string)$playerInstance->getPosition()->getY();
});

VPlaceHolder::registerPlaceHolder("{z}", function (string $playerName): string {
    $playerInstance = Server::getInstance()->getPlayerExact($playerName);
    if ($playerInstance === null) return "Player not found";
    
    return (string)$playerInstance->getPosition()->getZ();
});
