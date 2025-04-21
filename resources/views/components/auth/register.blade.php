<x-layouts.app>
   @if(session("success") || $errors->any())
   <x-partials.alert message="Validation Error/s"/>
   @endif
   <!-- ----- -->
   <section class="pt-4 bg-gray-50 dark:bg-gray-900">
      <div class="w-full flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
         <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
            Notepaper
         </a>
         <div class="w-2/3 2xl:w-1/2 bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
               <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Create an account
               </h1>
               <!--  -->
               <form class="space-y-4 md:space-y-6" action="{{ route('storeRegister') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div>
                     <input type="name" name="name" id="name" class="registerInput" placeholder="Your Full Name"  value="{{ old('name') }}">
                        @error('name')
                           <div class="text-red-600">{{ $message }}</div>
                        @enderror
                  </div>
                  <!--  -->
                  <div class="flex gap-4">
                     <div class="w-full">
                        <input type="email" name="email" id="email" class=" registerInput" placeholder="Your Email" value="{{ old('email') }}">
                        @error('email')
                           <div class="text-red-600">{{ $validationMessage ?? $message }}</div>
                        @enderror
                        <span id="error_email" class="text-red-600"></span>
                     </div>
                     <!--  -->
                     <div class="w-full">
                        <input type="username" name="username" id="username" class="registerInput" placeholder="Choose a unique username" value="{{ old('username') }}">
                           @error('username')
                              <div class="text-red-600">{{ $validationMessage ?? $message }}</div>
                           @enderror
                        
                        <span id="error_username"></span>
                     </div>
                  </div>
                  <!--  -->
                  <div>
                     <input type="password" name="password" id="password" placeholder="Type Password" class="registerInput" value="{{ old('password') }}">

                        @error('password')
                           <div class="text-red-600">{{ $validationMessage ?? $message }}</div>
                        @enderror
                  </div>
                  <!--  -->
                  <div>
                     <input type="password" name="password_confirmation" id="confirm-password" placeholder="Re-Type Password" class="registerInput" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                           <div class="text-red-600">{{ $validationMessage ?? $message }}</div>
                        @enderror
                  </div>
                  <!--  -->
                  <div>
                     <input class="block w-full bg-gray-50 dark:bg-gray-700 rounded-lg" id="multiple_files" type="file" name="image">

                        @error('image')
                           <div class="text-red-600">{{ $validationMessage ?? $message }}</div>
                        @enderror
                  </div>
                  <!--  -->
                  <div class="flex items-start">
                     <div class="flex items-center h-5">
                        <input id="terms" name="terms" aria-describedby="terms" type="checkbox" value="true" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required>
                     </div>
                     <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                     </div>
                  </div>

                  <button type="submit" id="register" class="saveButton">Create an account</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                     Already have an account? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                  </p>
                  
               </form>
            </div>
         </div>
      </div>
   </section>
</x-layouts.app>
<!-- --------------- -->
<script>
   $(document).ready(function () {
      const _token = $('input[name="_token"]').val();

      function checkAvailability(type, value, route, errorSelector, inputSelector) {
         let isValid = true;

         if (type === 'email') {
            const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,10})+$/;
            if (!filter.test(value)) {
               $(errorSelector).html('<label class="text-red-500">Invalid Email Format (TLD length mismacthed)</label>');
               $(inputSelector).addClass('has-error');
               $('#register').attr('disabled', 'disabled');
               return;
            }
         } else if (type === 'username') {
            if (value.length < 4) {
               $(errorSelector).html('<label class="text-red-500">Username must be greater than 3 characters</label>');
               $(inputSelector).addClass('has-error');
               $('#register').attr('disabled', 'disabled');
               return;
            }
         }

         // AJAX Check
         $.ajax({
            url: route,
            method: "POST",
            data: { [type]: value, _token: _token },
            success: function (result) {
               if (result.status === 'unique') {
                  $(errorSelector).html(`<label class="text-green-400">${type.charAt(0).toUpperCase() + type.slice(1)} Available</label>`);
                  $(inputSelector).removeClass('has-error');
                  $('#register').attr('disabled', false);
               } else {
                  $(errorSelector).html(`<label class="text-red-400">${type.charAt(0).toUpperCase() + type.slice(1)} already taken</label>`);
                  $(inputSelector).addClass('has-error');
                  $('#register').attr('disabled', 'disabled');
               }
            }
         });
      }

      // Bind keyup events
      $('#email').on('keyup', function () {
         const email = $(this).val();
         checkAvailability('email', email, "{{ route('avaibality.email') }}", '#error_email', '#email');
      });

      $('#username').on('keyup', function () {
         const username = $(this).val();
         checkAvailability('username', username, "{{ route('avaibality.username') }}", '#error_username', '#username');
      });
   });
</script>
