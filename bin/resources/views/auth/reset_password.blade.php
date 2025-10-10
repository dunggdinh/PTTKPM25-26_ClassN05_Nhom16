<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - Hệ thống bán hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="min-h-screen gradient-bg relative overflow-hidden">
    <!-- Floating shapes -->
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>

    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="reset-card rounded-2xl shadow-2xl p-8 w-full max-w-md animate-fade-in">
            <!-- Logo và tiêu đề -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full gradient-bg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold logo-text mb-2">Khôi phục mật khẩu</h1>
                <p id="stepDescription" class="text-gray-600">Nhập email để nhận mã xác thực</p>
            </div>

            <!-- Step Indicator -->
            <div class="flex justify-center mb-8">
                <div class="flex items-center space-x-4">
                    <div class="step-indicator active w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium">
                        1
                    </div>
                    <div class="w-12 h-1 bg-gray-200 rounded"></div>
                    <div class="step-indicator w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-sm font-medium text-gray-500">
                        2
                    </div>
                    <div class="w-12 h-1 bg-gray-200 rounded"></div>
                    <div class="step-indicator w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-sm font-medium text-gray-500">
                        3
                    </div>
                </div>
            </div>

            <!-- Form khôi phục mật khẩu -->
            <form id="resetForm" class="space-y-6">
                <!-- Step 1: Nhập email -->
                <div id="step1" class="step-content">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email đăng ký</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            required
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                            placeholder="Nhập email của bạn"
                        >
                        <p class="text-xs text-gray-500 mt-2">
                            Chúng tôi sẽ gửi mã xác thực 6 số đến email này
                        </p>
                    </div>

                    <button 
                        type="button" 
                        id="sendCodeBtn"
                        class="reset-btn w-full py-3 px-4 text-white font-medium rounded-lg hover:shadow-lg transform transition-all duration-300"
                    >
                        Gửi mã xác thực
                    </button>
                </div>

                <!-- Step 2: Nhập mã OTP -->
                <div id="step2" class="step-content hidden">
                    <div class="text-center mb-6">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600">
                            Mã xác thực đã được gửi đến<br>
                            <span id="emailDisplay" class="font-medium text-gray-800"></span>
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3 text-center">Nhập mã xác thực</label>
                        <div class="flex justify-center space-x-2 mb-4">
                            <input type="text" maxlength="1" class="otp-input input-field border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none" data-index="0">
                            <input type="text" maxlength="1" class="otp-input input-field border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none" data-index="1">
                            <input type="text" maxlength="1" class="otp-input input-field border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none" data-index="2">
                            <input type="text" maxlength="1" class="otp-input input-field border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none" data-index="3">
                            <input type="text" maxlength="1" class="otp-input input-field border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none" data-index="4">
                            <input type="text" maxlength="1" class="otp-input input-field border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none" data-index="5">
                        </div>
                        
                        <div class="text-center">
                            <p class="text-sm text-gray-500 mb-2">
                                Mã sẽ hết hạn sau: <span id="countdown" class="countdown">05:00</span>
                            </p>
                            <button type="button" id="resendBtn" class="text-sm text-purple-600 hover:text-purple-800 font-medium disabled:text-gray-400 disabled:cursor-not-allowed" disabled>
                                Gửi lại mã
                            </button>
                        </div>
                    </div>

                    <button 
                        type="button" 
                        id="verifyCodeBtn"
                        class="reset-btn w-full py-3 px-4 text-white font-medium rounded-lg hover:shadow-lg transform transition-all duration-300"
                    >
                        Xác thực mã
                    </button>
                </div>

                <!-- Step 3: Đặt mật khẩu mới -->
                <div id="step3" class="step-content hidden">
                    <div class="text-center mb-6">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600">
                            Xác thực thành công! Hãy tạo mật khẩu mới
                        </p>
                    </div>

                    <div>
                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="newPassword" 
                                name="newPassword"
                                required
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none pr-12"
                                placeholder="Nhập mật khẩu mới"
                            >
                            <button 
                                type="button" 
                                id="toggleNewPassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2">
                            <div class="password-strength bg-gray-200 w-full" id="passwordStrength"></div>
                            <p class="text-xs text-gray-500 mt-1" id="passwordStrengthText">Độ mạnh mật khẩu</p>
                        </div>
                    </div>

                    <div>
                        <label for="confirmNewPassword" class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu mới</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="confirmNewPassword" 
                                name="confirmNewPassword"
                                required
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none pr-12"
                                placeholder="Nhập lại mật khẩu mới"
                            >
                            <button 
                                type="button" 
                                id="toggleConfirmNewPassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <div id="passwordMatch" class="text-xs mt-1 hidden">
                            <span class="text-red-500">Mật khẩu không khớp</span>
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        id="resetPasswordBtn"
                        class="reset-btn w-full py-3 px-4 text-white font-medium rounded-lg hover:shadow-lg transform transition-all duration-300"
                    >
                        Đặt lại mật khẩu
                    </button>
                </div>
            </form>

            <!-- Quay lại đăng nhập -->
            <div class="mt-6 text-center">
                <a href="#" class="text-purple-600 hover:text-purple-800 font-medium text-sm flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Quay lại đăng nhập
                </a>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center modal-overlay">
        <div class="modal-content bg-white rounded-2xl p-8 max-w-sm mx-4 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Đặt lại mật khẩu thành công!</h3>
            <p class="text-gray-600 mb-6">Mật khẩu của bạn đã được cập nhật. Hãy đăng nhập với mật khẩu mới.</p>
            <button id="closeModal" class="reset-btn px-6 py-2 text-white rounded-lg">
                Đăng nhập ngay
            </button>
        </div>
    </div>

    <script>
        let currentStep = 1;
        let countdownTimer;
        let timeLeft = 300; // 5 minutes

        // Elements
        const steps = document.querySelectorAll('.step-content');
        const stepIndicators = document.querySelectorAll('.step-indicator');
        const stepDescription = document.getElementById('stepDescription');
        const resetForm = document.getElementById('resetForm');
        const successModal = document.getElementById('successModal');
        const closeModal = document.getElementById('closeModal');

        // Step descriptions
        const stepDescriptions = {
            1: 'Nhập email để nhận mã xác thực',
            2: 'Nhập mã xác thực từ email',
            3: 'Tạo mật khẩu mới cho tài khoản'
        };

        // Show specific step
        function showStep(step) {
            steps.forEach((stepEl, index) => {
                stepEl.classList.toggle('hidden', index + 1 !== step);
            });

            stepIndicators.forEach((indicator, index) => {
                indicator.classList.remove('active', 'completed');
                if (index + 1 < step) {
                    indicator.classList.add('completed');
                } else if (index + 1 === step) {
                    indicator.classList.add('active');
                }
            });

            stepDescription.textContent = stepDescriptions[step];
        }

        // Step 1: Send verification code
        document.getElementById('sendCodeBtn').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            
            if (!email) {
                alert('Vui lòng nhập email');
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Vui lòng nhập email hợp lệ');
                return;
            }

            // Simulate sending code
            document.getElementById('emailDisplay').textContent = email;
            currentStep = 2;
            showStep(currentStep);
            startCountdown();
        });

        // OTP input handling
        const otpInputs = document.querySelectorAll('.otp-input');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                const value = e.target.value;
                
                if (value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text');
                const digits = pastedData.replace(/\D/g, '').slice(0, 6);
                
                digits.split('').forEach((digit, i) => {
                    if (otpInputs[i]) {
                        otpInputs[i].value = digit;
                    }
                });
            });
        });

        // Step 2: Verify code
        document.getElementById('verifyCodeBtn').addEventListener('click', function() {
            const otp = Array.from(otpInputs).map(input => input.value).join('');
            
            if (otp.length !== 6) {
                alert('Vui lòng nhập đầy đủ mã xác thực');
                return;
            }

            // Simulate verification (accept any 6-digit code)
            currentStep = 3;
            showStep(currentStep);
            clearInterval(countdownTimer);
        });

        // Countdown timer
        function startCountdown() {
            timeLeft = 300; // Reset to 5 minutes
            const countdownEl = document.getElementById('countdown');
            const resendBtn = document.getElementById('resendBtn');
            
            resendBtn.disabled = true;
            
            countdownTimer = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdownEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(countdownTimer);
                    countdownEl.textContent = '00:00';
                    resendBtn.disabled = false;
                }
                
                timeLeft--;
            }, 1000);
        }

        // Resend code
        document.getElementById('resendBtn').addEventListener('click', function() {
            // Clear OTP inputs
            otpInputs.forEach(input => input.value = '');
            otpInputs[0].focus();
            
            // Restart countdown
            startCountdown();
            
            alert('Mã xác thực mới đã được gửi!');
        });

        // Password strength checker
        const newPasswordInput = document.getElementById('newPassword');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordStrengthText = document.getElementById('passwordStrengthText');

        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let strengthText = '';
            let strengthClass = '';

            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/\d/)) strength++;
            if (password.match(/[^a-zA-Z\d]/)) strength++;

            switch (strength) {
                case 0:
                case 1:
                    strengthText = 'Yếu';
                    strengthClass = 'strength-weak';
                    passwordStrength.style.width = '25%';
                    break;
                case 2:
                    strengthText = 'Trung bình';
                    strengthClass = 'strength-medium';
                    passwordStrength.style.width = '50%';
                    break;
                case 3:
                    strengthText = 'Mạnh';
                    strengthClass = 'strength-strong';
                    passwordStrength.style.width = '75%';
                    break;
                case 4:
                    strengthText = 'Rất mạnh';
                    strengthClass = 'strength-strong';
                    passwordStrength.style.width = '100%';
                    break;
            }

            passwordStrength.className = `password-strength ${strengthClass}`;
            passwordStrengthText.textContent = `Độ mạnh mật khẩu: ${strengthText}`;
        });

        // Password confirmation checker
        const confirmNewPasswordInput = document.getElementById('confirmNewPassword');
        const passwordMatch = document.getElementById('passwordMatch');

        confirmNewPasswordInput.addEventListener('input', function() {
            const password = newPasswordInput.value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                passwordMatch.classList.remove('hidden');
                passwordMatch.innerHTML = '<span class="text-red-500">Mật khẩu không khớp</span>';
            } else if (confirmPassword && password === confirmPassword) {
                passwordMatch.classList.remove('hidden');
                passwordMatch.innerHTML = '<span class="text-green-500">Mật khẩu khớp</span>';
            } else {
                passwordMatch.classList.add('hidden');
            }
        });

        // Toggle password visibility
        function setupPasswordToggle(toggleId, inputId) {
            const toggle = document.getElementById(toggleId);
            const input = document.getElementById(inputId);
            
            toggle.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                const svg = toggle.querySelector('svg');
                if (type === 'text') {
                    svg.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    `;
                } else {
                    svg.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    `;
                }
            });
        }

        setupPasswordToggle('toggleNewPassword', 'newPassword');
        setupPasswordToggle('toggleConfirmNewPassword', 'confirmNewPassword');

        // Form submission
        resetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newPassword = document.getElementById('newPassword').value;
            const confirmNewPassword = document.getElementById('confirmNewPassword').value;
            
            if (newPassword.length < 6) {
                alert('Mật khẩu phải có ít nhất 6 ký tự');
                return;
            }
            
            if (newPassword !== confirmNewPassword) {
                alert('Mật khẩu xác nhận không khớp');
                return;
            }
            
            // Simulate password reset
            setTimeout(() => {
                successModal.classList.add('open');
            }, 500);
        });

        closeModal.addEventListener('click', function() {
            successModal.classList.remove('open');
        });

        // Close modal when clicking outside
        successModal.addEventListener('click', function(e) {
            if (e.target === successModal) {
                successModal.classList.remove('open');
            }
        });

        // Initialize
        showStep(currentStep);
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'98850cbbf277509a',t:'MTc1OTQxNzAyMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
