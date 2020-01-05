<?php

namespace ree\color;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
    public const NOTICE = "§a>> §r";

    private const NBT = "color_chat_nbt";

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getCommandMap()->register('colorchat', new ColorChatCommand());
        $this->getLogger()->info(self::NOTICE . '読み込みました');
        parent::onEnable();
    }

    /**
     * @param PlayerChatEvent $ev
     *
     * @priority HIGHEST
     */
    public function onChat(PlayerChatEvent $ev)
    {
        $p = $ev->getPlayer();
        $ev->setMessage("§" . $this->getColor($p) . $ev->getMessage());
    }

    /**
     * @param Player $p
     * @return string
     */
    private function getColor(Player $p): string
    {
        $nbt = $p->namedtag;

        if ($nbt->offsetExists(self::NBT)) {
            $color = $nbt->getInt(self::NBT);
        } else {
            $color = 'r';
        }

        return $color;
    }

    /**
     * @param Player $p
     * @param int $color
     */
    public static function setColor(Player $p, int $color): void
    {
        $nbt = $p->namedtag;

        $nbt->setInt(self::NBT, $color);
    }

    public function onDisable()
    {
        parent::onDisable();
    }
}
