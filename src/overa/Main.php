<?php 

namespace overa;

use pocketmine\Player;
use pocketmine\Server;


use pocketmine\plugin\RegisteredListener;
	
use pocketmine\scheduler\Task;
use pocketmine\scheduler\PluginTask;



use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use jojoe77777\FormAPI;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\Form;
use jojoe77777\FormAPI\ModalForm;


use pocketmine\item\Item;

use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;

use pocketmine\level\sound\AnvilFallSound;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\AnvilUseSound;

use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\level\particle\Particle;
use pocketmine\level\particle\FlameParticle;
use pocketmine\math\Vector3;

use pocketmine\plugin\MethodEventExecutor;
use pocketmine\plugin\EventExecutor;

use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;


use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ListTag;

use pocketmine\entity\PrimedTNT;
use pocketmine\event\entity\EntityExplodeEvent;

class Main extends PluginBase implements Listener{


	
public function onEnable(){
	$this->getLogger()->info("Lobby Plugin has been actived");
	
	$this->getServer()->getPluginManager()->registerEvents($this , $this);
	
}



public function onJoinPlayer(PlayerJoinEvent $event){

   $player = $event->getPlayer();	
   $name = $event->getPlayer()->getName();

   $event->setJoinMessage("§7[§a+§7]§a$name");
	
	$player->sendMessage("§7====================");
	$player->sendMessage("§a  §l Noctalia");
	$player->sendMessage("§f Code by 0v3r");
	$player->sendMessage("§7====================");
	
	$player->addTitle("§aBienvenu(e) sur");
	$player->addSubTitle("§c Noctalia");

   $player->setFood("20");
   $player->setMaxHealth("20");
   $player->setHealth("20");
   $player->setGamemode(2);
   $player->getlevel()->addSound(new AnvilUseSound($player));

}
	
public function onQuitPlayer(PlayerQuitEvent $event){
	$player = $event->getPlayer();
	$name = $event->getPlayer()->getName();
        $event->setQuitMessage("§7[§c-§7]§c$name");


}
	
public function Hunger(PlayerExhaustEvent $event){

        $event->setCancelled(true);
    }
	
	
public function onFallDamage(EntityDamageEvent $event){

        $event->setCancelled(true);

    }
}
