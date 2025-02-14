<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="relative h-screen">
        <?php include('C:\xampp\htdocs\queuing\serve.php'); ?>

        <!-- Background include -->
        <div class="absolute inset-0 z-10">
            <!-- Adjust bg-red-500 to your desired background color -->


            <!-- Main modal -->

            <div class="flex items-center relative z-20 mt-10">
                <div class="font-sans mx-auto p-4 w-full max-w-5xl max-h-72 ">
                    <form id="myForm" action="pickup_insert.php" method="post">
                        <!-- Modal content -->
                        <div class="relative bg-red-700 rounded-lg shadow dark:bg-gray-700 border border-black">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-white dark:text-white">
                                    Pickup Manual
                                </h3>
                                <button onclick="closeModal()" type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->

                            <div class="p-4 md:p-5 space-y-4">
                                <div class="flex justify-center">
                                    <input type="text" name="numberInput" id="numberInput" class="w-1/2 text-center text-black bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-400 rounded-lg border border-gray-700 text-3xl font-medium px-5 py-5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600" autocomplete="off">
                                    <button class="ml-2 text-black bg-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-10 py-2" onclick="event.preventDefault(); clearInput()">Clear</button>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="grid grid-cols-4 gap-4">
                                        <?php for ($i = 0; $i <= 9; $i++) : ?>
                                            <button class="text-black bg-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-400 font-large rounded-lg text-3xl px-5 py-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="event.preventDefault(); appendToInput('<?= $i ?>')"><?= $i ?></button>
                                        <?php endfor; ?>

                                        <button class="text-black bg-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-400 font-large rounded-lg text-3xl px-5 py-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="event.preventDefault(); appendToInput('GF-')">GF-</button>
                                        <button class="text-black bg-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-400 font-large rounded-lg text-3xl px-5 py-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="event.preventDefault(); appendToInput('PU')">PU</button>
                                        <button class="text-black bg-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-400 font-large rounded-lg text-3xl px-5 py-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="event.preventDefault(); appendToInput('@')">@</button>
                                        <button class="text-black bg-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-400 font-large rounded-lg text-3xl px-5 py-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="event.preventDefault(); appendToInput('-')">-</button>

                                    </div>



                                    <!-- Character buttons in the right column -->
                                    <div class="space-y-4 -mt-4">
                                        <?php
                                        $characters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                                        foreach ($characters as $char) : ?>
                                            <button class="text-black bg-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-400 font-large rounded-lg text-3xl px-5 py-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="event.preventDefault(); appendToInput('<?= $char ?>')"><?= $char ?></button>
                                        <?php endforeach; ?>
                                        <button class="text-black bg-white hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-400 font-large rounded-lg text-3xl px-5 py-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="event.preventDefault(); appendToInput(' ')">___</button>
                                    </div>
                                </div>

                            </div>



                            <!-- Modal footer -->
                            <div class="flex justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit1" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-10 py-6 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function appendToInput(character) {
                var inputElement = document.getElementById('numberInput');
                inputElement.value += character;
            }

            function clearInput() {
                document.getElementById('numberInput').value = '';
            }

            function closeModal() {
                // Navigate to modal.php
                window.location.href = 'main.php';
            }

        </script>
</body>

</html>