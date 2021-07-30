<x-layout>
  <section class="px-6 py-8">

  <x-panel class="max-w-sm mx-auto">

  <form method="POST" action="/admin/posts">
    @csrf 

    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="title">Title</label>
      <input class="border border-gray-400" p-2 w-full 
      type="text"
      name="title"
      id="title"
      required
      >

      @error('title')
       <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
      @enderror
    </div>
    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="slug">Slug</label>
      <input class="border border-gray-400" p-2 w-full 
      type="text"
      name="slug"
      id="slug"
      required
      >

      @error('slug')
       <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
      @enderror
    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="excerpt">Excerpt</label>
      <input class="border border-gray-400" p-2 w-full 
      type="text"
      name="excerpt"
      id="excerpt"
      required
      >

      @error('excerpt')
       <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
      @enderror
    </div>
    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="body">Body</label>
      <input class="border border-gray-400" p-2 w-full 
      type="text"
      name="body"
      id="body"
      required
      >

      @error('body')
       <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
      @enderror
    </div>
    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="category_id">Category</label>
      <select name="category_id" id="category">
        @php
          $categories = \App\Models\Category::all(); 
        @endphp

        @foreach($categories as $category)
         <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
        @endforeach
        <option value="personal">Personal</option>
      </select>
      

      @error('category')
       <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
      @enderror
      <br><br>
    <x-submit-button>publish</x-button>
   </form>
 </x-panel>
  </section>
</x-layout>