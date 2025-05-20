<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8" />
        <title>Missionary Donation Popup</title>
        <link href="css/main.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="flex justify-center items-center h-screen bg-gray-100 relative">
        <button id="openBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 z-10">
            Donate Now
        </button>

        <div id="popup" class="popup-main popup fixed top-0 left-0 h-full shadow-lg w-full md:w-full lg:w-[41.5%] p-6 z-20 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <button id="closeBtn" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            </div>

            <div class="flex items-center justify-center min-h-screen px-4">
                <div id="donationForm" class="bg-white popup-box w-full max-w-md">
                    <div class="heading-box flex items-center space-x-2">
                        <span class="h-text text-lg font-semibold">Missionary Donation</span>
                    </div>

                    <hr style="color: #ececec;" />
                    <div class="main-field">
                        <div class="flex border-b">
                            <button id="oneTimeBtn" class="f-btn donation-btn flex-1 py-2 c-btn d-btn ">
                                One-Time
                            </button>
                            <button id="monthlyBtn" class="s-btn donation-btn flex-1 py-2 font-medium text-gray-500 bg-white d-btn">
                                Monthly
                            </button>
                        </div>

                        <div class="mb-6" style="margin-top: 20px;">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <input id="nameInput" type="text" class="text-box w-full px-3 py-2 border border-gray-300 rounded" placeholder="Donor's Name" />
                                    <p id="nameError" class="error-text text-red-500 text-sm mt-1 hidden">Please enter your name</p>

                                </div>
                                <div>
                                    <input id="emailInput" type="email" class="text-box w-full px-3 py-2 border border-gray-300 rounded" placeholder="Donor's Email" />
                                    <p id="emailError" class="error-text text-red-500 text-sm mt-1 hidden">Please enter a valid email</p>

                                </div>
                            </div>
                            <div>
                                <select class="text-box w-full px-3 py-2 border border-gray-300 rounded">
                                    <option>Night Bright</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="grid grid-cols-4 gap-3">
                                <button class="a-box donation-option bg-white border border-gray-300 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50">
                                    $10
                                </button>
                                <button class="a-box donation-option bg-white border border-gray-300 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50">
                                    $25
                                </button>
                                <button class="a-box donation-option bg-white border border-gray-300 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50">
                                    $50
                                </button>
                                <button class="a-box donation-option bg-white border border-gray-300 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50">
                                    $100
                                </button>
                                <button class="a-box donation-option bg-white border border-gray-300 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50">
                                    $250
                                </button>
                                <button class="a-box donation-option bg-white border border-gray-300 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50">
                                    $500
                                </button>
                                <button class="a-box donation-option bg-white border border-gray-300 rounded-lg py-3 px-4 text-center hover:border-blue-500 hover:bg-blue-50">
                                    $1000
                                </button>
                                <input type="text" placeholder="Other amount" class="text-box w-full px-3 py-2 border border-gray-300 rounded" />
                            </div>
                            <p id="amountError" class="error-text text-red-500 text-sm mt-1 hidden">Please select or enter a donation amount</p>
                            <div class="mt-3"></div>
                        </div>

                        <div id="addMessageContainer" class="mb-3">
                            <a href="#" id="addMessageLink" class="add-message">+ Add a message</a>
                        </div>
                    </div>
                    <hr style="color: #ececec;" />

                    <div class="flex items-center justify-between gap-4 bottom-box h-16">
                        <div class="flex items-center h-full">
                            <label class="custom-checkbox">
                                <input type="checkbox" class="checkbox-design" />
                                <span class="custom-checkmark"></span>
                                <span class="stay">Stay Anonymous</span>
                            </label>
                        </div>

                        <button id="continueBtn" class="b-btn">
                            Continue
                        </button>
                    </div>
                </div>

                <div id="reviewScreen" class="popup-box hidden">
                    <div class="heading-box flex items-center space-x-2">
                        <button id="backBtn" class="text-gray-600 hover:text-gray-800 text-xl">
                            ←
                        </button>
                        <span class="h-text text-lg font-semibold">Final Details</span>
                    </div>

                    <hr style="color: #ececec;" />
                    <div class="main-box">
                        <div class="flex justify-between mb-3 a-format">
                            <span>Donation</span>
                            <span class="font-semibold">$25</span>
                        </div>
                        <div class="flex justify-between mb-3 a-format">
                            <span>Credit card processing fees</span>
                        </div>

                        <div class="mb-4 flex items-center justify-between gap-4">
                            <div class="relative inline-block w-full">
                                <!-- Button -->
                                <button id="dropdownDelayButton" type="button" class="w-[70%] flex items-center card-btn justify-between px-3 py-2 bg-white transition-all duration-200">
                                    <span id="dropdownSelectedText">Select Payment Method</span>
                                    <svg id="dropdownArrow" class="w-4 h-4 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path d="M1 1L5 5L9 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="dropdownDelay" class="absolute left-0 mt-1 w-[70%] card-dropdown shadow-lg z-10 hidden">
                                    <ul class="py-2 text-sm" aria-labelledby="dropdownDelayButton">
                                        <li><a href="#" class="dropdown-item block px-4 py-2 hover:bg-gray-100">AMEX Card</a></li>
                                        <li><a href="#" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Visa & Others</a></li>
                                        <li><a href="#" class="dropdown-item block px-4 py-2 hover:bg-gray-100">US Bank Account</a></li>
                                        <li><a href="#" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Cash App Pay</a></li>
                                    </ul>
                                </div>
                            </div>

                            
                        </div>

                        <p class="mb-4 w-[65%] info-text">You pay the CC fee so 100% of your donation goes to your chosen missionary or cause.</p>
                    </div>
                    <hr style="margin: 10px 0px 10px 0px; color: #ececec;" />
                    <div class="pt-4 bg-yellow-50 p-8 mb-4">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div class="w-[63.3%]">
                                <p class="t-heading">Add a tip to support Night Bright</p>
                                <p class="info-text">
                                    <span class="text-yellow-700 font-medium">Why Tip?</span>
                                    Night Bright does not charge any platform fees and relies on your generosity to support this free service.
                                </p>
                            </div>
                            <div class="w-[36%]">
                                <!-- Custom Tip Dropdown -->
                                <div class="relative w-full mt-1">
                                    <button id="tipDropdownButton" type="button" class="w-full flex items-center card-btn justify-between px-3 py-2 d  bg-white transition-all duration-200">
                                        <span id="tipDropdownSelectedText">Select Tip</span>
                                        <svg id="tipDropdownArrow" class="w-4 h-4 ml-2 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div id="tipDropdownMenu" class="absolute card-dropdown left-0 right-0 mt-1 shadow-lg z-10 hidden">
                                        <ul>
                                            <li><button class="tip-dropdown-item w-full text-left px-4 py-2 hover:bg-gray-100">12%</button></li>
                                            <li><button class="tip-dropdown-item w-full text-left px-4 py-2 hover:bg-gray-100">15%</button></li>
                                            <li><button class="tip-dropdown-item w-full text-left px-4 py-2 hover:bg-gray-100">20%</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-box">
                        <label class="flex items-center mb-4">
                            <input type="checkbox" class="mr-2 accent-yellow-700" checked />
                            <span class="contact-text">Allow Night Bright Inc to contact me</span>
                        </label>
                    </div>

                    <hr style="color: #ececec;" />
                    <div class="main-box">
                        <div class="flex justify-end items-center h-16">
                            <button id="finish" class="finish-btn">
                                Finish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->

        <!-- Dark Overlay -->
        <div id="overlay" class="hidden fixed inset-0 bg-black opacity-40 z-10"></div>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>

        <script src="js/main.js"></script>
    </body>
</html>
