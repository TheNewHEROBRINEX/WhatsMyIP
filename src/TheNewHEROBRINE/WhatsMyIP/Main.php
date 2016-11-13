<?php

namespace TheNewHEROBRINE\WhatsMyIP;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\TranslationContainer;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {
    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        switch (count($args)) {
            case 0:
                if ($sender instanceof Player) {
                    if ($sender->hasPermission("whatsmyip.command.getip.self")) {
                        $sender->sendMessage("Il tuo ip è " . TextFormat::AQUA . $sender->getAddress());
                        return true;
                    } else {
                        $sender->sendMessage(new TranslationContainer(TextFormat::RED . "%commands.generic.permission"));
                        return true;
                    }
                } else {
                    return false;
                }
                break;
            case 1:
                if ($sender->hasPermission("whatsmyip.command.getip.other")) {
                    if (($target = $this->getServer()->getPlayer($args[0])) instanceof Player) {
                        $sender->sendMessage("L'ip di " . TextFormat::DARK_AQUA . $target->getName() . " è " . TextFormat::AQUA . $target->getAddress());
                        return true;
                    } else {
                        $sender->sendMessage(new TranslationContainer(TextFormat::RED . "%commands.generic.player.notFound"));
                        return true;
                    }
                } else {
                    $sender->sendMessage(new TranslationContainer(TextFormat::RED . "%commands.generic.permission"));
                    return true;
                }
                break;
            default:
                return false;
                break;
        }
    }
}