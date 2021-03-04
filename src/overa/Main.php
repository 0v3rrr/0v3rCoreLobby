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

   $event->setJoinMessage("§7[§a+§7]§a$name");
	
	$player->sendMessage("§7====================");
	$player->sendMessage("§a  §l Noctalia");
	$player->sendMessage("§f Code by 0v3r");
	$player->sendMessage("§7====================");
	
	$player->addTitle("§aBienvenu(e) sur");
	$player->addSubTitle("§c Noctalia");
	

   $player->getInventory()->setItem(0, Item::get(381)->setCustomName("§r§aProfile §r§7[use]"));
   $player->getInventory()->setItem(2, Item::get(341)->setCustomName("§r§dGadgets §7[use]"));
   $player->getInventory()->setItem(4, Item::get(345)->setCustomName("§r§6Compass §7[use]"));
   $player->getInventory()->setItem(8, Item::get(130)->setCustomName("§r§5Cosmetics §7[use]"));
   $player->getInventory()->setItem(6, Item::get(399)->setCustomName("§r§aParticules §7[use]"));
	
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
        $event->setQuitMessage("§7[§c-§7]§c$name");


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

	
        $player = $ev->getPlayer();
        $item = $ev->getItem();
	
	if ($player->getInventory()->getItemInHand()->getId() === 130){
		
		$this->form($player);
	
	}
	
	if ($player->getInventory()->getItemInHand()->getId() === 381){
		
		$this->Profile($player);
	
	}
	
	if ($player->getInventory()->getItemInHand()->getId() === 341){
		
		
		$player->getInventory()->clearAll();
		$player->getInventory()->setItem(0, Item::get(288)->setCustomName("§r§bBird Knockback"));
		$player->getInventory()->setItem(1, Item::get(46)->setCustomName("§r§6Coming Soon"));
		$player->getInventory()->setItem(8, Item::get(401)->setCustomName("§r§cRetour"));
		
	}
	
	if ($player->getInventory()->getItemInHand()->getId() === 401){
		
		$player->getInventory()->clearAll();
		$player->getInventory()->setItem(0, Item::get(381)->setCustomName("§r§aProfile"));
   $player->getInventory()->setItem(2, Item::get(341)->setCustomName("§r§dGadgets"));
   $player->getInventory()->setItem(4, Item::get(345)->setCustomName("§r§6Compass"));
   $player->getInventory()->setItem(8, Item::get(130)->setCustomName("§r§5Cosmetics"));
   $player->getInventory()->setItem(6, Item::get(399)->setCustomName("§r§aParticules"));
	}

	if ($player->getInventory()->getItemInHand()->getId() === 288){
		$x = $player->getX();
		$y = $player->getY();
		$z = $player->getZ();
		$level = $player->getLevel();
			$direction = $player->getDirectionVector();
			$dx = $direction->getX();
			$dz = $direction->getZ();		
				$level->addParticle(new FlameParticle($player));
				$level->addParticle(new FlameParticle(new Vector3($x-0.3, $y, $z)));
				$level->addParticle(new FlameParticle(new Vector3($x, $y, $z-0.3)));
				$level->addParticle(new FlameParticle(new Vector3($x+0.3, $y, $z)));
				$level->addParticle(new FlameParticle(new Vector3($x, $y, $z+0.3)));			
			$player->knockBack($player, 0, $dx, $dz, 1);
		}
	
	
		if ($player->getInventory()->getItemInHand()->getId() === 46){
			$player->sendMessage(" ==============");
			$player->sendMessage("||  §cCOMING §r||");
			$player->sendMessage("||§e SOON    §r ||");
			$player->sendMessage(" ==============");
        }	

}
	


    public function form($player){

        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	$form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data; 
            if ($result === null) {
                return true;
            }
            switch ($result) {
		    
		    case 0:
                        $this->Fly($player);
                    break;
           
		    case 1:
                        $this->Size($player);
                    break;	    
                
		    case 2:
                        $this->Speed($player);
                    break;
	
		    case 3:
			   $player->sendMessage("§7Le Menu des Tags §l§6Arrive Bientot"); 
		    break;
			   
            }
        });
        $form->setTitle("§r§5Cosmetics");
        $form->addButton("§l§6Fly",0,"textures/items/elytra");
        $form->addButton("§l§2Size",0,"textures/items/totem");
        $form->addButton("§l§dSpeed",0,"textures/items/potion_bottle_splash_moveSpeed");
	$form->addButton("§l§7[§aTAG§7]",0,"textures/items/name_tag");
	$form->addButton("§4§lEXIT",0,"textures/blocks/barrier");
        $form->sendToPlayer($player);
	    return $form;

    }
	
