<?php
/*
| Envia uma mensagem e uma classe do bootstrap referente à essa mensagem.
| Capture essa mensagem no Blade através do método Session::get('flash_message')['msg'] e
| a classe através do Session::get('flash_message')['class']
*/
namespace App\Libs;

class Alert{
  const ALERT_SUCCESS = 'alert-success';
  const ALERT_DANGER = 'alert-danger';

  public static function success(String $msg){
    return self::show($msg, self::ALERT_SUCCESS);
  }

  public static function danger(String $msg){
    return self::show($msg.': Tente novamente mais tarde.', self::ALERT_DANGER);
  }

  private static function show(String $msg, String $class){
    \Session::flash('flash_message', [
      'msg' => $msg,
      'class' => $class
    ]);
  }
}
