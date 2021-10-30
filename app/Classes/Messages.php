<?php
namespace App\Classes;

class Messages
{
    public static function getDefaultMessages(){
        return [
            "default_start_text" => "Начал готовить ваш заказ. Как только он будет готов, мы напишем.",
            "default_ready_text" => "Ваш заказ готов! Можете подходить и забирать. Приятного аппетита.",
            "default_ready_repeat_text" => "На всякий случай напоминаем: ваш заказ готов и ждет вас.",
            "default_call_text" => "Просим Вас подойти к кассе для уточнения вопросов по вашему заказу."
        ];
    }
    
}
