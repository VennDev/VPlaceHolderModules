<?php

use pocketmine\Server;
use venndev\vplaceholder\VPlaceHolder;

use _64FF00\PurePerms\PurePerms;
use IvanCraft623\RankSystem\RankSystem;
use IvanCraft623\RankSystem\utils\Utils;

#Author Modules: ClickedTran | ClickedTran_VN

#{pprank} = PurePerms
#{rsrank} = Ranksystem

VPlaceHolder::registerPlaceHolder("{pprank}", function(string $player) : string{
  $playerName = Server::getInstance()->getPlayerExtract($player);
  if(is_null($playerName)) return "none";
  
  if(Server::getInstance()->getPluginManager()->getPlugin("PurePerms") !== null){
    $pprank = PurePerms::getInstance()->getUserDataMgr()->getGroup($player);
    return $pprank["group"];
  }
  
  return "none";
});

VPlaceHolder::registerPlaceHolder("{rsrank}", function(string $player) : string {
  $playerName = Server::getInstance()->getPlayerExtract($player);
  
  if(is_null($playerName)) return "none";
  
  if(Server::getInstance()->getPluginManager()->getPlugin("RankSystem") !== null){
    $rsrank = RankSystem::getInstance()->getSessionManager()->get($playerName);
    return Utils::ranks2string($rsrank->getRanks());
  }
  
  return "none";
});
