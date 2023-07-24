 <x-app-layout :meta-title="$post->meta_title ?: $post->title" :meta-description="$post->meta_description">
     <!-- Post Section -->
     <section class="flex flex-col items-center w-full px-3 md:w-2/3">

         <article class="flex flex-col my-4 shadow">
             <!-- Article Image -->
             <a href="#" class="hover:opacity-75">
                 <img src="{{ $post->thumbnail }}">
             </a>
             <div class="flex flex-col justify-start p-6 bg-white">
                 <div class="flex gap-4">
                     @foreach ($post->categories as $catagory)
                         <a href="{{ route('post.show', $post) }}"
                             class="pb-4 text-sm font-bold text-blue-700 uppercase">{{ $catagory->title }}</a>
                     @endforeach
                 </div>
                 {{-- To display all the categories of a post --}}
                 <h1 class="pb-4 text-sm font-bold text-blue-700 uppercase">{{ $post->title }}</h1>
                 <p href="#" class="pb-8 text-sm">
                     By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>,
                     Published on
                     {{ $post->getFormatedDate() }} | {{ $post->human_read_time }}
                 </p>
                 <div>
                     {!! $post->body !!}
                 </div>

                 {{-- <livewire:upvote-downvote :post='"$post"/> --}}
                 @livewire('upvote-downvote', ['post' => $post])
             </div>
         </article>

         {{-- Next and Previous buttons --}}
         <div class="flex w-full pt-6">
             <div class="w-1/2">
                 @if ($previous)
                     <a href="{{ route('post.show', $previous) }}"
                         class="block w-full p-6 text-left bg-white shadow hover:shadow-md">
                         <p class="flex items-center text-lg font-bold text-blue-800">
                             <i class="pr-1 fas fa-arrow-left"></i>
                             Previous
                         </p>
                         <p class="pt-2">{{ Illuminate\Support\Str::words($previous->title, 5) }}</p>
                         {{-- To limit the number of words to be displayed --}}
                     </a>
                 @endif
             </div>
             <div class="w-1/2">
                 @if ($next)
                     <a href="{{ route('post.show', $next) }}"
                         class="block w-full p-6 text-right bg-white shadow hover:shadow-md">
                         <p class="flex items-center justify-end text-lg font-bold text-blue-800">Next
                             <i class="pl-1 fas fa-arrow-right"></i>
                         </p>
                         <p class="pt-2">{{ Illuminate\Support\Str::words($next->title, 5) }}</p>
                         {{-- To limit the number of words to be displayed --}}
                     </a>
                 @endif
             </div>
         </div>

         {{-- <div class="flex flex-col w-full p-6 mt-10 mb-10 text-center bg-white shadow md:text-left md:flex-row">
             <div class="flex justify-center w-full pb-4 md:w-1/5 md:justify-start">
                 <img src="https://source.unsplash.com/collection/1346951/150x150?sig=1"
                     class="w-32 h-32 rounded-full shadow">
             </div>
             <div class="flex flex-col justify-center flex-1 md:justify-start">
                <p class="text-2xl font-semibold">David</p>
                <p class="pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel neque non
                    libero suscipit suscipit eu eu urna.</p>
                <div
                    class="flex items-center justify-center pt-4 text-2xl text-blue-800 no-underline md:justify-start">
                    <a class="" href="#">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
         </div> --}}

     </section>
     <x-sidebar />
 </x-app-layout>
