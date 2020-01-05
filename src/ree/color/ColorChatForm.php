<?php


namespace ree\color;


use pocketmine\form\Form;
use pocketmine\Player;

class ColorChatForm implements Form
{
    public function jsonSerialize()
    {
        return [
            'type' => 'custom_form',
            'title' => 'Color_Chat',
            'content' => [
                [
                    "type" => "label",
                    "text" => "チャットを送信する時のデフォルトの色を変更できます"
                ],
                [
                    "type" => "input",
                    "text" => "",
                    "placeholder" => "int",
                    "default" => ""
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
            if (!is_numeric($data[1])) {
                $player->sendMessage(Main::NOTICE . '数値を入力してください');
                return;
            }
            Main::setColor($player ,$data[1]);
            $player->sendMessage(Main::NOTICE . '変更しました');
        }
    }
}