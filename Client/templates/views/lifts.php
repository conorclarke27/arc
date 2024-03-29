
<div class="row">
    <?php if($locals['schedDriver'] == NULL && $locals['schedPassenger']== NULL ) {?>
        <div class="col-sm-4">
            <div class = "card">
                <div class="card-body">

                    <h3 class="card-title">Sorry</h3>
                    <p>
                        No Lifts scheduled yet

                    </p>
                </div>
            </div>
        </div>
    
    <?php } 
    else 
    { foreach ($locals['schedDriver'] as $driverLifts) { ?>

        <div class="col-sm-4">
            <div class = "card">
                <div class="card-body">

                    <h3 class="card-title">Passenger: <?= $driverLifts['name']; ?></h3>
                    <p>Day: <?= $driverLifts['day']; ?></p>
                    <p>Arriving: <?= $driverLifts['morning']; ?></p>
                    <p>Leaving: <?= $driverLifts['evening']; ?></p>
                    <div class="btn btn-danger">
                        <a href="/arc/Client/removeSched?car_id=<?= $driverLifts['car_id'] ?> &user_id=<?= $driverLifts['user_id']; ?>">Remove lift</a>
                    </div>

                </div>
            </div>
        </div>
            <?php } 
            foreach ($locals['schedPassenger'] as $passengerLifts) { ?>
         <div class="col-sm-4">
            <div class = "card">
                <div class="card-body">
                    <h3>Driver:  <?= $passengerLifts['name']; ?></h3>
                    <p>Day:      <?= $passengerLifts['day']; ?></p>
                    <p>Arriving: <?= $passengerLifts['morning']; ?></p>
                    <p>Leaving:  <?= $passengerLifts['evening']; ?></p>
                    <p>Car make: <?= $passengerLifts['make']; ?></p>
                    <p>Colour:   <?= $passengerLifts['colour']; ?></p>
                    <p>Est Payment per day:     €<?= $passengerLifts['estimated_pay']; ?></p>
                    <div class="btn btn-danger">
                        <a href="/arc/Client/removeSched?car_id=<?= $passengerLifts['car_id'] ?> &user_id=<?= $passengerLifts['user_id']; ?>">Remove lift</a>
                    </div>

                </div>
            </div>
        </div>
                <?php } 
                }?>
            </div>