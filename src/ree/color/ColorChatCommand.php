<?php


namespace ree\color;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class ColorChatCommand extends Command
{
    public function __construct()
    {
        parent::__construct('colorchat', 'change message color', '/colorchat');
        $this->setPermission("command.colorchat");
        $this->setPermissionMessage('§cSet permissions from \'plugin.yml\' to \'true\' to allow use without permissions');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) {
            return;
        }
        if (!$sender instanceof Player)
        {
            $sender->sendMessage(Main::NOTICE.'使用出来ません');
            return;
        }
        $sender->sendForm(new ColorChatForm());
    }
}