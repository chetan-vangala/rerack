<?php

class Team extends Model{

  function after_create() {
    $this->manageQueue(0);
  }
  
  function manageQueue($w){
    $tab = new Table();
    $h = new House();
    $playing = count($this->find(array('queued=0', "house_id=$this->house_id")));
    $house = $h->find(array("id=$this->house_id"));
    return $tab->tableUpdate($this, $house[0], $playing, $w);
  }
  
  function win(){
    $this->manageQueue(1);
  }
  
  function highScore($house){
    if($this->wins > $house->tt_wins){
      $house->tt_name = $this->name;
      $house->tt_wins = $this->wins;
      $house->update();
    }
  }
  
  function notify($h){
    $ApiVersion = "2010-04-01";
    $AccountSid = "ACb421c4f6d7aa53a5f87cc9d11e51aaa0";
    $AuthToken = "720ff345fca3ac9ae8422c9272568b89";
    $client = new TwilioRestClient($AccountSid, $AuthToken);
    if(strlen($this->number) == 10){
      $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages", 
          "POST", array(
          "To" => $this->number,
          "From" => '415-599-2671',
          "Body" => "Grab some beer and get to the table at $h->name. You're up!"
      ));
    }
  }
}
?>