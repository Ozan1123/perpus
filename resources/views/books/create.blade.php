@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-2xl p-8 mb-8 shadow-lg relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full transform translate-x-16 -translate-y-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-5 rounded-full transform -translate-x-12 translate-y-12"></div>
        
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center text-white">
                <div>
                    <h2 class="text-3xl font-bold mb-2 flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Buku Baru
                    </h2>
                    <p class="text-green-100 text-lg">Tambahkan buku ke koleksi perpustakaan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white rounded-xl shadow-lg p-4 mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.books.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Manajemen Buku
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah Buku</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" id="bookForm">
            @csrf

            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="space-y-6">
                        <!-- Title -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Judul Buku *
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Masukkan judul buku"
                                   required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-150">
                            @error('title')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Penulis *
                            </label>
                            <input type="text" 
                                   name="author" 
                                   value="{{ old('author') }}"
                                   placeholder="Masukkan nama penulis"
                                   required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-150">
                            @error('author')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Deskripsi (Opsional)
                            </label>
                            <textarea name="description" 
                                      rows="4"
                                      placeholder="Masukkan deskripsi singkat tentang buku"
                                      class="block w-full px-4 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-150 resize-none">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- ISBN (Optional) -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                ISBN (Opsional)
                            </label>
                            <input type="text" 
                                   name="isbn" 
                                   value="{{ old('isbn') }}"
                                   placeholder="Contoh: 978-0-123456-47-2"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-150">
                            @error('isbn')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Cover Upload -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Cover Buku
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors duration-150" id="dropZone">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="cover" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                            <span>Upload cover buku</span>
                                            <input id="cover" name="cover" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF maksimal 2MB</p>
                                </div>
                            </div>
                            @error('cover')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column - Preview -->
                    <div class="lg:pl-8">
                        <div class="sticky top-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Preview Buku
                            </h3>
                            
                            <!-- Book Preview Card -->
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                <!-- Cover Preview -->
                                <div class="text-center mb-4">
                                    <div id="coverPreview" class="w-48 h-64 bg-gray-200 rounded-lg flex items-center justify-center mx-auto shadow-lg">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <img id="previewImage" class="w-48 h-64 object-cover rounded-lg shadow-lg mx-auto hidden">
                                </div>

                                <!-- Book Info Preview -->
                                <div class="space-y-3">
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Judul:</label>
                                        <div id="titlePreview" class="text-lg font-semibold text-gray-900 min-h-[1.75rem]">-</div>
                                    </div>
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Penulis:</label>
                                        <div id="authorPreview" class="text-sm text-gray-700 min-h-[1.25rem]">-</div>
                                    </div>
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">Deskripsi:</label>
                                        <div id="descriptionPreview" class="text-sm text-gray-600 min-h-[1.25rem]">-</div>
                                    </div>
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">ISBN:</label>
                                        <div id="isbnPreview" class="text-sm text-gray-600 min-h-[1.25rem]">-</div>
                                    </div>
                                    <div class="pt-3 border-t border-gray-200">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Buku Baru
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tips Card -->
                            <div class="mt-6 bg-blue-50 rounded-lg p-4 border border-blue-200">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-blue-800">Tips untuk buku yang baik:</h3>
                                        <ul class="mt-2 text-sm text-blue-700 list-disc list-inside space-y-1">
                                            <li>Gunakan judul yang jelas dan deskriptif</li>
                                            <li>Upload cover dengan kualitas baik</li>
                                            <li>Tambahkan deskripsi singkat yang menarik</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-gray-50 px-8 py-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div class="text-sm text-gray-600">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-red-600">*</span> Menandakan field yang wajib diisi
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.books.index') }}"
                       class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Buku
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript for real-time preview and interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get form elements
            const titleInput = document.querySelector('input[name="title"]');
            const authorInput = document.querySelector('input[name="author"]');
            const descriptionInput = document.querySelector('textarea[name="description"]');
            const isbnInput = document.querySelector('input[name="isbn"]');
            const coverInput = document.getElementById('cover');
            const dropZone = document.getElementById('dropZone');

            // Get preview elements
            const titlePreview = document.getElementById('titlePreview');
            const authorPreview = document.getElementById('authorPreview');
            const descriptionPreview = document.getElementById('descriptionPreview');
            const isbnPreview = document.getElementById('isbnPreview');
            const coverPreview = document.getElementById('coverPreview');
            const previewImage = document.getElementById('previewImage');

            // Real-time preview updates
            function updatePreview() {
                titlePreview.textContent = titleInput.value || '-';
                authorPreview.textContent = authorInput.value || '-';
                descriptionPreview.textContent = descriptionInput.value || '-';
                isbnPreview.textContent = isbnInput.value || '-';
            }

            // Add event listeners for real-time updates
            titleInput.addEventListener('input', updatePreview);
            authorInput.addEventListener('input', updatePreview);
            descriptionInput.addEventListener('input', updatePreview);
            isbnInput.addEventListener('input', updatePreview);

            // File upload handling
            function handleFile(file) {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        coverPreview.classList.add('hidden');
                        previewImage.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }

            // File input change
            coverInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    handleFile(file);
                }
            });

            // Drag and drop functionality
            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropZone.classList.add('border-green-500', 'bg-green-50');
            });

            dropZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                dropZone.classList.remove('border-green-500', 'bg-green-50');
            });

            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZone.classList.remove('border-green-500', 'bg-green-50');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    coverInput.files = files;
                    handleFile(files[0]);
                }
            });

            // Form animations
            const formElements = document.querySelectorAll('.form-group');
            formElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    el.style.transition = 'all 0.4s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Enhanced focus states
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.form-group').classList.add('transform', 'scale-[1.02]');
                });
                input.addEventListener('blur', function() {
                    this.closest('.form-group').classList.remove('transform', 'scale-[1.02]');
                });
            });

            // Form validation enhancement
            const form = document.getElementById('bookForm');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('input[required], textarea[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500', 'ring-2', 'ring-red-500');
                        
                        setTimeout(() => {
                            field.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
                        }, 3000);
                    } else {
                        field.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    
                    // Show error message
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-50';
                    errorDiv.innerHTML = `
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Mohon lengkapi semua field yang wajib diisi!</span>
                            <button type="button" class="ml-4 text-red-500 hover:text-red-700" onclick="this.parentElement.parentElement.remove()">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    `;
                    document.body.appendChild(errorDiv);

                    // Auto remove error after 5 seconds
                    setTimeout(() => {
                        if (errorDiv.parentNode) {
                            errorDiv.remove();
                        }
                    }, 5000);

                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector('input[required]:invalid, textarea[required]:invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
                } else {
                    // Show loading state
                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalText = submitButton.innerHTML;
                    
                    submitButton.disabled = true;
                    submitButton.innerHTML = `
                        <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Menyimpan...
                    `;
                }
            });

            // Character counter for description
            const maxLength = 500;
            const charCounter = document.createElement('div');
            charCounter.className = 'text-xs text-gray-500 mt-1 text-right';
            charCounter.textContent = `0 / ${maxLength} karakter`;
            descriptionInput.parentNode.appendChild(charCounter);

            descriptionInput.addEventListener('input', function() {
                const length = this.value.length;
                charCounter.textContent = `${length} / ${maxLength} karakter`;
                
                if (length > maxLength) {
                    charCounter.classList.add('text-red-500');
                    this.classList.add('border-red-300');
                } else if (length > maxLength * 0.8) {
                    charCounter.classList.remove('text-red-500');
                    charCounter.classList.add('text-yellow-600');
                    this.classList.remove('border-red-300');
                } else {
                    charCounter.classList.remove('text-red-500', 'text-yellow-600');
                    this.classList.remove('border-red-300');
                }
            });

            // Initialize preview
            updatePreview();

            // Success message animation (if needed)
            const successMessage = document.querySelector('.alert-success');
            if (successMessage) {
                successMessage.style.opacity = '0';
                successMessage.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    successMessage.style.transition = 'all 0.4s ease';
                    successMessage.style.opacity = '1';
                    successMessage.style.transform = 'translateY(0)';
                }, 100);
            }

            // Auto-save to localStorage (optional)
            const autoSaveFields = ['title', 'author', 'description', 'isbn'];
            
            function autoSave() {
                const formData = {};
                autoSaveFields.forEach(fieldName => {
                    const field = document.querySelector(`[name="${fieldName}"]`);
                    if (field && field.value) {
                        formData[fieldName] = field.value;
                    }
                });
                
                if (Object.keys(formData).length > 0) {
                    localStorage.setItem('book_form_draft', JSON.stringify(formData));
                }
            }

            function loadAutoSave() {
                const saved = localStorage.getItem('book_form_draft');
                if (saved) {
                    try {
                        const formData = JSON.parse(saved);
                        Object.keys(formData).forEach(fieldName => {
                            const field = document.querySelector(`[name="${fieldName}"]`);
                            if (field && !field.value) {
                                field.value = formData[fieldName];
                            }
                        });
                        updatePreview();
                    } catch (e) {
                        console.warn('Could not load auto-saved data');
                    }
                }
            }

            // Auto-save every 30 seconds
            setInterval(autoSave, 30000);

            // Load auto-saved data on page load
            loadAutoSave();

            // Clear auto-save on successful submit
            form.addEventListener('submit', function() {
                setTimeout(() => {
                    localStorage.removeItem('book_form_draft');
                }, 1000);
            });
        });
    </script>
@endsection