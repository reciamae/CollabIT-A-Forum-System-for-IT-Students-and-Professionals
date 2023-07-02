<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<x-guest-layout>
    <h1><b>Register New Account</b></h1><br>
    <form method="POST" action="{{ route('register') }}"  onsubmit="return validateForm()">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="firstname" :value="__('Firstname')" />
            <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="lastname" :value="__('Lastname')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full" onchange="toggleProfessionalQuestion()" required>
                <option value="" disabled selected>Select your role</option>
                <option value="student">Student</option>
                <option value="professional">Professional</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Institution/Organization -->
        <div class="mt-4">
            <x-input-label for="ins_org" :value="__('Institution/Organization')" />
            <x-text-input id="ins_org" class="block mt-1 w-full" type="text" name="ins_org" :value="old('ins_org')" required />
            <x-input-error :messages="$errors->get('ins_org')" class="mt-2" />
        </div>

        <!-- Qualification -->
        <div class="mt-4">
            <x-input-label for="quali_educ" :value="__('Qualification/Education')" />
            <select id="quali_educ" name="quali_educ" class="block mt-1 w-full" required>
                <option value="" disabled selected>Select your qualification</option>
                <option value="High School Diploma">High School Diploma</option>
                <option value="Associate's Degree">Associate's Degree</option>
                <option value="Bachelor's Degree">Bachelor's Degree</option>
                <option value="Master's Degree">Master's Degree</option>
                <option value="Doctorate (Ph.D.)">Doctorate (Ph.D.)</option>
                <option value="Professional Certification">Professional Certification</option>
                <option value="Bootcamp/Training Program">Bootcamp/Training Program</option>
                <option value="Self-Taught">Self-Taught</option>
                <option value="Currently Enrolled in an IT-related Program">Currently Enrolled in an IT-related Program</option>
            </select>
            <x-input-error :messages="$errors->get('quali_educ')" class="mt-2" />
        </div>

        <!-- Experience -->
        <div class="mt-4">
            <x-input-label for="experience" :value="__('Experience')" />
            <textarea id="experience" name="experience" rows="5" class="block w-full mt-1 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300" required>{{ old('experience') }}</textarea>
            <x-input-error :messages="$errors->get('experience')" class="mt-2" />
        </div>
        <!-- Experience -->
        <div class="mt-4">
            <x-input-label for="skills" :value="__('Skills')" />
            <textarea id="experience" name="skills" rows="5" class="block w-full mt-1 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300" required>{{ old('skills') }}</textarea>
            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
        </div>

        <!-- Contact -->
        <div class="mt-4">
            <x-input-label for="contact_no" :value="__('Contact No.')" />
            <x-text-input id="contact_no" class="block mt-1 w-full" type="text" name="contact_no" :value="old('contact_no')" required />
            <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
        </div>

        <div id="professionalQuestion" class="mt-4" style="display: none;">
            <x-input-label for="professional_question" :value="__('Question:
            Which statement accurately describes the differences between TCP and UDP?')" />
            <select id="professional_question" name="professional_question" class="block mt-1 w-full">
                <option value="" selected>Select your answer</option>
                <option value="a">a. TCP is a connection-oriented protocol that guarantees reliable data delivery, <br>while UDP is a connectionless protocol that does not provide guaranteed delivery.</option>
                <option value="b">b. TCP is a connectionless protocol that does not provide guaranteed delivery, <br>while UDP is a connection-oriented protocol that guarantees reliable data delivery.</option>
                <option value="c">c. TCP and UDP are both connection-oriented protocols that guarantee reliable data delivery.</option>
                <option value="d">d. TCP and UDP are both connectionless protocols that do not provide guaranteed delivery.</option>
            </select>
            <x-input-error :messages="$errors->get('professional_question')" class="mt-2" />
        </div>
        <div class="mt-4">
    <input id="termsCheckbox" type="checkbox" onclick="toggleRegisterButton()" required>
    <label for="termsCheckbox" class="ml-2">I agree to the <a href="#" onclick="openTermsModal()">Terms and Conditions</a></label>
    <x-input-error :messages="$errors->get('termsCheckbox')" class="mt-2" />
</div>
<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>

    <x-primary-button id="registerButton" class="ml-4" disabled>
        {{ __('Register') }}
    </x-primary-button>
</div>
    </form>
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeTermsModal()">&times;</span>
            <h2>Terms and Conditions</h2>
        <p>Welcome to our IT Forum!</p>

        <h3>1. Acceptance of Terms</h3>
        <p>By accessing and using this forum, you acknowledge that you have read, understood, and agree to be bound by the following terms and conditions.</p>

        <h3>2. Forum Usage</h3>
        <p>The IT Forum is a platform for students and professionals to discuss IT-related topics, ask questions, share knowledge, and engage in conversations. You are responsible for the content you post and the interactions you have within the forum.</p>

        <h3>3. Code of Conduct</h3>
        <p>We expect all users to adhere to a code of conduct that promotes a respectful and inclusive environment. This includes refraining from abusive language, spamming, trolling, or any other behavior that may disrupt the forum or harm other users.</p>

        <h3>4. Intellectual Property</h3>
        <p>All content posted on the forum, including text, images, and media, should respect intellectual property rights. Do not post copyrighted material without proper permission or attribution.</p>

        <h3>5. Privacy and Security</h3>
        <p>We value your privacy and take appropriate measures to protect your personal information. However, it's important to note that no online platform is completely secure. By using the forum, you understand and accept the inherent risks associated with sharing information online.</p>

        <h3>6. Moderation and Enforcement</h3>
        <p>We reserve the right to moderate the forum and enforce these terms and conditions. Users who violate the terms may face consequences, including warnings, suspension, or permanent removal from the forum.</p>

        <h3>7. Disclaimer</h3>
        <p>The information shared on the forum is provided by individual users and should not be considered as professional advice or endorsement. We do not guarantee the accuracy, completeness, or reliability of the content posted on the forum.</p>

        <h3>8. Amendments</h3>
        <p>We may update or modify these terms and conditions from time to time. It is your responsibility to review and understand the most recent version. Continued use of the forum constitutes your acceptance of any changes made.</p>

        <p>Please read these terms and conditions carefully. If you do not agree with any part of these terms, please refrain from using the forum.</p>
    </div>
        </div>
    </div>

    <script>
        function toggleProfessionalQuestion() {
            var role = document.getElementById('role').value;
            var professionalQuestion = document.getElementById('professionalQuestion');

            if (role === 'professional') {
                professionalQuestion.style.display = 'block';
            } else {
                professionalQuestion.style.display = 'none';
            }
        }

        function toggleRegisterButton() {
            var termsCheckbox = document.getElementById('termsCheckbox');
            var registerButton = document.getElementById('registerButton');

            if (termsCheckbox.checked) {
                registerButton.disabled = false;
            } else {
                registerButton.disabled = true;
            }
        }

        function openTermsModal() {
    var termsModal = document.getElementById('termsModal');
    termsModal.style.display = 'block';
}

function closeTermsModal() {
    var termsModal = document.getElementById('termsModal');
    termsModal.style.display = 'none';
    
    var termsCheckbox = document.getElementById('termsCheckbox');
    termsCheckbox.checked = true;
    registerButton.disabled = false;
}

        function validateForm() {
            var role = document.getElementById('role').value;
            var question = document.getElementById('professional_question').value;

            if (role === 'professional' && question !== 'a') {
                alert('Please answer the professional question correctly before proceeding with the registration.');
                return false;
            }

            return true;
        }
    </script>
</x-guest-layout> 
</body>
</html>
