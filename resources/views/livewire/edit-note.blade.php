<div>
	<h1 class="text-2xl font-bold text-center">Edit your note</h1>
	<!-- Alert Area  -->
	<div class="mb-4" id="messageArea">
		@if(session('success'))
		<div class="border border-green-400 text-white px-4 py-3 rounded relative block sm:inline" role="alert">
			{{ session('success') }}
		</div>
		@endif
		@if($errors->any())
		<ul>
			<li class="text-blue-500"><b>Error/s:</b></li>
			@foreach ($errors->all() as $error)
			<li class="text-red-500">{{ $error }}</li>
			@endforeach
		</ul>
		@endif
	</div>
	<!-- Alert Area -->

	<!-- Main Body -->
	 <div id="mainBody" class="w-full mt-4 flex gap-2">

		<div id="left_lists" class="w-36">
			@foreach ($allNotes as $item)
				<a href="/note/{{ $item->id }}" wire:navigate class="leftListInstance border">{{$item->id}}</a>
			@endforeach
		</div>
		<!--  -->
		<div id="right_note" class="w-full">

		 <!-- Header Buttons -->
			<div class="mb-4 flex gap-2 justify-center items-center">
				
				<Button type="button" id="copyButton" class="button" onclick="getTextCopied()">
					{!! \App\Helpers\Fontawesome::copy(['class' => 'w-5 h-5 text-gray-50']) !!}
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

			</div>
		 <!-- Header Buttons -->

		 <!-- Form Area -->
			<form wire:submit.prevent="createNote">
				
				<!-- setting region -->
				 <div class="gap-4">
					 <input type="text" wire:model="font_family" class="font_family_input" readonly>
					 <input type="text" wire:model="font_size" class="font_size_input" readonly>
					 <input type="text" wire:model="line_height" class="line_height_input" readonly>
					 <input type="text" wire:model="username" class="text-black">
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

		setTimeout(function() {
			const msg = document.getElementById('messageArea');
			if (msg) {
				msg.classList.add('transition-opacity', 'duration-1000', 'opacity-0');
				setTimeout(() => {
					msg.style.display = 'none';
				}, 1000); // Wait for the fade-out to finish
			}
		}, 10000);
		// ------------------
		function getTextCopied() {
			const textarea = document.querySelector('.notepad_textarea');
			const copyButton = document.getElementById('copyButton');
			const copyButtonOriginal = document.getElementById('copyButton').innerHTML;

			if (navigator.clipboard) {
				navigator.clipboard.writeText(textarea.value)
					.then(() => {
						copyButton.style.fontSize = "14px";
						copyButton.innerHTML = "Copied ✅";
						setTimeout(() => {
							copyButton.innerHTML = copyButtonOriginal;
						}, 5000);
					})
					.catch(err => {
						console.error("Failed to copy: ", err);
						copyButton.innerHTML = "Failed ❌";
					});
			} else {
				// Fallback for older browsers
				textarea.select();
				textarea.setSelectionRange(0, 99999); // iOS support
				document.execCommand("copy");
				copyButton.innerHTML = "Copied ✅";
			}
		}
	</script>
	<!-- JS -->
</div>