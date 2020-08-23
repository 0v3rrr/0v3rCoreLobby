<?php 

namespace overa;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\item\Item;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{


public function onEnable(){
	$this->getLogger()->info(" LOBBY CORE ACTIVE");
}

public function onJoin(PlayerJoinEvent $event){

	$player = $event->getPlayer();
	
	$slot1 = Item::get(360, 0, 1);
	$slot9 = Item::get(152, 0, 1);
	$slot1->setCustomName("§aGame Selector");
	$slot9->setCustomName("§6Profile");
	$player->getInventory()->clearAll();
	$player->getInventory()->setItem(0, $slot1);
	$player->getInventory()->setItem(8, $slot9);
	
}

public function onInteract(PlayerInteractEvent $event){

	$player = $event->getPlayer();
	$item = $event->getItem();
	$itemname = $player->getInventory()->getItemInHand()->getName();
	
	if($item->getId() == 360 || $itemname == "§aGame Selector"){
		$player->sendMessage("§eNo Game Only for the moments");
		return true;
	}
	
	if($item->getId() == 152 || $itemname == "§6Profile"){
		$player->sendMessage("§eNo Profile On For the moment");
		return true;
	}
	
}

}
