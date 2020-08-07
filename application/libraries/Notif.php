<?php

  /**
   *
   *
   *
   *  $this->femail->send()
   */
  class Notif
  {

    // function __construct(argument)
    // {
    //   // code...
    // }

    public function email_success($dest='')
    {
      echo "<center><br>";
      echo "Sent !";
      echo "<br><br><hr><br>";
      echo "Anda akan dialihkan setelah 5 detik.<br>";
      echo "Tekan <a href='{$dest}'>disini</a> jika tidak terjadi apapun.";
      echo "</center>";
      header("Refresh: 5; URL={$dest}");
    }

    public function email_failed($dest='')
    {
      echo "<center><br>";
      echo "Failed !";
      echo "<br><br><hr><br>";
      echo "Anda akan dialihkan setelah 5 detik.<br>";
      echo "Tekan <a href='{$dest}'>disini</a> jika tidak terjadi apapun.";
      echo "</center>";
      header("Refresh: 7; URL={$dest}");
    }

  }


 ?>
