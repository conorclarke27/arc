<?php return function($req, $res) {

$req->sessionStart();
$db = \Rapid\Database::getPDO();
require('./models/User.php');
require('./models/Location.php');
$gender = $_POST["gender"] ?? NULL;
$day = $_POST["check_list"] ?? NULL;

$currentUser = User::getUserByEmail($_SESSION['Email'], $db);
$location_of_user = Location::returnLatLongById($db, $currentUser->getLocation());
if($gender != NULL && $day != NULL)
{
    $users = User::getDriversByDayAndGender($db,$day,$gender);
}
else if($gender != NULL && $day == NULL)
{
    $users = User::getDriversByGender($db, $gender);
}
else 
{
    $users = User::getDriversByDay($db,$day);
}

if ($users == NULL) { ?>
    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Unfortunately no users exist relating to your search.</h5>
                            </div>
                        </div>
                    </div>
<?php  }
else {
    foreach ($users as $user) {
        ?>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                <a href="/arc/Client/createGroup?recipient_id=<?= $user["user_id"];?>">
                    <h5 class="card-title"> <?= $user["name"]; ?>  <i class="fas fa-comment-alt"></i> </h5>
                    <h6> <?= Location::calculateDistance($db, $user["location_id"], $location_of_user[0], $location_of_user[1])[0] ?>  km away</h6>
                </a>
                </div>
            </div>
        </div>
    <?php } ?>


<?php }
} ?>
