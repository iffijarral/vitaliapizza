<?php
    $timeObject = new DateTime('Europe/Copenhagen');
    $timestamp = $timeObject->getTimeStamp();
    $currentTime = $timeObject->setTimestamp($timestamp)->format('Y-m-d H:i');
?>
<main class="container content">
    <div class="row justify-content-center">
        <div class="col-70">
            <div class="alert alert-success text-center p-4">
                <h5>Tak for bestilling<i class="fa fa-heart fa-lg" style="padding-left: 1rem; color:red !important;" aria-hidden="true"></i></h5>
                <p class="pt-4">Din transaction id er: <?php echo $response['tid']; ?></p>
                <p class="p">Betalt beløb: <?php echo ($response['amount']/100).' DKK'; ?></p>
                <p class="p">Dato: <?php echo $currentTime; ?></p>
            </div>
        </div>
        <div class="col-30">
            <?= $this->load->view('cart', null, TRUE); ?>
        </div>
    </div>
</main>