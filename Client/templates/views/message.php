<style>
  p {
    margin: 0;
    padding: 0;
  }


  p:nth-child(even) {
    background: #F8F8FF
  }

  p:nth-child(odd) {
    background: #E6E6FA
  }

  input {
    font: 12px arial;
    margin: 8px 8px;
  }

  #group_id {
    background: #B0C4DE;
    color: #fff;
    padding: 10px 8px;
    border: 1px solid;
    border-radius: 5px;
    text-shadow: none;
  }

  #group_id:hover {
    background: #016ABC;
    color: #fff;
    border: 1px solid;
    border-radius: 6px;
    text-shadow: none;
  }

  a {
    color: #0000FF;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }

  #wrapper,
  #loginform {
    margin: 0 auto;
    padding: 0px 25px 25px 25px;
    background: #FFF;
    /* width:504px; */
    /* border:1px solid #ACD8F0;  */
  }

  #chatbox {
    text-align: left;
    margin: 5px 5px;
    margin-bottom: 25px;
    /* padding:10px; */
    background: #fff;
    /* height:400px;
    width:430px; */
    border: 1px solid #ACD8F0;
    overflow-y: scroll;
    max-height: 400px;
  }

  #message {
    /* width: 370px; */
    font: 12px Helvetica;
    width: 90%;
    padding: 12px 20px;
    margin: 10px 10px;
    background: #F5FFFA;
    color: black;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  #top {
    padding: 12.5px 25px 12.5px 25px;
  }
</style>

<div class="container">
  <h3 style="margin:0; padding:0;">Messages</h3>
  <div id="wrapper">
    <div id="top"></div>
    <?php
    $passenger_id;
    foreach ($locals['users'] as $user) {
      if($user['user_id'] !== $_SESSION['Id'])
      $passenger_id = $user['user_id'];
      ?>
      <p><?= $user['name'] ?></p>
    <?php } ?>
    <div id="chatbox">
      <?php $group_id = $locals['group_id'];
      foreach ($locals['messages'] as $message) {
        if (strtotime($message['time_sent']) <= time() - (60 * 60 * 24)) {
          $regEx = '/(\d{4})-(\d{2})-(\d{2}) /';
          preg_match($regEx, $message['time_sent'], $result);
        } else {
          $regEx = '/(\d{2}):(\d{2})/';
          preg_match($regEx, $message['time_sent'], $result);
        } ?>
        <p>
          <i style="font-weight:bold; color:black;"><?= $message['name']; ?>: </i>
          <br>
          <?= $message['message']; ?>
          <?php if ($_SESSION['Id'] === $message['from_id']) { ?>
            <a href="/arc/Client/removeMessage?message_id= <?= $message['message_id'] ?> &to_id= <?= $message['to_id']; ?>">Delete</a>
          <?php } ?>
          <br>
          <i style="color: #B0C4DE">(<?= $result[0]; ?>)</i>
        </p>
      <?php } ?>
    </div>
    <form id='login_form' action='' method='post'>
      <input type="text" name='message' id='message' placeholder="Enter message here...">
      <input type="submit" value='Submit'>
    </form action="" method="post">
    <div>
      <?php $isDriver = $locals['isDriver'];
      if ($isDriver['user_type'] === "D") { ?>
        <h3>Organise a lift</h3>
        <form action="createLift" method="post">
          <select name="day" class="form">
            <option value="" selected="true" disabled="disabled">Day</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
          </select>
          <select name="morning" class="form">
            <option value="" selected="true" disabled="disabled">Morning</option>
            <option value="8:00">8:00</option>
            <option value="9:00">9:00</option>
            <option value="10:00">10:00</option>
            <option value="11:00">11:00</option>
            <option value="12:00">12:00</option>
            <option value="13:00">13:00</option>
            <option value="14:00">14:00</option>
            <option value="15:00">15:00</option>
            <option value="16:00">16:00</option>
          </select>
          <select name="evening" class="form">
            <option value="" selected="true" disabled="disabled">Evening</option>
            <option value="10:00">10:00</option>
            <option value="11:00">11:00</option>
            <option value="12:00">12:00</option>
            <option value="13:00">13:00</option>
            <option value="14:00">14:00</option>
            <option value="15:00">15:00</option>
            <option value="16:00">16:00</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
            <option value="21:00">21:00</option>
          </select>
          <input type="hidden" name="driver_id" value="<?= $_SESSION['Id']; ?>">
          <input type="hidden" name="passenger_id" value="<?= $passenger_id; ?>">
          <input type="submit" value="Submit" class="btn btn-dark btn-xs">
        </form>
      <?php }  ?>
    </div>
  </div>
</div>