<?php

use pocketmine\Server;
use venndev\vplaceholder\VPlaceHolder;

use _64FF00\PurePerms\PurePerms;
use IvanCraft623\RankSystem\RankSystem;
use IvanCraft623\RankSystem\utils\Utils;

$version = "1.0.0";
$author = "ClickedTran(ClickedTran_VN)";

#{pprank} = PurePerms
#{rsrank} = Ranksystem

VPlaceHolder::registerPlaceHolder("{pprank}", function(string $playerName) : string{
  $player = Server::getInstance()->getPlayerExtract($playerName);
  if(is_null($player)) return "none";
  
  if(Server::getInstance()->getPluginManager()->getPlugin("PurePerms") !== null){
    $pprank = PurePerms::getInstance()->getUserDataMgr()->getGroup($playerName);
    return $pprank["group"];
  }
  
  return "none";
});

VPlaceHolder::registerPlaceHolder("{rsrank}", function(string $playerName) : string {
  $player = Server::getInstance()->getPlayerExtract($playerName);
  
  if(is_null($player)) return "none";
  
  if(Server::getInstance()->getPluginManager()->getPlugin("RankSystem") !== null){
    $rsrank = RankSystem::getInstance()->getSessionManager()->get($player);
    return Utils::ranks2string($rsrank->getRanks());
  }
  
  return "none";
});
