<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surprise - Admin Panel</title>
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
        
        .upload-form {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .upload-form:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen">

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-12 fade-in">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-6">
                <i class="fas fa-gift text-3xl text-blue-600"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Surprise Admin Panel</h1>
            <p class="text-lg text-gray-600">Kelola kode dan foto untuk setiap orang</p>
        </div>

        <!-- Photo Upload Form -->
        <div class="fade-in" style="animation-delay: 0.2s;">
            <div class="upload-form rounded-2xl shadow-2xl p-8 mb-8 text-white">
                <h2 class="text-2xl font-bold mb-6 text-center">Upload Foto</h2>
                
                @if(session('success'))
                    <div class="bg-green-500 bg-opacity-20 rounded-lg p-4 mb-6 text-center">
                        <p class="text-green-100">{{ session('success') }}</p>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-500 bg-opacity-20 rounded-lg p-4 mb-6 text-center">
                        <p class="text-red-100">{{ session('error') }}</p>
                    </div>
                @endif
                
                <form action="{{ route('items.upload-photo') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto">
                    @csrf
                    <div class="mb-6">
                        <label for="code" class="block text-sm font-medium mb-2">Kode Orang:</label>
                        <select name="code" id="code" required class="w-full px-4 py-2 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Pilih kode...</option>
                            @foreach($items as $item)
                                <option value="{{ $item->code }}">{{ $item->code }} - {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="photo" class="block text-sm font-medium mb-2">Pilih Foto:</label>
                        <input type="file" name="photo" id="photo" accept="image/*" required 
                               class="w-full px-4 py-2 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <p class="text-xs text-blue-100 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                    </div>
                    
                    <button type="submit" class="w-full bg-white text-blue-600 py-3 px-6 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Foto
                    </button>
                </form>
            </div>
        </div>

        <!-- Search Form -->
        <div class="fade-in" style="animation-delay: 0.4s;">
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Cari Kode</h2>
                
                <form action="{{ route('items.search') }}" method="GET" class="max-w-md mx-auto">
                    <div class="mb-6">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Masukkan Kode:</label>
                        <input type="text" name="code" id="search" value="{{ $query ?? '' }}" 
                               placeholder="Ketik kode di sini..." required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>
                        Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Items List -->
        <div class="fade-in" style="animation-delay: 0.6s;">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Daftar Semua Kode</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                            <div class="text-center">
                                @if($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" 
                                         alt="Foto {{ $item->name }}" 
                                         class="w-20 h-20 rounded-full mx-auto mb-4 object-cover border-2 border-blue-200">
                                @else
                                    <div class="w-20 h-20 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                                        <i class="fas fa-user text-2xl text-blue-600"></i>
                                    </div>
                                @endif
                                
                                <h3 class="font-semibold text-gray-900 mb-2">{{ $item->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2">Kode: <span class="font-mono bg-gray-200 px-2 py-1 rounded">{{ $item->code }}</span></p>
                                <p class="text-xs text-gray-500">{{ Str::limit($item->message, 50) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript for enhanced interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to buttons
            document.querySelectorAll('button, a').forEach(element => {
                element.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });
    </script>
</body>
</html>
