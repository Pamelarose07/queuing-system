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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        /* Set the body height to 100vh */
        overflow-y: auto;
        /* Prevent scrolling */
    }

    .b {
        cursor: pointer;
        pointer-events: all !important;
    }

    .fixed-button-container {
        position: absolute;
        bottom: 20px;
        /* Adjust the bottom position as needed */
        left: 52%;
        transform: translateX(-50%);
        width: 100%;
        text-align: left;
        overflow-x: hidden;
    }

    .fixed-button-container2 {
        position: absolute;
        bottom: 20px;
        /* Adjust the bottom position as needed */
        left: 40%;
        transform: translateX(-50%);
        width: 100%;
        min-width: 70px;
        max-width: 300px;
        text-align: center;
    }

    .fixed-button-container3 {
        position: absolute;
        bottom: 20px;
        /* Adjust the bottom position as needed */
        left: 110%;
        transform: translateX(-50%);
        width: 100%;
        min-width: 75px;
        max-width: 300px;
        text-align: left;
    }

    .fixed-button {
        color: white;
        padding: 10px 70px;
        border-radius: 8px;
        cursor: pointer;
    }

    /* For tablets and above (md and up), set 2 columns layout */
    @media only screen and (max-width: 600px) {
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            /* Set the body height to 100vh */
            overflow-y: auto;
            /* Prevent scrolling */
        }

        .grid-container {
            grid-template-columns: 1fr 1fr;
            /* 2 columns layout */
            grid-template-rows: 1fr;
            /* 1 row for medium and larger screens */
        }


        .fixed-button-container2 {
            position: absolute;
            top: 60%;
            /* Adjust the bottom position as needed */
            left: 52%;
            transform: translateX(-50%);
            width: 100%;
            min-width: 75px;
            max-width: 300px;
            text-align: left;
        }

        .fixed-button-container3 {
            position: absolute;
            top: 150%;
            /* Adjust the bottom position as needed */
            left: 45%;
            transform: translateX(-50%);
            width: 100%;
            text-align: left;
        }

        .fixed-button {
            color: white;
            padding: 10px 50px;
            border-radius: 8px;
            cursor: pointer;
        }

        .manual {
            width: 50%;

        }
    }

    /* For mobile (up to 600px), set 2 rows layout */
    @media only screen and (min-width: 600px) {
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            /* Set the body height to 100vh */
            overflow-y: auto;
            /* Prevent scrolling */
        }

        .grid-container {
            grid-template-columns: 1fr 1fr;
            /* 2 columns layout */
            grid-template-rows: 1fr;
            /* 1 row for medium and larger screens */
        }


        .fixed-button-container2 {
            position: absolute;
            top: 60%;
            /* Adjust the bottom position as needed */
            left: 52%;
            transform: translateX(-50%);
            width: 100%;
            min-width: 75px;
            max-width: 300px;
            text-align: left;
        }

        .fixed-button-container3 {
            position: absolute;
            top: 150%;
            /* Adjust the bottom position as needed */
            left: 45%;
            transform: translateX(-50%);
            width: 100%;
            text-align: left;
        }

        .fixed-button {
            color: white;
            padding: 10px 50px;
            border-radius: 8px;
            cursor: pointer;
        }

        .manual {
            width: 50%;

        }

    }



    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) {
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            /* Set the body height to 100vh */
            overflow-y: auto;
            /* Prevent scrolling */
        }

        .grid-container {
            grid-template-columns: 1fr 1fr;
            /* 2 columns layout */
            grid-template-rows: 1fr;
            /* 1 row for medium and larger screens */
        }


        .fixed-button-container2 {
            position: absolute;
            top: 60%;
            /* Adjust the bottom position as needed */
            left: 52%;
            transform: translateX(-50%);
            width: 100%;
            min-width: 75px;
            max-width: 300px;
            text-align: left;
        }

        .fixed-button-container3 {
            position: absolute;
            top: 150%;
            /* Adjust the bottom position as needed */
            left: 45%;
            transform: translateX(-50%);
            width: 100%;
            min-width: 75px;
            max-width: 300px;
            text-align: left;
        }
    }

    @media only screen and (min-width: 992px) {
        body {
            height: 100hv;
            overflow-x: hidden;
        }


        .fixed-button-container2 {
            position: absolute;
            top: 85%;
            /* Adjust the bottom position as needed */
            left: 24%;
            transform: translateX(-50%);
            width: 100%;
            min-width: 75px;
            max-width: 300px;
            text-align: left;
        }

        .fixed-button-container3 {
            position: absolute;
            top: 92%;
            /* Adjust the bottom position as needed */
            left: 75%;
            transform: translateX(-50%);
            width: 100%;
            min-width: 75px;
            max-width: 300px;
            text-align: left;
        }


    }

    @media only screen and (min-width: 1200px) {
        body {
            height: 100hv;
            overflow-x: hidden;
        }


        .fixed-button-container2 {
            position: absolute;
            top: 84%;
            /* Adjust the bottom position as needed */
            left: 24%;
            transform: translateX(-50%);
            width: 100%;
            min-width: 75px;
            max-width: 300px;
            text-align: left;
        }

        .fixed-button-container3 {
            position: absolute;
            top: 92%;
            /* Adjust the bottom position as needed */
            left: 75%;
            transform: translateX(-50%);
            width: 100%;
            min-width: 75px;
            max-width: 300px;
            text-align: left;
        }


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

    function claimHighlighted() {
        const highlightedNumbers = document.querySelectorAll('.b.bg-red-700');
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
                utterance.pitch = 0.4;

                synth.speak(utterance);
            }
        }

        // Speak the additional message
        const additionalMessage = 'Please claim your order.';
        const messageUtterance = new SpeechSynthesisUtterance(additionalMessage);
        messageUtterance.lang = 'en-US';
        messageUtterance.volume = 5;
        messageUtterance.rate = 0.5; // Adjust the rate for slower speech
        messageUtterance.pitch = 0.4;

        synth.speak(messageUtterance);
    }

    function openModal() {
        // Navigate to modal.php
        window.location.href = 'modal.php';
    }
