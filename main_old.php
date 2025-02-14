<?php
$db = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';
if (!file_exists($db)) {
    die('Could Not Find Database File');
}

$db = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$db; Uid=; Pwd=;");

$sql = "SELECT * FROM TakeOut";

$result = $db->query($sql);
$counter = 0; // Counter to keep track of the number of items

$sql_released = "SELECT * FROM released_takeout";

$result_released = $db->query($sql_released);
$counter_released = 0; // Counter to keep track of the number of items

$sql_claim = "SELECT * FROM claim_takeout";

$result_claim = $db->query($sql_claim);
$counter_claim = 0; // Counter to keep track of the number of items

$sql_pickup = "SELECT * FROM pickup";

$result_pickup = $db->query($sql_pickup);
$counter_pickup = 0;
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodTaste</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        /* Set the body height to 100vh */
        overflow: hidden;
        /* Prevent scrolling */
    }

    .b {
        cursor: pointer;
        pointer-events: all !important;
    }

    .fixed-button-container {
        position: fixed;
        bottom: 20px;
        /* Adjust the bottom position as needed */
        left: 51%;
        transform: translateX(-50%);
        width: 100%;
        text-align: left;
    }

    .fixed-button-container2 {
        position: fixed;
        bottom: 20px;
        /* Adjust the bottom position as needed */
        left: 79%;
        transform: translateX(-50%);
        width: 100%;
        text-align: left;
    }

    .fixed-button-container3 {
        position: fixed;
        bottom: 20px;
        /* Adjust the bottom position as needed */
        left: 110%;
        transform: translateX(-35%);
        width: 100%;
        text-align: left;
    }

    .fixed-button-container4 {
        position: fixed;
        bottom: 20px;
        /* Adjust the bottom position as needed */
        left: 110%;
        transform: translateX(-60%);
        width: 100%;
        text-align: left;
    }

    .fixed-button {
        color: white;
        padding: 10px 40px;
        border-radius: 8px;
        cursor: pointer;
    }
</style>

