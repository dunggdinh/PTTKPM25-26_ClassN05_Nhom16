<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Hệ thống bán hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            box-sizing: border-box;
        }
        
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .register-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-field {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .register-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            top: 5%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            top: 15%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-shape:nth-child(3) {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            bottom: 25%;
            left: 20%;
            animation-delay: 4s;
        }

        .floating-shape:nth-child(4) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            bottom: 15%;
            right: 10%;
            animation-delay: 1s;
        }

        .floating-shape:nth-child(5) {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            top: 50%;
            left: 5%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .logo-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .step-indicator {
            transition: all 0.3s ease;
        }

        .step-indicator.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .step-indicator.completed {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .strength-weak { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .strength-medium { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .strength-strong { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }

        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
        }
        .modal-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            transform: translateY(-20px);
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
        }
        .modal-overlay.open .modal-content {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="min-h-screen gradient-bg relative overflow-hidden">
    <!-- Floating shapes -->
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>

    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="register-card rounded-2xl shadow-2xl p-8 w-full max-w-lg animate-fade-in">
            <!-- Logo và tiêu đề -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full gradient-bg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold logo-text mb-2">Tạo tài khoản mới</h1>
                <p class="text-gray-600">Tham gia hệ thống bán hàng ShopSystem</p>
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

            <!-- Form đăng ký -->
            <form id="registerForm" method="POST" action="{{ route('auth.register') }}" class="space-y-6">
                @csrf
                <!-- Step 1: Thông tin cá nhân -->
                <div id="step1" class="step-content">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin cá nhân</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">Họ *</label>
                            <input 
                                type="text" 
                                id="firstName" 
                                name="firstName"
                                required
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                                placeholder="Nhập họ"
                            >
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Tên *</label>
                            <input 
                                type="text" 
                                id="lastName" 
                                name="lastName"
                                required
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                                placeholder="Nhập tên"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="birthDate" class="block text-sm font-medium text-gray-700 mb-2">Ngày sinh</label>
                        <input 
                            type="date" 
                            id="birthDate" 
                            name="birthDate"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                        >
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Giới tính</label>
                        <select 
                            id="gender" 
                            name="gender"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                        >
                            <option value="">Chọn giới tính</option>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>
                </div>

                <!-- Step 2: Thông tin liên hệ -->
                <div id="step2" class="step-content hidden">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Thông tin liên hệ</h3>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            required
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                            placeholder="Nhập email của bạn"
                        >
                        <p class="text-xs text-gray-500 mt-1">Email sẽ được sử dụng để đăng nhập</p>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại *</label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone"
                            required
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none"
                            placeholder="Nhập số điện thoại"
                        >
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ</label>
                        <textarea 
                            id="address" 
                            name="address"
                            rows="3"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none resize-none"
                            placeholder="Nhập địa chỉ của bạn"
                        ></textarea>
                    </div>
                </div>

                <!-- Step 3: Bảo mật -->
                <div id="step3" class="step-content hidden">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Thiết lập bảo mật</h3>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu *</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password"
                                required
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none pr-12"
                                placeholder="Nhập mật khẩu"
                            >
                            <button 
                                type="button" 
                                id="togglePassword"
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
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu *</label>
                        <div class="relative">
                            <!-- // thay đổi ở name -->
                            <input 
                                type="password" 
                                id="confirmPassword" 
                                name="password_confirmation"
                                required
                                class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none pr-12"
                                placeholder="Nhập lại mật khẩu"
                            >
                            <button 
                                type="button" 
                                id="toggleConfirmPassword"
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

                    <div>
                        <label class="flex items-start">
                            <input type="checkbox" required class="rounded border-gray-300 text-purple-600 focus:ring-purple-500 mt-1">
                            <span class="ml-2 text-sm text-gray-600">
                                Tôi đồng ý với 
                                <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Điều khoản sử dụng</a> 
                                và 
                                <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Chính sách bảo mật</a>
                            </span>
                        </label>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="ml-2 text-sm text-gray-600">
                                Tôi muốn nhận thông báo về sản phẩm và khuyến mãi qua email
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div class="flex justify-between pt-6">
                    <button 
                        type="button" 
                        id="prevBtn"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors hidden"
                    >
                        Quay lại
                    </button>
                    
                    <button 
                        type="button" 
                        id="nextBtn"
                        class="register-btn px-6 py-3 text-white font-medium rounded-lg hover:shadow-lg transform transition-all duration-300 ml-auto"
                    >
                        Tiếp tục
                    </button>
                    
                    <button 
                        type="submit" 
                        id="submitBtn"
                        class="register-btn px-6 py-3 text-white font-medium rounded-lg hover:shadow-lg transform transition-all duration-300 ml-auto hidden"
                    >
                        Tạo tài khoản
                    </button>
                </div>
            </form>

            <!-- Đã có tài khoản -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Đã có tài khoản? 
                    <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Đăng nhập ngay</a>
                </p>
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
            <h3 class="text-xl font-bold text-gray-900 mb-2">Đăng ký thành công!</h3>
            <p class="text-gray-600 mb-6">Tài khoản của bạn đã được tạo. Hãy đăng nhập để bắt đầu sử dụng hệ thống.</p>
            <button id="closeModal" class="register-btn px-6 py-2 text-white rounded-lg">
                Đăng nhập ngay
            </button>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 3;

        // Elements
        const steps = document.querySelectorAll('.step-content');
        const stepIndicators = document.querySelectorAll('.step-indicator');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const registerForm = document.getElementById('registerForm');
        const successModal = document.getElementById('successModal');
        const closeModal = document.getElementById('closeModal');

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

            // Update buttons
            prevBtn.classList.toggle('hidden', step === 1);
            nextBtn.classList.toggle('hidden', step === totalSteps);
            submitBtn.classList.toggle('hidden', step !== totalSteps);
        }

        // Validate current step
        function validateStep(step) {
            const currentStepEl = document.getElementById(`step${step}`);
            const requiredFields = currentStepEl.querySelectorAll('input[required], select[required], textarea[required]');
            
            for (let field of requiredFields) {
                if (!field.value.trim()) {
                    field.focus();
                    return false;
                }
            }

            // Additional validation for step 2 (email)
            if (step === 2) {
                const email = document.getElementById('email').value;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    document.getElementById('email').focus();
                    alert('Vui lòng nhập email hợp lệ');
                    return false;
                }
            }

            // Additional validation for step 3 (password)
            if (step === 3) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                if (password.length < 6) {
                    document.getElementById('password').focus();
                    alert('Mật khẩu phải có ít nhất 6 ký tự');
                    return false;
                }
                
                if (password !== confirmPassword) {
                    document.getElementById('confirmPassword').focus();
                    alert('Mật khẩu xác nhận không khớp');
                    return false;
                }
            }

            return true;
        }

        // Next button click
        nextBtn.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
            }
        });

        // Previous button click
        prevBtn.addEventListener('click', function() {
            currentStep--;
            showStep(currentStep);
        });

        // Password strength checker
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordStrengthText = document.getElementById('passwordStrengthText');

        passwordInput.addEventListener('input', function() {
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
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordMatch = document.getElementById('passwordMatch');

        confirmPasswordInput.addEventListener('input', function() {
            const password = passwordInput.value;
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

        setupPasswordToggle('togglePassword', 'password');
        setupPasswordToggle('toggleConfirmPassword', 'confirmPassword');

        // Form submission
        // registerForm.addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     if (validateStep(currentStep)) {
        //         // Simulate registration process
        //         setTimeout(() => {
        //             successModal.classList.add('open');
        //         }, 500);
        //     }
        // });
        registerForm.addEventListener('submit', function(e) {
            if (!validateStep(currentStep)) {
                e.preventDefault(); // Chỉ chặn nếu validate không qua
            }
            // Nếu validate đúng, để form tự submit lên server
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
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'988507c0d1eb509a',t:'MTc1OTQxNjgxNy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
