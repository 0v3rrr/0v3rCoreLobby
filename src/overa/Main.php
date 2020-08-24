<?php 

namespace overa;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\scheduler\Task;


use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use jojoe77777\FormAPI;

use pocketmine\item\Item;

use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\level\sound\AnvilFallSound;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\AnvilUseSound;

use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;

class Main extends PluginBase implements Listener{


public function onEnable(){
	$this->getLogger()->info(" LOBBY CORE ACTIVE");
	
	$this->getServer()->getPluginManager()->registerEvents($this , $this);
}


	
public function onDrop(PlayerDropItemEvent $event)
{
     $event->setCancelled(true);
     $event->getPlayer()->sendMessage("§cVous ne pouvez pas drop d'item");
}

public function onJoinPlayer(PlayerJoinEvent $event){

   $player = $event->getPlayer();	
   $name = $event->getPlayer()->getName();
   $player->getInventory()->clearAll();
   $player->getArmorInventory()->clearAll();

   $event->setJoinMessage("§7[§6+§7]§6 $name");
	
	$player->sendMessage("§7====================");
	$player->sendMessage("§a   §lNoctalia");
	$player->sendMessage("§f Code by 0v3r");
	$player->sendMessage("§7====================");
	
	$player->addTitle("§aBienvenu(e) sur");
	$player->addSubTitle("§c Noctalia");
	

   $player->getInventory()->setItem(0, Item::get(369)->setCustomName("§r§aProfile"));
   $player->getInventory()->setItem(2, Item::get(341)->setCustomName("§r§eLobby"));
   $player->getInventory()->setItem(4, Item::get(345)->setCustomName("§r§6Compass"));
   $player->getInventory()->setItem(8, Item::get(130)->setCustomName("§r§5Features"));
   $player->getInventory()->setItem(6, Item::get(399)->setCustomName("§r§aInfo"));
   $player->getInventory()->setItem(1, Item::get(160)->setCustomName(" "));
   $player->getInventory()->setItem(3, Item::get(160)->setCustomName(" "));
   $player->getInventory()->setItem(5, Item::get(160)->setCustomName(" "));
   $player->getInventory()->setItem(7, Item::get(160)->setCustomName(" "));
	
   $player->setXpLevel("2020");
   $player->setFood("20");
   $player->setMaxHealth("20");
   $player->setHealth("20");
   $player->setGamemode(2);
   $player->getlevel()->addSound(new AnvilUseSound($player));

}
	
public function onQuitPlayer(PlayerQuitEvent $event){
	$player = $event->getPlayer();
	$name = $event->getPlayer()->getName();
	$event->setQuitMessage("§6[§f-§6] $name");
     


}
	
public function Hunger(PlayerExhaustEvent $event){

        $event->setCancelled(true);
    }
	
	
public function onFallDamage(EntityDamageEvent $event){

        $event->setCancelled(true);

    }

    public function onPlayerDamage(EntityDamageEvent $event){

        $event->setCancelled(true);
    }


public function onInteract(PlayerInteractEvent $ev){



}
	
}