<script>
    function highlightNumber(element) {
        element.classList.toggle("bg-red-700");

        // Get the child div inside the clicked element
        const childDiv = element.querySelector('.w-1/4');

        // Toggle the width class to 1/4
        childDiv.classList.toggle('w-1/4');
    }


    function releaseHighlighted() {
        const highlightedNumbers = document.querySelectorAll('.b.bg-red-700');

        // Check if there are any highlighted items
        if (highlightedNumbers.length === 0) {
            alert("Please select items to release."); // Display an alert or handle the case where no items are highlighted
            return; // Exit the function early
        }

        const highlightedIds = Array.from(highlightedNumbers).map(element => element.getAttribute('id'));

        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'post'; // Use 'post' method to send data
        form.action = 'main_released.php';

        // Create an input field for IDs
        const idsInput = document.createElement('input');
        idsInput.type = 'hidden';
        idsInput.name = 'ids';
        idsInput.value = highlightedIds.join(',');

        // Append the input field to the form
        form.appendChild(idsInput);

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }

    function releaseddeleteHighlighted() {
        const highlightedNumbers = document.querySelectorAll('.b.bg-red-700');

        // Check if there are any highlighted items
        if (highlightedNumbers.length === 0) {
            alert("Please select items to delete."); // Display an alert or handle the case where no items are highlighted
            return; // Exit the function early
        }

        const highlightedIds = Array.from(highlightedNumbers).map(element => element.getAttribute('id'));

        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'post'; // Use 'post' method to send data
        form.action = 'main_released_delete.php';

        // Loop through the highlighted IDs and create an input field for each ID
        highlightedIds.forEach(id => {
            const idsInput = document.createElement('input');
            idsInput.type = 'hidden';
            idsInput.name = 'ids[]'; // Use an array to send multiple IDs
            idsInput.value = id;

            // Append the input field to the form
            form.appendChild(idsInput);
        });

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }

    function maindeleteHighlighted() {
        const highlightedNumbers = document.querySelectorAll('.b.bg-red-700');

        // Check if there are any highlighted items
        if (highlightedNumbers.length === 0) {
            alert("Please select items to delete."); // Display an alert or handle the case where no items are highlighted
            return; // Exit the function early
        }

        const highlightedIds = Array.from(highlightedNumbers).map(element => element.getAttribute('id'));

        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'post'; // Use 'post' method to send data
        form.action = 'main_delete.php';

        // Loop through the highlighted IDs and create an input field for each ID
        highlightedIds.forEach(id => {
            const idsInput = document.createElement('input');
            idsInput.type = 'hidden';
            idsInput.name = 'ids[]'; // Use an array to send multiple IDs
            idsInput.value = id;

            // Append the input field to the form
            form.appendChild(idsInput);
        });

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }

    function pickupdeleteHighlighted() {
        const highlightedNumbers = document.querySelectorAll('.b.bg-red-700');

        // Check if there are any highlighted items
        if (highlightedNumbers.length === 0) {
            alert("Please select items to delete."); // Display an alert or handle the case where no items are highlighted
            return; // Exit the function early
        }

        const highlightedIds = Array.from(highlightedNumbers).map(element => element.getAttribute('id'));

        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'post'; // Use 'post' method to send data
        form.action = 'pickup_delete.php';

        // Loop through the highlighted IDs and create an input field for each ID
        highlightedIds.forEach(id => {
            const idsInput = document.createElement('input');
            idsInput.type = 'hidden';
            idsInput.name = 'ids[]'; // Use an array to send multiple IDs
            idsInput.value = id;

            // Append the input field to the form
            form.appendChild(idsInput);
        });

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }

    function claimHighlighted() {
        const highlightedNumbers = document.querySelectorAll('.b.bg-red-700');

        // Check if there are any highlighted items
        if (highlightedNumbers.length === 0) {
            alert("Please select items to claim."); // Display an alert or handle the case where no items are highlighted
            return; // Exit the function early
        }

        const highlightedIds = Array.from(highlightedNumbers).map(element => element.getAttribute('id'));

        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'post'; // Use 'post' method to send data
        form.action = 'main_claim.php';

        // Create an input field for IDs
        const idsInput = document.createElement('input');
        idsInput.type = 'hidden';
        idsInput.name = 'ids';
        idsInput.value = highlightedIds.join(',');

        // Append the input field to the form
        form.appendChild(idsInput);

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }

    function claimpickupHighlighted() {
        const highlightedNumbers = document.querySelectorAll('.b.bg-red-700');

        // Check if there are any highlighted items
        if (highlightedNumbers.length === 0) {
            alert("Please select items to claim."); // Display an alert or handle the case where no items are highlighted
            return; // Exit the function early
        }

        const highlightedIds = Array.from(highlightedNumbers).map(element => element.getAttribute('id'));

        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'post'; // Use 'post' method to send data
        form.action = 'pickup.php';

        // Create an input field for IDs
        const idsInput = document.createElement('input');
        idsInput.type = 'hidden';
        idsInput.name = 'ids';
        idsInput.value = highlightedIds.join(',');

        // Append the input field to the form
        form.appendChild(idsInput);

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();
    }

    function deleteAllData() {
        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'post'; // Use 'post' method to send data
        form.action = 'main_claim_delete.php'; // Specify your PHP script

        // Append the form to the document body
        document.body.appendChild(form);

        // Submit the form
        form.submit();

    }




    function voiceoverNumber(element) {
        const number = element.innerText;
        const synth = window.speechSynthesis;

        // Iterate through each digit and speak
        for (let i = 0; i < number.length; i++) {
            const digit = number[i];

            if (digit !== ' ') {
                const utterance = new SpeechSynthesisUtterance(digit);

                // Voiceover configuration (adjust as needed)
                utterance.lang = 'en-US';
                utterance.volume = 5;
                utterance.rate = 1.9; // Adjust the rate for slower speech
                utterance.pitch = 1;

                synth.speak(utterance);
            }
        }

        // Speak the additional message
        const additionalMessage = 'Please claim your order.';
        const messageUtterance = new SpeechSynthesisUtterance(additionalMessage);
        messageUtterance.lang = 'en-US';
        messageUtterance.volume = 5;
        messageUtterance.rate = 0.7; // Adjust the rate for slower speech
        messageUtterance.pitch = 1;

        synth.speak(messageUtterance);
    }

    function openModal() {
        // Navigate to modal.php
        window.location.href = 'modal.php';
    }

    function openpickupModal() {
        // Navigate to modal.php
        window.location.href = 'modal_pickup.php';
    }

</script>








