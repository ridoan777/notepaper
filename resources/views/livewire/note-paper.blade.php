<div>
	<h1 class="text-2xl font-bold text-center">Create a note</h1>
	<!-- Alert Area  -->
	<div class="mb-4" id="messageArea">
		@if(session('message'))
		<div class="border border-green-400 text-white px-4 py-3 rounded relative block sm:inline" role="alert">
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
		<div id="right_note" class="w-full border">

			<!-- Header Buttons -->
			<div class="flex gap-2 justify-center items-center">
				
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
			<!--  -->

			<!-- Header Buttons -->

			<!-- Form Area -->
			<form wire:submit.prevent="createNote">
				
				<!-- setting region -->
				 <div class="flex gap-4">
					 <input type="text" wire:model="font_family" id="family">
					 <input type="text" wire:model="font_size" id="font_size_input">
					 <input type="text" wire:model="line_height" id="line_height_input">
				 </div>
				<!-- setting region -->

				<!-- text region -->
				<input type="text" wire:model="main_title" class="mainTitle focus:border-0 focus:border-none" placeholder="Title:" id="mainTitle">
					<br>
				<div class="flex">
					<input type="text" wire:model="secondary_title" class="secondaryTitle focus:border-0 focus:border-none" placeholder="Secondary Title:" id="secondaryTitle">
						<br>
					<input type="text" wire:model="meta_title" class="metaTitle focus:border-0 focus:border-none" placeholder="Meta:" id="meta_title">
				</div>
				<textarea wire:model="notes" id="notepad_textarea" class="notepad_textarea bg-gray-900"></textarea>
					<br>
				<button type="submit" id="submitButton" class="button bg-green-600 dark:bg-blue-600">Submits</button>
			</form>
			<!-- Form Area -->
			 
		</div>

	 </div>
	<!-- Main Body -->

	<!-- Style -->
	<style scoped>

		/***Left Side***/
		.leftListInstance {
			width: 100%;
			margin: 4px 0;
			padding: 0 16px;
			display: block;
			border-radius: 50px 0 0 0;
			background-color: #d1d5dc;
		}

		.leftListInstance:hover{
			background-color: #99a1af ;
		}

		/*** Right Side Settings ***/
		#updateFontSize, .dropdownSettings {
			padding: 6px 20px;
			background-color: #4a5565;
			color: white;
			border-radius: 6px;
			cursor: pointer;
			font-size: 14px;
			appearance: none;
		}
		#updateFontSize:hover, .dropdownSettings:hover{
			background-color: #101828;
		}

		#updateFontSize option, #updateFontSize option:hover{
			border: none !important;
			cursor: pointer;
		}

		/*** Right Side Texts ***/
		input,
		textarea {
			width: 100%;
			margin: 8px 0;
			border: none;
			outline: none;
			padding: 6px 8px;
			box-sizing: border-box;
		}

		input:focus,
		textarea:focus {
			border: none;
			outline: none;
			box-shadow: none; /* prevent visual shift */
		}

		input {
			margin: 0px;
			padding: 0px;
			font-weight: 700;
		}

		input::placeholder {
			color: gray;
			font-weight: 700;
		}

		.mainTitle {
			font-size: 28px;
			line-height: 28px;
			background-color: palevioletred;
			text-align: center;
		}

		.secondaryTitle {
			width: 70% !important;
			font-size: 18px;
			line-height: 18px;
			background-color: palegreen
		}

		.metaTitle {
			width: 30% !important;
			font-size: 18px;
			text-align: center;
			line-height: 18px;
			background-color: palegoldenrod;
		}

		.notepad_textarea {
			width: 100%;
			height: 200px;
			padding: 8px 12px 0 12px;
			font-family: 'Courier New', monospace;
			/* font-size: 16px; */
			line-height: 24px;
			border: 1px solid #ccc;
			box-sizing: border-box;
			resize: vertical;
			background-color: white;
			background-image: repeating-linear-gradient(to bottom,
					white 0px,
					white 22px,
					#d0d7de 22px,
					white 24px);
		}

		.button{
			margin: 4px;
			padding: 4px 16px;
			border-radius: 8px;
			color: white;
			background-color: #4a5565;
		}
		.button:hover{
			background-color: #101828;
			cursor: pointer;
		}
	</style>
	<!-- Styles -->

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
		// ------------------
		function updateFontFamily(fontName) {
			const textarea = document.querySelector('.notepad_textarea');
			const input = document.querySelector('#font_family_input');
			if (textarea) {
				textarea.style.fontFamily = fontName;
				input.value = fontName;
			}
		}
		// ------------------
		function updateFontSize(size) {
			const textarea = document.querySelector('.notepad_textarea');
			const input = document.querySelector('#font_size_input');
			if (textarea) {
				textarea.style.fontSize = size;
				input.value = size;
			}
		}
		// ------------------
		function updateLineHeight(size) {
			const textarea = document.querySelector('.notepad_textarea');
			const input = document.querySelector('#line_height_input');
			if (textarea) {
				textarea.style.lineHeight = size;
				input.value = size;
			}
		}
		// ------------------

	</script>
	<!-- JS -->
</div>