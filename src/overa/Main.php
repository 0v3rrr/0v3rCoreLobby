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
	
	$this->getServer()->getPluginManager()->registerEvents($this , $this);
}


	
public function onDrop(PlayerDropItemEvent $event)
{
     $event->setCancelled(true);
     $event->getPlayer()->sendMessage("Vous ne pouvez pas drop d'item");
}

public function onJoinPlayer(PlayerJoinEvent $event){

   $player = $event->getPlayer();	
   $name = $event->getPlayer()->getName();
   $player->getInventory()->clearAll();

   $event->setJoinMessage("§6[§r+§6] $name");

   $player->getInventory()->setItem(0, Item::get(369)->setCustomName("§r§aProfile"));
   $player->getInventory()->setItem(2, Item::get(341)->setCustomName("§r§eLobby"));
   $player->getInventory()->setItem(4, Item::get(345)->setCustomName("§r§6Compass"));
   $player->getInventory()->setItem(8, Item::get(130)->setCustomName("§r§5Features"));
   $player->getInventory()->setItem(6, Item::get(399)->setCustomName("§r§aInfo"));
   $player->getInventory()->setItem(1, Item::get(160)->setCustomName(" "));
   $player->getInventory()->setItem(3, Item::get(160)->setCustomName(" "));
   $player->getInventory()->setItem(5, Item::get(160)->setCustomName(" "));
   $player->getInventory()->setItem(7, Item::get(160)->setCustomName(" "));

}


}

