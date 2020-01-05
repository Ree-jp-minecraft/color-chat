<?php


namespace ree\color;


use pocketmine\form\Form;
use pocketmine\Player;

class ColorChatForm implements Form
{
    public const LIST = array(
        "1",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
        "a",
        "b",
        "c",
        "d",
        "e",
        "f",
        "k",
        "l",
        "m",
        "n",
        "o",
        "r"
    );

    private const COLORLIST = array(
        "§1Dark Blue",
        "§2Dark Green",
        "§3Dark Aqua",
        "§4Dark Red",
        "§5Dark Purple",
        "§6Gold",
        "§7Gray",
        "§8Dark Gray",
        "§9Blue",
        "§aGreen",
        "§bAqua",
        "§cRed",
        "§dLight Purple",
        "§eYellow",
        "§fWhite",
        "§kObfuscated",
        "§lBold",
        "§mStrikethrough",
        "§nUnderline",
        "§oItalic",
        "§rReset"
    );

    public function jsonSerialize()
    {
        return [
            'type' => 'custom_form',
            'title' => 'Color_Chat',
            'content' => [
                [
                    "type" => "label",
                    "text" => "チャットを送信する時のデフォルトの色を変更できます",
                ],
                [
                    "type" => "dropdown",
                    "text" => "",
                    "options" => self::COLORLIST,
                ],
            ]
        ];
    }

    public function handleResponse(Player $player, $data): void
    {
        if ($data === NULL) {
            return;
        }
        if (isset ($data[1])) {
            Main::setColor($player ,$data[1]);
            $player->sendMessage(Main::NOTICE.'変更しました');
        }
    }
}