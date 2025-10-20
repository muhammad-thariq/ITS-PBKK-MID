<x-app-layout>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8 pb-2 mt-8 px-4">

      <div class="flex mt-6 justify-between items-center">
          <h2 class="font-semibold text-xl text-white">Edit Product</h2>
          {{-- @include('products.partials.delete-product') --}}
      </div>

      <div class="mt-4" x-data="{ imageUrl: '{{ $game->cover_url }}' }">
          {{-- <form enctype="multipart/form-data" method="POST" action="{{ route('products.update', $product->id) }}" class="flex flex-col sm:flex-row gap-8"> --}}
            @csrf
            @method('PUT')

            <div class="sm:w-1/2">
                <img :src="imageUrl" class="rounded-md w-[592] h-[592] object-cover" alt="">
            </div>

            <div class="w-full sm:w-1/2">
                <div class="mt-4">
                    <p class="text-white">Edit Photo</p>
                    <x-input-label for="Photo" :value="__('')" />
                        <x-text-input 
                        id="Photo" 
                        class="block mt-1 w-full border p-2 bg-white" 
                        type="file" 
                        accept="image/*"
                        name="Photo" 
                        @change="imageUrl = URL.createObjectURL($event.target.files[0])" 
                    />
                    {{-- <x-input-error :messages="$errors->get('Photo')" class="mt-2" /> --}}
                </div>
                
                <div class="mt-4">  
                    <p class="text-white">Edit Name</p>
                    <x-input-label for="Name" :value="__('')" />
                    <x-text-input id="Name" class="block mt-1 w-full" type="text" name="Name" :value="$product->Name"
                        required />
                    <x-input-error :messages="$errors->get('Name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <p class="text-white">Edit Price</p>
                    <x-input-label for="Price" :value="__('')" />
                    <x-text-input id="Price" class="block mt-1 w-full" type="text" name="Price"
                        :value="$product->Price" required />
                    <x-input-error :messages="$errors->get('Price')" class="mt-2" />
                </div>


                <br>
                <x-primary-button class="justify-center w-full mt-4 ">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>

          </form>
      </div>

  </div>
</x-app-layout>