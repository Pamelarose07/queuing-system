<?php
require('db.php');

$dbPath = 'c:\Restrnt\Data-KDS\TakeoutDB.mdb';

if (!file_exists($dbPath)) {
    die('Could Not Find Database File');
}

try {
    $db = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$dbPath; Uid=; Pwd=;");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch released numbers from released_takeout
    $sql_released = "SELECT released_number FROM released_takeout";
    $result_released = $db->query($sql_released)->fetchAll(PDO::FETCH_COLUMN);

    // Define a function to pad the released number with leading zeros
    function padNumber($number)
    {
        return str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // Fetch pickup numbers from pickup_num
    $sql_pickup = "SELECT pickup_num FROM pickup";
    $result_pickup = $db->query($sql_pickup)->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GoodTaste</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                margin: 0;
                padding: 0;
            }

            .fixed-video {
                position: fixed;
                width: 746px;
                height: 420px;
                bottom: 10px;
                right: 7px;
                pointer-events: none;
            }
        </style>
    </head>

    <body class="h-screen">
        <div class="w-full h-full">
            <meta http-equiv="refresh" content="11">
            <nav class="bg-red-600 border-gray-200 dark:bg-gray-900">
                <div class="h-10 max-w-screen-xl flex justify-between items-center">
                    <h5 class="text-left text-white font-serif text-4xl ml-10">Now Serving...</h5>
                    <div id="real-time" class="flex-grow text-center font-semibold text-white text-5xl -mt-1"></div>
                </div>
            </nav>

            <div id="refreshable-content">
                <!-- Grid -->
                <div id="number-grid" class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols gap-4 mx-5 overflow-hidden">
                    <?php
                    $maxRowsFirstTwoColumns = 8;
                    $maxRowsThirdColumn = 3;
                    $rowCountFirstTwoColumns = ceil(count($result_released) / 4);
                    $rowCountThirdColumn = ceil(count($result_released) / 4);
                    $rowIndex = 1;
                    $counter = 0;

                    $orderedNumbers = [];

                    foreach ($result_released as $releasedNumber) {
                        // Skip numbers that don't start with "GF"
                        if (strpos($releasedNumber, 'GF') !== 0) {
                            continue;
                        }

                        $orderedNumbers[] = $releasedNumber;

                        if ($rowIndex <= $maxRowsFirstTwoColumns * 2 && count($orderedNumbers) >= $maxRowsFirstTwoColumns) {
                    ?>
                            <div class="ml-5 font-medium text-gray-900 bg-white">
                                <?php
                                foreach ($orderedNumbers as $number) {
                                    $counter++;
                                    if ($counter > 22) {
                                        break 2; // Break out of both loops after displaying 22 numbers
                                    }
                                ?>
                                    <div class="text-7xl"><?= padNumber($number) ?></div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                            $orderedNumbers = [];
                        } elseif ($rowIndex > $maxRowsFirstTwoColumns * 2 && count($orderedNumbers) >= $maxRowsThirdColumn) {
                        ?>
                            <div class="ml-5 font-medium text-gray-900 bg-white">
                                <?php
                                foreach ($orderedNumbers as $number) {
                                    $counter++;
                                    if ($counter > 22) {
                                        break 2; // Break out of both loops after displaying 22 numbers
                                    }
                                ?>
                                    <div class="text-7xl"><?= padNumber($number) ?></div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                            $orderedNumbers = [];
                        }

                        $rowIndex++;
                    }

                    if (!empty($orderedNumbers)) {
                        ?>
                        <div class="ml-5 font-medium text-gray-900 bg-white">
                            <?php
                            foreach ($orderedNumbers as $number) {
                                $counter++;
                                if ($counter > 20) {
                                    break; // Break out of the loop after displaying 20 numbers
                                }
                            ?>
                                <div class="text-7xl"><?= padNumber($number) ?></div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <!-- Video -->
            <video class="fixed-video object-over" controls autoplay muted loop>
                <source src="final.mp4" type="video/mp4">
            </video>
        </div>
    </body>

    </html>
    <script>
        function updateTime() {
            const now = new Date();
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            let timeOfDay = hours < 12 ? 'AM' : 'PM';
            hours = hours % 12 || 12; // Convert 24-hour format to 12-hour format
            const timeString = `${hours}:${minutes}:${seconds} ${timeOfDay}`;
            document.getElementById('real-time').textContent = timeString;
        }

        updateTime(); // Initial call to display time immediately

        // Update time every second
        setInterval(updateTime, 1000);
    </script>
<?php

?>