<div>
	<!-- Alert Area  -->
	<div class="w-full transition-opacity duration-1000" id="messageArea">
		@if(session('success'))
		<div class="w-1/3 mx-auto border text-center bg-green-400 border-green-400 text-white px-4 py-3 relative rounded-lg" role="alert">
			<strong class="font-bold">Success!</strong>
			<span class="block sm:inline" id="successMssg">{{ session('success') }}</span>
		</div>
		@endif
		@if($errors->any())
		<ul class="w-1/3 mx-auto py-1 px-4 bg-red-400 rounded-lg">
			<li class="text-white text-center text-xl"><b>Validation Error/s:</b></li>
			@foreach ($errors->all() as $error)
			<li class="text-white text-center" id="errorMssg">{{ $error }}</li>
			@endforeach
		</ul>
		@endif
	</div>
	<!-- Alert Area -->

	<!-- Main Body -->
	<div id="mainBody" class="w-full mt-4">

			<!-- Header Buttons -->
			<div class="mb-4 flex gap-2 justify-start items-center">
				
				<h1 class="w-96 mb-0 text-2xl dark:text-white font-bold text-left leading-[1]">Edit your note</h1>
				<!--  -->
				<div class="flex gap-4 justify-center items-center">

					<Button type="button" id="copyButton" class="button" onclick="getTextCopied()">
						{!! \App\Helpers\Fontawesome::copy(['class' => 'w-5 h-5 text-gray-500 dark:text-gray-200']) !!}
					</Button>
					<!--  -->
					<select id="updateFontFamily" class="dropdownSettings h-8">
						<option value="" disabled selected hidden>Font family:</option>
						<option onclick="updateFontFamily('Courier New')">Courier New (Default)</option>
						<option onclick="updateFontFamily('Arial')">Arial</option>
						<option onclick="updateFontFamily('Verdana')">Verdana</option>
						<option onclick="updateFontFamily('Helvetica')">Helvetica</option>
						<option onclick="updateFontFamily('Tahoma')">Tahoma</option>
						<option onclick="updateFontFamily('Trebuchet MS')">Trebuchet MS</option>
						<option onclick="updateFontFamily('Times New Roman')">Times New Roman</option>
						<option onclick="updateFontFamily('Georgia')">Georgia</option>
						<option onclick="updateFontFamily('Garamond')">Garamond</option>
						<option onclick="updateFontFamily('Brush Script MT')">Brush Script MT</option>
						<option onclick="updateFontFamily('Lucida Console')">Lucida Console</option>
						<option onclick="updateFontFamily('Lucida Sans Unicode')">Lucida Sans Unicode</option>
						<option onclick="updateFontFamily('Palatino Linotype')">Palatino Linotype</option>
						<option onclick="updateFontFamily('Impact')">Impact</option>
						<option onclick="updateFontFamily('Segoe UI')">Segoe UI</option>
						<option onclick="updateFontFamily('Comic Sans MS')">Comic Sans MS</option>
					</select>
					<!--  -->
					<select id="updateFontSize" class="dropdownSettings h-8">
						<option value="" disabled selected hidden>Font size:</option>
						@for ($i = 12; $i <= 32; $i += 2)
							<option onclick="updateFontSize('{{ $i }}px')">{{ $i }}px</option>
						@endfor
					</select>
					<!--  -->
					<select id="updateLineHeight" class="dropdownSettings h-8">
						<option value="" disabled selected hidden>Line height:</option>
						@for ($i = 12; $i <= 48; $i += 2)
							<option onclick="updateLineHeight('{{ $i }}px')">{{ $i }}px</option>
						@endfor
					</select>
					<!--  -->
					<select id="updateGroup" class="dropdownSettings h-8">
						<option value="" disabled selected>Groups:</option>
						@foreach ($userGroups as $group)
							<option value="{{ $group->id }}">{{ $group->group_name }}</option>
						@endforeach
					</select>
					<!--  -->
					<div>
						<a id="deleteNote" href="{{ route('delete_note', $id) }}">
							{!! \App\Helpers\Fontawesome::trash(['class' => 'w-5 h-5 text-red-500']) !!}
						</a>
					</div>

				</div>


			</div>
		 <!-- Header Buttons -->

		<div id="right_note" class="w-full flex gap-2">

			<div class="w-48">
				@foreach ($allNotes as $index => $item)
					<a href="/note/{{ $item->id }}" wire:navigate class="leftListInstance {{ $activeNoteId == $item->id ? 'bg-gray-400' : 'bg-orange-300' }} hover:bg-gray-600 hover:text-white">{{ \Illuminate\Support\Str::words($item->main_title, 2, '...') }}</a>
				@endforeach
			</div>

		 <!-- Form Area -->
			<form wire:submit.prevent="updateNote" class="w-full">
				
				<!-- setting region -->
				 <div class="hidden gap-4">
					<input type="text" wire:model="font_family" class="font_family_input" readonly>
					<input type="text" wire:model="font_size" class="font_size_input" readonly>
					<input type="text" wire:model="line_height" class="line_height_input" readonly>
					<input type="text" wire:model="username" class="text-black" readonly>
					<input type="text"  wire:model="g_id" class="group_input" readonly>
				 </div>
				<!-- setting region -->

				<!-- text region -->
				<div class="flex justify-between items-center bg-[#FFFFAA]">
					<input type="text" wire:model="main_title" class="mainTitle focus:border-0 focus:border-none" placeholder="Title:" id="mainTitle">
					<!--  -->
					<button type="submit" id="submitButton" class="noteSaveButton">UPDATE</button>
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
					<textarea wire:model="notes" id="notepad_textarea" class="notepad_textarea" style="font-size: {{ $font_size }}; line-height: {{ $line_height }}; font-family: {{ $font_family }}"></textarea>
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
</style>

</div>