public function Fly($player){

        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	$form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data; 
            if ($result === null) {
                return true;
            }
            switch ($result) {
		    
		    case 0:
                        $player->setAllowFlight(true);
			    $player->sendMessage("§7Vous avez §l§aActivé §r§7votre Fly");
                    break;
		       
		    case 1:
                        $player->setAllowFlight(false);
			$player->setFlying(false);
			    $player->sendMessage("§7Vous avez §l§cDésactivé §r§7votre Fly");
                    break;	    
                
            }
        });
        $form->setTitle("§r§5Cosmetics Fly");
        $form->addButton("§l§aFly ON");
        $form->addButton("§l§cFly OFF");
	$form->addButton("§4§lEXIT",0,"textures/blocks/barrier");
        $form->sendToPlayer($player);
	    return $form;

    }
	
	
public function Size($player){

        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	$form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data; 
            if ($result === null) {
                return true;
            }
            switch ($result) {
		    
		    case 0:
                        $player->setScale(2.0);
			$player->sendMessage("§7Vous etes maintenant de §6§lGrande §r§7 Taille");
                    break;
		       
		    case 1:
                        $player->setScale(1.0);
			$player->sendMessage("§7Vous etes maintenant de §6§lMoyenne §r§7Taille");
                    break;
			    
		    case 2:
			$player->setScale(0.5);
			$player->sendMessage("§7Vous etes maintenant de §l§6Petite §r§7Taille");
	            break;
                
            }
        });
        $form->setTitle("§r§5Cosmetics Size");
        $form->addButton("§l§c Grande Taille");
        $form->addButton("§l§6Moyenne Taille");
	$form->addButton("§a§lPetite Taille");
	$form->addButton("§4§lEXIT",0,"textures/blocks/barrier");
        $form->sendToPlayer($player);
	    return $form;


}
	

	
public function Speed($player){

        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	$form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data; 
            if ($result === null) {
                return true;
            }
            switch ($result) {
		    
		    case 0:
                            $effect = new EffectInstance(Effect::getEffect(1), 999999999, 3, false);
			    $player->addEffect($effect);
			    $player->sendMessage("§7Vous avez §l§a Activé §r§7 votre speed");
                    break;
		       
		    case 1:
                            $player->removeAllEffects();
			    $player->sendMessage("§7Vous avez §l§c Désactivé §r§7 votre speed");
                    break;	    
                
            }
        });
        $form->setTitle("§r§5Cosmetics Speed");
        $form->addButton("§l§aSpeed ON");
        $form->addButton("§l§cSpeed OFF");
	$form->addButton("§4§lEXIT",0,"textures/blocks/barrier");
        $form->sendToPlayer($player);
	    return $form;

    }

public function Profile($player){

        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	$form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data; 
            if ($result === null) {
                return true;
            }
            switch ($result) {
		    
		    case 0:
                        $player->sendMessage("Réponse 1");
                    break;
           
		    case 1:
                        $player->sendMessage("Réponse 2");
                    break;	    
                
		    case 2:
                        $player->sendMessage("Réponse 3");
                    break;
            }
        });
        $form->setTitle("§r§5Profile");
        $form->addButton("§l§6In Dev 1");
        $form->addButton("§l§2In Dev 2");
        $form->addButton("§l§dIn Dev 3");
	$form->addButton("§4§lEXIT",0,"textures/blocks/barrier");
        $form->sendToPlayer($player);
	    return $form;

    }	
	
	
	
	
}
