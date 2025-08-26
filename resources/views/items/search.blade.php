<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kesan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .message-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .message-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .back-button {
            transition: all 0.3s ease;
        }
        
        .back-button:hover {
            transform: translateX(-5px);
        }
        
        .comment-form {
            transition: all 0.3s ease;
        }
        
        .comment-form:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .comment-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .comment-submit {
            transition: all 0.3s ease;
        }
        
        .comment-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
        }
        
        .readonly-input {
            background-color: #f9fafb;
            color: #374151;
            cursor: not-allowed;
            border-color: #d1d5db;
        }
        
        .readonly-input:focus {
            outline: none;
            border-color: #d1d5db;
            box-shadow: none;
        }
        
        .bg-error {
            background-image: url('{{ asset('images/jkw.jpg') }}') !important;
            background-size: 25% 25%;
            background-position: bottom center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            transition: background-position 0.5s ease-in-out;
        }
        
        .bg-error.moving {
            animation: randomMove 8s infinite ease-in-out;
        }
        
        @keyframes randomMove {
            0% { background-position: 10% 20%; }
            25% { background-position: 80% 60%; }
            50% { background-position: 30% 80%; }
            75% { background-position: 70% 30%; }
            100% { background-position: 10% 20%; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen">

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search Results Header -->
        <div class="text-center mb-12 fade-in">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-6">
                <i class="fas fa-search text-3xl text-blue-600"></i>
            </div>
        @if(isset($item) && $item->name)
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Halo <span class="text-blue-600">{{ $item->name }}</span></h2>
       @endif
        </div>

        <!-- Message Display -->
        <div class="fade-in" style="animation-delay: 0.2s;">
            @if(isset($message))
                <!-- Photo and Message Cards Container -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Photo Card -->
                    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                        @if(isset($item) && $item->photo)
                            <img src="{{ asset('storage/' . $item->photo) }}" 
                                 alt="Foto {{ $item->name }}" 
                                 class="w-full h-full object-cover min-h-[400px]">
                        @else
                            <div class="w-full h-full min-h-[400px] bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-user text-8xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Message Card -->
                    <div class="message-card rounded-2xl shadow-2xl p-8 text-white text-center">
                        <div class="max-w-3xl mx-auto">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-6">
                                <i class="fas fa-heart text-2xl"></i>
                            </div>
                            
                            <h3 class="text-2xl font-bold mb-6">Wejangan</h3>
                            <div class="text-lg leading-relaxed mb-8">
                                {!! nl2br(e($message)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comment Section -->
                <div class="fade-in" style="animation-delay: 0.3s;">
                    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 comment-form">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                            <i class="fas fa-comments text-blue-600 mr-2"></i>
                            Tinggalkan Komentar
                        </h3>
                        
                        @if(session('comment_success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 text-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('comment_success') }}
                            </div>
                        @endif
                        
                        @if(session('comment_error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 text-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ session('comment_error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('items.add-comment') }}" method="POST" class="max-w-2xl mx-auto">
                            @csrf
                            <input type="hidden" name="item_code" value="{{ $item->code ?? '' }}">
                            <input type="hidden" name="item_name" value="{{ $item->name ?? '' }}">
                            
                            <div class="mb-6">
                                <label for="commenter_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user text-blue-600 mr-2"></i>
                                    Nama Kamu:
                                </label>
                                <input type="text" name="commenter_name" id="commenter_name" required
                                       value="{{ $item->name ?? '' }}" readonly
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 cursor-not-allowed comment-input readonly-input">
                                <p class="text-xs text-gray-500 mt-1">Sengaja ku bikin biar gabisa anonim wkwkwk</p>
                            </div>
                            
                            <div class="mb-6">
                                <label for="comment_text" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-comment text-blue-600 mr-2"></i>
                                    Komentar:
                                </label>
                                <textarea name="comment_text" id="comment_text" rows="4" required
                                          placeholder="Tulis komentar kamu di sini..." 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none comment-input"></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200 comment-submit">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Komentar
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Display Comments -->
                @if(isset($comments) && count($comments) > 0)
                <div class="fade-in" style="animation-delay: 0.4s;">
                    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                            <i class="fas fa-comments text-green-600 mr-2"></i>
                            History Komentar
                        </h3>
                        
                        <div class="space-y-4 max-w-3xl mx-auto">
                            @foreach($comments as $comment)
                            <div class="bg-gray-50 rounded-xl p-6 border-l-4 border-blue-500">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="text-lg font-semibold text-gray-900">{{ $comment->commenter_name }}</h4>
                                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-700 leading-relaxed">{{ $comment->comment_text }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            @else
                <!-- No Message Found -->
                <div class="bg-red-100 rounded-2xl shadow-lg p-8 mb-8 text-center">
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Weh ra nemu lek</h3>
                    <p class="text-gray-500 mb-6">Salah ngleboke coe. Jal cek neh, opo Gilang salah ngekei kodene?</p>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="text-center fade-in" style="animation-delay: 0.4s;">
            <a href="{{ route('items.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-xl transition-colors duration-200">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </main>

    <!-- JavaScript for enhanced interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add click effect to buttons
            document.querySelectorAll('button, a').forEach(element => {
                element.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Check if no message and change background to red
            const messageSection = document.querySelector('.message-card') || document.querySelector('.bg-red-100');
            if (messageSection && !messageSection.classList.contains('message-card')) {
                document.body.classList.add('bg-error');
                
                // Add random movement to background
                const body = document.body;
                body.classList.add('moving');
                
                // Function to generate random position
                function getRandomPosition() {
                    const x = Math.floor(Math.random() * 80) + 10; // 10% to 90%
                    const y = Math.floor(Math.random() * 80) + 10; // 10% to 90%
                    return `${x}% ${y}%`;
                }
                
                // Change background position randomly every 2 seconds
                setInterval(() => {
                    const randomPos = getRandomPosition();
                    body.style.backgroundPosition = randomPos;
                }, 2000);
                
                // Also add some mouse movement tracking for extra randomness
                document.addEventListener('mousemove', (e) => {
                    if (Math.random() < 0.1) { // 10% chance on mouse move
                        const x = (e.clientX / window.innerWidth) * 100;
                        const y = (e.clientY / window.innerHeight) * 100;
                        body.style.backgroundPosition = `${x}% ${y}%`;
                    }
                });

                // Comment form enhancements
                const commentText = document.getElementById('comment_text');
                const commenterName = document.getElementById('commenter_name');
                
                if (commentText) {
                    // Add character counter
                    const charCounter = document.createElement('div');
                    charCounter.className = 'text-sm text-gray-500 mt-1 text-right';
                    charCounter.textContent = '0/1000 karakter';
                    commentText.parentNode.appendChild(charCounter);
                    
                    commentText.addEventListener('input', function() {
                        const length = this.value.length;
                        charCounter.textContent = `${length}/1000 karakter`;
                        
                        if (length > 800) {
                            charCounter.className = 'text-sm text-orange-500 mt-1 text-right';
                        } else if (length > 900) {
                            charCounter.className = 'text-sm text-red-500 mt-1 text-right';
                        } else {
                            charCounter.className = 'text-sm text-gray-500 mt-1 text-right';
                        }
                    });
                }
                
                // Remove validation for commenter name since it's now readonly and auto-filled
            }
        });
    </script>
</body>
</html>