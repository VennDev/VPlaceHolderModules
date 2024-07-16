<?php

use pocketmine\Server;
use venndev\vplaceholder\VPlaceHolder;

use _64FF00\PurePerms\PurePerms;
use IvanCraft623\RankSystem\RankSystem;
use IvanCraft623\RankSystem\utils\Utils;

$version = "1.0.0";
$author = "ClickedTran (ClickedTran_VN)";

#{pprank} = PurePerms
#{rsrank} = Ranksystem

VPlaceHolder::registerPlaceHolder("{pprank}", function(string $playerName) : string{
  $player = Server::getInstance()->getPlayerExact($playerName);
  if($player == null) return "User Not Found!";
  
  if(class_exists(PurePerms::class)){
    $pprank = PurePerms::getInstance()->getUserDataMgr()->getData($player);
    return $pprank["group"];
  }
  
  return "User Not Found!";
});

VPlaceHolder::registerPlaceHolder("{rsrank}", function(string $playerName) : string {
  $player = Server::getInstance()->getPlayerExact($playerName);
  
  if($player == null) return "User Not Found!";
  
  if(class_exists(RankSystem::class)){
    $rsrank = RankSystem::getInstance()->getSessionManager()->get($player);
    return Utils::ranks2string($rsrank->getRanks());
  }
  
  return "User Not Found!";
});
