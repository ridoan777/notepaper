<nav class="w-full z-50 bg-white px-4 border-gray-200 dark:bg-gray-800 shadow-md dark:shadow-gray-700 fixed">
  <div class="max-w-screen-xl p-2 flex flex-wrap items-center justify-between mx-auto">

      <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
         <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
         <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">NotePaper</span>
      </a>
   <!-- USER DROPDOWN -->
      <div class="flex items-center gap-4 md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

      <!-- Dark-Modde Toggle Button -->
         <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700  cursor-pointer rounded-full text-sm p-2.5">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            <!--  -->
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
         </button>
      <!-- Dark-Modde Toggle Button -->

      <!-- Dropdown Toggle Icon -->
         <button type="button" class="" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            @if(!Auth::user())
               <img class="w-8 h-8 rounded-full cursor-pointer" src="{{ asset('/pictures/dummy_user.jpg') }}" alt="user photo">
            @endif
            @if(Auth::user())
               <img class="w-8 h-8 rounded-full cursor-pointer" src="{{ asset(Auth::user()->image) }}" alt="user photo">
            @endif
         </button>
      <!-- Dropdown Toggle Icon -->

      <!-- Dropdown menu -->
         <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
            @if(Auth::user())
            <div class="px-4 py-3">
               <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
               <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
               <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->username }}</span>
            </div>
            <!--  -->
            <ul class="py-2" aria-labelledby="user-menu-button">
               <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
               </li>
               @endif
               <li>
                  <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
               </li>
            </ul>
         </div>
         <!--  -->
         <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
         </button>
      <!-- Dropdown menu -->
      </div>
   <!-- USER DROPDOWN -->

   <!-- MAIN MENU -->
   @if(Auth::user())
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user" >
         <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-whitedark:border-gray-700">
            <li>
               <a href="/" wire:navigate class="navButton">All Notes</a>
            </li>
            <li>
               <a href="/note" wire:navigate class="navButton">Blank Note</a>
            </li>
            <li>
               <a href="/note/{id}" wire:navigate class="navButton">Edit Note</a>
            </li>
         </ul>
      </div>
   @endif
   <!-- MAIN MENU -->
  </div>

</nav>

<script>
   var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
   var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

   // Change the icons inside the button based on previous settings
   if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      themeToggleLightIcon.classList.remove('hidden');
   } else {
      themeToggleDarkIcon.classList.remove('hidden');
   }

   var themeToggleBtn = document.getElementById('theme-toggle');

   themeToggleBtn.addEventListener('click', function() {

      // toggle icons inside button
      themeToggleDarkIcon.classList.toggle('hidden');
      themeToggleLightIcon.classList.toggle('hidden');

      // if set via local storage previously
      if (localStorage.getItem('color-theme')) {
         if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
         } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
         }

         // if NOT set via local storage previously
      } else {
         if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
         } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
         }
      }

   });
</script>
