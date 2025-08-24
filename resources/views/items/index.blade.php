<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surprise - Masukkan Kode Anda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .search-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .search-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }
        
        .cursor-blink {
            animation: blink 1.2s infinite;
        }
        
        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen flex items-center justify-center">
        <!-- Search Section -->
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="text-3xl font-semibold text-slate-800 mb-8">Batch 6 - Dumb</h3>
            
            <!-- Simplified Search Form -->
            <form action="{{ route('items.search') }}" method="GET" class="flex items-center space-x-2 max-w-md mx-auto">
                <input 
                    type="text" 
                    name="code" 
                    placeholder="Masukin kode kalian!" 
                    class="w-96 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    required
                >
                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white px-6 py-3 rounded-r-lg hover:bg-indigo-700 transition-colors"
                >
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </main>

    <!-- Apology Message Section - Fixed at bottom -->
    <div class="fixed bottom-5 left-0 right-0 fade-in" style="animation-delay: 0.6s;">
        <div class="max-w-4xl mx-auto text-center">
            <p class="text-slate-700 text-lg leading-relaxed font-medium">
                <span id="typewriter-text"></span><span class="cursor-blink text-indigo-600">|</span>
            </p>
        </div>
    </div>

    <!-- JavaScript for enhanced interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Typewriter effect with delete and retype
            function typeWriter(element, text, speed = 100) {
                let i = 0;
                element.innerHTML = '';
                
                function type() {
                    if (i < text.length) {
                        element.innerHTML += text.charAt(i);
                        i++;
                        setTimeout(type, speed);
                    } else {
                        setTimeout(() => deleteText(), 2000);
                    }
                }
                
                type();
            }
            
            function deleteText() {
                const element = document.getElementById('typewriter-text');
                let text = element.innerHTML;
                
                function deleteChar() {
                    if (text.length > 0) {
                        text = text.slice(0, -1);
                        element.innerHTML = text;
                        setTimeout(deleteChar, 50);
                    } else {
                        setTimeout(() => typeNewText(), 1000);
                    }
                }
                
                deleteChar();
            }
            
            function typeNewText() {
                const element = document.getElementById('typewriter-text');
                const newText = "Terima kasih sudah mau memaafkan aku! 😊";
                let i = 0;
                
                function type() {
                    if (i < newText.length) {
                        element.innerHTML += newText.charAt(i);
                        i++;
                        setTimeout(type, 80);
                    } else {
                        setTimeout(() => restartCycle(), 3000);
                    }
                }
                
                type();
            }
            
            function restartCycle() {
                const element = document.getElementById('typewriter-text');
                element.innerHTML = '';
                setTimeout(() => {
                    const text = "Hello guys, aku minta maaf ya kalau selama ini banyak salah";
                    typeWriter(element, text, 80);
                }, 500);
            }
            
            // Start typewriter effect
            setTimeout(() => {
                const typewriterElement = document.getElementById('typewriter-text');
                const text = "Hello guys, aku minta maaf ya kalau selama ini banyak salah";
                typeWriter(typewriterElement, text, 80);
            }, 1000);

            // Add loading state to search form
            const searchForm = document.querySelector('form');
            const searchButton = searchForm.querySelector('button[type="submit"]');
            
            searchForm.addEventListener('submit', function() {
                searchButton.innerHTML = '<i class="fas fa-spinner fa-spin text-2xl"></i>';
                searchButton.disabled = true;
            });

            // Auto-focus search input
            const searchInput = document.querySelector('input[name="code"]');
            if (searchInput) {
                searchInput.focus();
            }
        });
    </script>
</body>
</html>
