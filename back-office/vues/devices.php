<link rel="stylesheet" href="/back-office/css/devices.css">
<script src="https://kit.fontawesome.com/0f6a392601.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>

<div class="devices-table">
    <div class="devices-table-row title">
        <div class="devices-table-col">
            Numéro produit
        </div>
        <div class="devices-table-col">
            Nom du produit
        </div>
        <div class="devices-table-col">
            Compte
        </div>
    </div>
    <?php
        foreach($devices as $device){
            $modifiable = $device['user_id'] === $_SESSION['id'] || RANK_POWER[$device['user_rank']] < RANK_POWER[$_SESSION['user_rank']];

            echo '<div class="devices-table-row">
            <div class="devices-table-col">
                <p class="hint">Numéro produit: </p><p>'. $device['product_number'] .'</p>
            </div>
            <div class="devices-table-col">
                <p class="hint">Nom du produit: </p><p>'. $device['name'] .'</p>' . ($modifiable ? ' <i data-type="name" product-number="'. $device['product_number'] .'" class="modify-pen fa-solid fa-pen"></i>' : ''). '
            </div>
            <div class="devices-table-col">
                <p class="hint">Compte: </p><p>'. $device['firstname'] . ' ' . $device['lastname'] .'</p>' . '
            </div>
        </div>';
        }
    ?>
    <div id="snackbar"></div>
    <script src="/back-office/js/modify_device.js"></script>
</div>