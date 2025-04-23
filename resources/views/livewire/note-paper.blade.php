<div class="bg-gray-100 dark:bg-gray-900">

	@if(session("success") || $errors->any())
		<x-partials.alert message="Note Creation Error/s"/>
	@endif
	<!--  -->
	
	<!-- Alert Area  -->
	<div class="mb-4" id="messageArea">
		@if(session('message'))
		<div class="border border-green-400 text-white px-4 py-3 rounded relative block sm:inline opacity-100" role="alert">
			{{ session('message') }}
		</div>
		@endif
		@if(session('errors'))
		<ul>
			<li class="text-blue-500"><b>Error/s:</b></li>
			@foreach (session('errors') as $error)
				<li class="text-red-500">{{ $error[0] }}</li>
			@endforeach
		</ul>
		@elseif(session('error'))
		<div class="text-red-500">{{ session('error') }}</div>
		@endif
	</div>
	<!-- Alert Area -->

	<!-- Main Body -->
	 <div id="mainBody" class="w-full mt-4 flex gap-2">
		<!--  -->
		<div id="right_note" class="w-full">

			<!-- Header Buttons -->
			<div class="mb-4 flex gap-4 justify-between items-center">
				
				<div class="headerLeft w-1/3 bg-red-100">
					<h1 class="text-2xl font-bold text-left">Create a note</h1>
				</div>
				<!--  -->
				<div class="headerRight w-2/3 px-2 flex space-x-4 bg-blue-100">

					<Button type="button" id="copyButton" class="button" >
						{!! \App\Helpers\Fontawesome::copy(['class' => 'w-5 h-5 text-gray-500 dark:text-pink-200']) !!}
					</Button>
					<!--  -->
					<select id="updateFontFamily" class="dropdownSettings h-8">
						<option value="" disabled selected hidden>Font family:</option>
						<option value="Courier New">Courier New (Default)</option>
						<option value="Arial">Arial</option>
						<option value="Verdana">Verdana</option>
						<option value="Helvetica">Helvetica</option>
						<option value="Tahoma">Tahoma</option>
						<option value="Trebuchet MS">Trebuchet MS</option>
						<option value="Times New Roman">Times New Roman</option>
						<option value="Georgia">Georgia</option>
						<option value="Garamond">Garamond</option>
						<option value="Brush Script MT">Brush Script MT</option>
						<option value="Lucida Console">Lucida Console</option>
						<option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
						<option value="Palatino Linotype">Palatino Linotype</option>
						<option value="Impact">Impact</option>
						<option value="Segoe UI">Segoe UI</option>
						<option value="Comic Sans MS">Comic Sans MS</option>
					</select>
					<!--  -->
					<select id="updateFontSize" class="dropdownSettings h-8">
						<option value="" disabled selected hidden>Font size:</option>
						@for ($i = 12; $i <= 32; $i += 2)
							<option value="{{ $i }}px">{{ $i }}px</option>
						@endfor
					</select>
					<!--  -->
					<select id="updateLineHeight" class="dropdownSettings h-8">
						<option value="" disabled selected hidden>Line height:</option>
						@for ($i = 12; $i <= 48; $i += 2)
							<option value="{{ $i }}px">{{ $i }}px</option>
						@endfor
					</select>

				</div>
				

			</div>
			<!--  -->

			<!-- Header Buttons -->

			<!-- Form Area -->
			<form wire:submit.prevent="createNote">
				
				<!-- setting region -->
				 <div class=" gap-4">
					 <input type="text" wire:model="font_family" class="font_family_input" readonly>
					 <input type="text" wire:model="font_size" class="font_size_input" readonly>
					 <input type="text" wire:model="line_height" class="line_height_input" readonly>
					 <input type="text" wire:model="username" readonly>
				 </div>
				<!-- setting region -->

				<!-- text region -->
				<div class="flex justify-between items-center bg-[#FFFFAA]">
					<input type="text" wire:model="main_title" class="mainTitle focus:border-0 focus:border-none" placeholder="Title:" id="mainTitle">
					<!--  -->
					<button type="submit" id="submitButton" class="noteSaveButton">Submits</button>
				</div>
				<!--  -->
				<div class="flex">
					<input type="text" wire:model="secondary_title" class="secondaryTitle focus:border-0 focus:border-none px-4" placeholder="Secondary Title:" id="secondaryTitle">
						<br>
					<input type="text" wire:model="meta_title" class="metaTitle focus:border-0 focus:border-none" placeholder="Meta:" id="meta_title">
				</div>
				<!--  -->
				<div class="flex stripeArea">
					<div class="w-[4%] border-e bg-transparent"></div>
					<textarea wire:model="notes" id="notepad_textarea" class="notepad_textarea"></textarea>
					<br>
				</div>
						 
				
			</form>
			<!-- Form Area -->
			 
		</div>

	 </div>
	<!-- Main Body -->

	<!-- JS -->
	<script>


		// ------------------
	</script>

	<script>
		// see 'resources/js/update-note-style.js' file to listen events for these f()
	</script>
	<!-- JS -->

</div>