</script>








<table width="100%" border="1" style="border-collapse:collapse;">
    <meta http-equiv="refresh" content="30">
    <tbody>


        <div class="h-full w-full md:w-3/3 grid grid-cols-1  lg:grid-cols-2 gap-10 mx-auto">






            <div class="red-border shadow p-5 rounded-lg border-4 border-red-700 bg-white">
                <p class="p-3 text-3xl text-center text-white font-medium bg-red-700 h-16">
                    Released Take Out
                </p>
                <div class="scrollable-container" style="height: 530px; overflow-y: auto;">
                    <div class="grid grid-cols-3">
                        <?php
                        // Initialize counter_released before using it
                        $counter_released = 0;

                        foreach ($result_released->fetchAll() as $key => $row) { ?>
                            <div class="b" onclick="highlightNumber(this)" ondblclick="voiceoverNumber(this)" id="<?php echo $row['ID']; ?>" onselectstart="return false;">
                                <div style="font-size: 40px; margin-left:10px;" class="font-bold hover:text-red-500"><?php echo $row['released_number']; ?></div>
                            </div>
                            <?php
                            $counter_released++; // Increment counter_released
                            if ($counter_released >= 50) {
                                break; // Exit the loop after 50 iterations
                            }
                            ?>
                        <?php } ?>

                    </div>
                </div>


                <div class="fixed-button-container2">
                    <button onclick="claimHighlighted()" class="fixed-button mt-2 bg-red-700">
                        Claim
                    </button>
                    <button onclick="releaseddeleteHighlighted()" class="fixed-button bg-red-700">
                        Delete
                    </button><br>
                    <button onclick="openModal()" id="openModalBtn" class="manual fixed-button mt-2 bg-red-700" style="width: 290px;">
                        Manual
                    </button>
                </div>
            </div>

            <div class=" shadow p-5 rounded-lg border-4 border-red-700 bg-white">
                <p class="p-3 text-3xl text-center text-white font-medium bg-red-700 h-16">
                    Claim Order
                </p>
                <div class="scrollable-container" style="height: 530px; overflow-y: auto;">
                    <div class="grid grid-cols-1">
                        <?php foreach ($result_claim->fetchAll() as $key => $row) { ?>
                            <div class="b" onclick="highlightNumber(this)" id="<?php echo $row['ID']; ?>" onselectstart="return false;">
                                <div style="font-size: 22px; margin-left:10px;" class="font-bold hover:text-red-500">
                                    <?php echo $row['claim'] . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . '&nbsp;' . trim($row['date_time']); ?> <!-- Display the claim field with a non-breaking space before date_time -->
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