<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
?>
<div class="relative w-full h-full flex justify-center items-center  bg-gradient-to-br from-white via-teal-50 to-teal-300">
    <div id="profile-card"
         class="bg-white dark:bg-gray-700 rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 text-center mb-8 md:mb-0">

                <img id="profileIMG" src="<?php echo isset($user['ax'])? $this->asset('images/profiles/' . $user['ax']): $this->asset('images/Avatar-PNG.png')?>"
                     alt="Profile Picture"
                     class="leading-10 text-center rounded-full w-48 h-48 mx-auto mb-4 border-4 border-teal-700 dark:border-blue-900 transition-transform duration-300 hover:scale-105">
                <h1 class="text-2xl font-bold text-teal-700 dark:text-white mb-2"><?php echo $user['userName'] ?></h1>
                <p class="text-gray-600 dark:text-gray-300"><?php echo $user['semat'] ?? '' ?></p>
                <button id="editProfile" class="mt-4 bg-teal-700 hover:bg-teal-500 focus:ring-4 focus:ring-teal-300 text-white px-4 py-2
            rounded-lg transition-colors duration-300">Edit Profile
                </button>
            </div>
            <div class="md:w-2/3 md:pl-8">
                <h2 class="text-xl font-semibold text-teal-700 dark:text-white mb-4">Contact Information</h2>
                <ul class="text-gray-700 dark:text-gray-300 space-y-7" id="ulProfile">
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-teal-700 dark:text-blue-900"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span aria-label="data-editable" data-id="userEmail"><?php echo $user['email'] ?? '' ?></span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-teal-700 dark:text-blue-900"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        <span aria-label="data-editable" data-id="userPhone"><?php echo $user['phone'] ?? '' ?></span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-teal-700 dark:text-blue-900"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span aria-label="data-editable"
                              data-id="userAddress"><?php echo $user['address'] ?? '' ?></span></span>
                    </li>
                </ul>
                <div class="profile-signature">
                    <h2 class="text-xl font-semibold text-teal-700 dark:text-white mb-4 mt-7">User Signature</h2>
                    <div class="flex items-start">
                        <span class="mr-2 text-teal-700"><i class="fa fa-pencil"></i></span>
                        <img id="personSignature"
                             src="<?php echo isset($user['signature'])? $this->asset('images/signs/' . $user['signature']): ''?>"
                             alt="Profile Signature"
                             class="leading-10 text-center w-32 h-32 ms-4 mb-4 border-4 border-teal-700 dark:border-blue-900 transition-transform duration-300 hover:scale-105">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/profile.js'); ?>"></script>