<table width="100%" border="1" style="border-collapse:collapse;">
    <meta http-equiv="refresh" content="30">
    <tbody>


        <div class=" w-full md:w-3/2 grid grid-cols-1 md:grid-cols-4 gap-2 mx-auto">
            <div class=" h-screen shadow p-5 rounded-lg border-4 border-red-700 bg-white">
                <!-- <p class="absolute top-1 left-2 right-0 text-xs text-left text-black font-small">
                    Developed by: Your Developer Name
                </p> -->
                <p class="p-3 text-3xl text-center text-white font-medium bg-red-700 h-16">
                    Takeout List
                </p>
                <div class="scrollable-container" style="height: 600px; overflow-y: auto;">
                    <div class="grid grid-cols-2">
                        <?php foreach ($result->fetchAll() as $key => $row) { ?>
                            <div class="b" onclick="highlightNumber(this)" id="<?php echo $row['ID']; ?>" onselectstart="return false;">
                                <div style="font-size: 38px; margin-left:10px;" class="font-bold hover:text-red-500"><?php echo $row['Note']; ?></div>
                            </div>
                            <?php
                            $counter++;
                            if ($counter >= 200) {
                                break; // Exit the loop after 16 iterations
                            }

                            if ($counter > 0 && $counter % 8 == 0) {
                                echo '</div><div class="grid grid-cols-2">';
                            }
                            ?>
                        <?php } ?>
                    </div>
                </div>





                <div class="fixed-button-container ml-5">
                    <button onclick="releaseHighlighted()" class="fixed-button bg-red-700">
                        Released
                    </button>
                    <button onclick="maindeleteHighlighted()" class="fixed-button ml-2 mt-2 bg-red-700">
                        Delete
                    </button>
                </div>
            </div>





            <div class="h-screen shadow p-5 rounded-lg border-4 border-red-700 bg-white">
                <p class="p-3 text-3xl text-center text-white font-medium bg-red-700 h-16">
                    Released Take Out
                </p>
                <div class="scrollable-container" style="height: 530px; overflow-y: auto;">
                    <div class="grid grid-cols-2">
                        <?php foreach ($result_released->fetchAll() as $key => $row) { ?>
                            <div class="b" onclick="highlightNumber(this)" ondblclick="voiceoverNumber(this)" id="<?php echo $row['ID']; ?>" onselectstart="return false;">
                                <div style="font-size: 38px; margin-left:10px;" class="font-bold hover:text-red-500"><?php echo $row['released_number']; ?></div>
                            </div>
                            <?php
                            $counter_released++;
                            if ($counter_released >= 200) {
                                break; // Exit the loop after 20 iterations
                            }

                            if ($counter_released > 0 && $counter_released % 10 == 0) {
                                echo '</div><div class="grid grid-cols-2">';
                            }
                            ?>
                        <?php } ?>
                    </div>
                </div>


                <div class="fixed-button-container2">
                    <button onclick="claimHighlighted()" class="fixed-button mt-2 bg-red-700 text-center">
                        Claim
                    </button>

                    <button onclick="releaseddeleteHighlighted()" class="fixed-button bg-red-700">
                        Delete
                    </button><br>
                    <button onclick="openModal()" id="openModalBtn" class="fixed-button mt-2 bg-red-700" style="width: 250px;">
                        Manual
                    </button>
                </div>
            </div>

            <!-- Pick Up -->
            <div class="h-screen shadow p-5 rounded-lg border-4 border-red-700 bg-white">
                <p class="p-3 text-3xl text-center text-white font-medium bg-red-700 h-16">
                    Pick Up
                </p>
                <div class="scrollable-container" style="height: 530px; overflow-y: auto;">
                    <div class="grid grid-cols-1">
                        <?php foreach ($result_pickup->fetchAll() as $key => $row) { ?>
                            <div class="b" onclick="highlightNumber(this)" id="<?php echo $row['ID']; ?>" onselectstart="return false;">
                                <div style="font-size: 20px; margin-left:10px;" class="font-bold hover:text-red-500"><?php echo $row['pickup_num']; ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="fixed-button-container4 ml-11">
                    <button onclick="claimpickupHighlighted()" class="fixed-button mt-2 bg-red-700 text-center">
                        Claim
                    </button>

                    <button onclick="pickupdeleteHighlighted()" class="fixed-button bg-red-700">
                        Delete
                    </button><br>
                    <button onclick="openpickupModal()" id="openModalBtn" class="fixed-button mt-2 bg-red-700" style="width: 250px;">
                        Manual
                    </button>
                </div>
            </div>


            <div class="h-screen shadow p-5 rounded-lg border-4 border-red-700 bg-white">
                <p class="p-3 text-3xl text-center text-white font-medium bg-red-700 h-16">
                    Claim Order
                </p>
                <div class="scrollable-container" style="height: 600px; overflow-y: auto;">
                    <div class="grid grid-cols-1">
                        <?php foreach ($result_claim->fetchAll() as $key => $row) { ?>
                            <div class="b" onclick="highlightNumber(this)" id="<?php echo $row['ID']; ?>" onselectstart="return false;">
                                <div style="font-size: 17px; margin-left:10px;" class="font-bold hover:text-red-500">
                                    <?php echo $row['claim'] . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . trim($row['date_time']); ?> <!-- Display the claim field with a non-breaking space before date_time -->
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>


                <div class="fixed-button-container3 ml-28">

                    <button onclick="deleteAllData()" class="fixed-button bg-red-700">
                        Clear
                    </button>
                </div>
            </div>

        </div>



    </tbody>
</table>