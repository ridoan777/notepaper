<div class="bg-gray-100 dark:bg-gray-900">

	<!-- Alert Area  -->
	<div class="w-full transition-opacity duration-1000" id="messageArea">
		@if(session('success'))
		<div class="w-1/3 mx-auto border text-center bg-green-400 border-green-400 text-white px-4 py-3 rounded relative" role="alert">
			<strong class="font-bold">Success!</strong>
			<span class="block sm:inline">{{ session('success') }}</span>
		</div>
		@endif
		@if(session('error'))
		<ul class="w-1/3 mx-auto py-1 px-4 bg-red-400">
			<span class="block sm:inline">{{ session('error') }}</span>
			@error('create_note_error')
			<span class="block sm:inline">{{ session('error') }}</span>
			@enderror
		</ul>
		@endif
		@if($errors->any())
		<ul class="w-1/3 mx-auto py-1 px-4 bg-red-400">
			<!-- <li class="text-white text-center text-xl"><b>{{-- $error --}}</b></li> -->
			@foreach ($errors->all() as $error)
			<li class="text-white">{{ $error }}</li>
			@endforeach
		</ul>
		@endif
	</div>
	<!-- Alert Area -->

	<!-- Main Body -->
	 <div id="mainBody" class="w-full mt-4 flex gap-2">
		<!--  -->
		<div id="right_note" class="w-full">

			<!-- Header Buttons -->
			<div class="mb-4 flex gap-4 justify-between items-center">
				
				<div class="headerLeft w-1/4">
					<h1 class="ml-2 mb-0 text-2xl font-bold text-left text-indigo-900 dark:text-gray-200">Create a note</h1>
				</div>
				<!--  -->
				<div class="headerRight w-3/4 px-2 flex space-x-4">

					<Button type="button" id="copyButton" class="button p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600">
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
					<!--  -->
					<select id="updateGroup" class="dropdownSettings h-8">
						<option value="" disabled selected>Groups:</option>
						@foreach ($userGroups as $group)
							<option value="{{ $group->id }}">{{ $group->group_name }}</option>
						@endforeach
					</select>

				</div>
				

			</div>
			<!--  -->

			<!-- Header Buttons -->

			<!-- Form Area -->
			<form id="noteForm" wire:submit.prevent="createNote">
				
				<!-- setting region -->
				 <div class="hidden gap-4">
					<input type="text" wire:model="font_family" class="font_family_input" readonly>
					<input type="text" wire:model="font_size" class="font_size_input" readonly>
					<input type="text" wire:model="line_height" class="line_height_input" readonly>
					<input type="text" wire:model="username" readonly>
					<input type="text" wire:model="g_id" class="group_input" readonly>
					
				 </div>
				<!-- setting region -->

				<!-- text region -->
				<div class="mr-2 flex justify-between items-center bg-[#FFFFAA]">

					<!--  -->
					<input type="text" wire:model="main_title" class="mainTitle focus:border-0 focus:border-none" placeholder="Title:" id="mainTitle">
					<!--  -->
					<button type="submit" id="submitButton" class="noteSaveButton">Save</button>

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
					<textarea wire:model="notes" id="notepad_textarea" class="notepad_textarea" style=" font-size: {{ $font_size }}; line-height: {{ $line_height }}; font-family: {{ $font_family }}"></textarea>
					<br>
					
				</div>
				
						 
				
			</form>
			
			<!-- Form Area -->
			 
		</div>

	 </div>
	<!-- Main Body -->
<style>
	#messageArea {
		max-height: 200px; /* Initial height guess */
		overflow: hidden;
		transition: opacity 1s ease, max-height 1s ease;
	}
	/* #notepad_textarea */

</style>


</div>