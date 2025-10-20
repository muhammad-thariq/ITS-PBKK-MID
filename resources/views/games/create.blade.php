<x-app-layout>
  <div class="max-w-7xl mx-auto px-8"
  x-data="{ imageUrl: null, preview(e){ const f=e.target.files?.[0]; if(!f) return; imageUrl = URL.createObjectURL(f); } }">
    <div class="flex flex-col md:flex-row my-9 items-start md:items-center justify-between px-6">
      <h2 class="text-white text-3xl font-semibold mb-4 md:mb-0">Create Products</h2>
    
      <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
        <a href="{{ route('games.create') }}" class="w-full md:w-auto">
          <button class="bg-white px-10 py-2 rounded-md font-semibold hover:bg-black hover:text-white hover:outline-none hover:ring-2 hover:ring-white hover:ring-offset-2 transition ease-in-out duration-150 w-full md:w-auto text-center">+ Add</button>
        </a>
      </div>
      
    </div>
    <form method="POST" action="{{ route('games.store') }}" enctype="multipart/form-data"
          class="flex flex-col sm:flex-row gap-8"
          x-data="{
            imageUrl: null,
            preview(e) {
              const file = e.target.files?.[0];
              if (!file) { this.imageUrl = null; return; }
              // Optional size guard (2MB)
              if (file.size > 2 * 1024 * 1024) {
                alert('Image must be ≤ 2MB');
                e.target.value = '';
                this.imageUrl = null;
                return;
              }
              this.imageUrl = URL.createObjectURL(file);
            }
          }">
      @csrf

      <!-- Left: Image preview -->
      <div class="sm:w-1/2 pl-4">
        <img x-show="imageUrl" :src="imageUrl" alt="preview"
            class="rounded-md w-full aspect-square object-cover" />
        <div x-show="!imageUrl"
            class="rounded-md w-full aspect-square bg-gray-100 flex items-center justify-center text-gray-400">
          No Image
        </div>
      </div>

      <!-- Right: Fillable area (white card with a visible black frame) -->
      <div class="w-full sm:w-1/2 pr-4">
        <!-- outer frame -->
        <div class="rounded-xl bg-black p-[2px]"> 
          <!-- inner white card -->
          <div class="bg-white rounded-lg p-6 space-y-4 shadow-sm">
            <div>
              <label class="block text-sm font-medium text-gray-900">Title</label>
              <input name="title" value="{{ old('title') }}" required
                    class="mt-1 w-full rounded-md border border-black bg-white
                            focus:border-black focus:ring-black" />
              @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-900">Genre</label>
                <input name="genre" value="{{ old('genre') }}"
                      class="mt-1 w-full rounded-md border border-black bg-white
                              focus:border-black focus:ring-black" />
                @error('genre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-900">Release Year</label>
                <input type="number" name="release_year" value="{{ old('release_year') }}"
                      class="mt-1 w-full rounded-md border border-black bg-white
                              focus:border-black focus:ring-black" />
                @error('release_year') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-900">Description</label>
              <textarea name="description" rows="4"
                        class="mt-1 w-full rounded-md border border-black bg-white
                              focus:border-black focus:ring-black">{{ old('description') }}</textarea>
              @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-900">Cover Image</label>
              <input type="file" name="cover" accept="image/*" @change="preview"
                    class="mt-1 w-full rounded-md border border-black
                            file:mr-4 file:rounded-md file:border-0 file:bg-indigo-600
                            file:px-3 file:py-2 file:text-white hover:file:bg-indigo-700
                            focus:border-black focus:ring-black" />
              @error('cover') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror  
              <p class="text-xs text-gray-500 mt-1">JPG/PNG/WebP up to 2MB</p>
            </div>

            <div class="pt-2 flex flex-wrap gap-2">
              <button type="submit"
                      class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                Submit
              </button>
              <a href="{{ route('games.index') }}"
                class="px-4 py-2 rounded-md border border-black/40 hover:bg-gray-100">
                Cancel
              </a>
            </div>
          </div>
        </div>
      </div>


  </div>
</x-app-layout>
