<div>
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
			@error('error')
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
	<div id="mainBody" class="w-full mt-4">

			<!-- Header Buttons -->
			<div class="mb-4 flex gap-2 justify-start items-center">
				
				<h1 class="w-96 mb-0 text-4xl text-center text-cyan-500 font-bold leading-[1]">Edit your note</h1>
				<!--  -->
				<div class="flex gap-4 justify-center items-center">

					<Button type="button" id="copyButton" class="button" onclick="getTextCopied()">
						{!! \App\Helpers\Fontawesome::copy(['class' => 'w-5 h-5 text-gray-500 dark:text-gray-200']) !!}
					</Button>
					<!--  -->
					<div>
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
						<p class="noteSettings">Current: {{ $font_family }}</p>
					</div>
					<!--  -->
					<div>
						<select id="updateFontSize" class="dropdownSettings h-8">
							<option value="" disabled selected hidden>Font size:</option>
							@for ($i = 12; $i <= 32; $i += 2)
								<option onclick="updateFontSize('{{ $i }}px')">{{ $i }}px</option>
							@endfor
						</select>
						<!--  -->
						<p class="noteSettings">Current: {{ $font_size ? $font_size : "default 16px" }}</p>
					</div>
					<!--  -->
					<div>
						<select id="updateLineHeight" class="dropdownSettings h-8">
							<option value="" disabled selected hidden>Line height:</option>
							@for ($i = 12; $i <= 48; $i += 2)
								<option onclick="updateLineHeight('{{ $i }}px')">{{ $i }}px</option>
							@endfor
						</select>
						<!--  -->
						<p class="noteSettings">Current: {{ $line_height ? $line_height : "default 24px" }}</p>
					</div>
					<!--  -->
					<div>
						<select id="updateGroup" class="dropdownSettings h-8">
							<option value="" disabled selected>Groups:</option>
							@foreach ($userGroups as $group)
								<option value="{{ $group->id }}">{{ $group->group_name }}</option>
								@endforeach
								<option value="uncategorized">Unlink Group</option>
						</select>
						<!--  -->
						<p class="noteSettings">Current: {{ $g_id ? $currentGroup : "uncategorized" }}</p>
					</div>
					<!--  -->
					<div>
						<a id="deleteNote" href="{{ route('delete_note', $slug . substr(now()->timestamp, -4) ) }}">
							{!! \App\Helpers\Fontawesome::trash(['class' => 'w-5 h-5 text-red-500']) !!}
						</a>
					</div>

				</div>


			</div>
		 <!-- Header Buttons -->

		<div id="right_note" class="w-full flex gap-2">

			<!-- Note Lists -->
			<div class="w-48">
				<!--  -->
				<div id="accordion-collapse" data-accordion="open">
					
					<!-- For current group -->
					<div class="mb-2">
						<h4 id="accordion-collapse-heading-1" class="mb-2">
							<button type="button" class="leftListInstanceGroup bg-pink-300 hover:bg-pink-400" data-accordion-target="#accordion-collapse-body-1" aria-expanded="false" aria-controls="accordion-collapse-body-1">
								<span>{{ $currentGroup }} ({{ $fetchCurrentGroup->count() }})</span>
							</button>
						</h4>
						<!--  -->
						<div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
							<div class="p-1">

								@if($allNotes->isEmpty())
									<h5 class="text-gray-500 dark:text-whote">OPPS!! No notes have been created yet!</h5>
								@else
									@foreach ($fetchCurrentGroup as $index => $item)
										<a href="/note/{{ $item->slug }}{{ substr(now()->timestamp, -4) }}" wire:navigate class="leftListInstanceNote {{ $activeNoteId == $item->id ? 'bg-gray-400' : 'bg-orange-300' }} hover:bg-gray-600 hover:text-white">{{ \Illuminate\Support\Str::limit($item->main_title, 20, '...') }}</a>
									@endforeach
								@endif

							</div>

						</div>
					</div>
					<!-- for all groups except current one -->
					@foreach ($allGroups as $index => $item)
						@php
							$filterNotes = App\Models\Note::where('g_id', $item->id)->where('username', Auth::user()->username)->get();
						@endphp
					 <div class="mb-2">
						<h4 id="accordion-collapse-heading-{{ $index+2 }}" class="mb-2">
							<button type="button" class="leftListInstanceGroup bg-indigo-300 hover:bg-indigo-400" data-accordion-target="#accordion-collapse-body-{{ $index+2 }}" aria-expanded="false" aria-controls="accordion-collapse-body-{{ $index+2 }}">
								<span>{{ $item->group_name }} ({{ $filterNotes->count() }})</span>
							</button>
						</h4>
						<!--  -->
						<div id="accordion-collapse-body-{{ $index+2 }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $index+1}}">
							<div class="p-1 dark:bg-gray-900">

								@if($allNotes->isEmpty())
									<h5 class="text-gray-500 dark:text-whote">OPPS!! No notes have been created yet!</h5>
								@else
									@foreach ($filterNotes as $index => $itemNote)
										<a href="/note/{{ $itemNote->slug }}{{ substr(now()->timestamp, -4) }}" wire:navigate class="leftListInstanceNote {{ $activeNoteId == $itemNote->id ? 'bg-gray-400' : 'bg-orange-300' }} hover:bg-gray-600 hover:text-white">{{ \Illuminate\Support\Str::limit($itemNote->main_title, 20, '...') }}</a>
									@endforeach
								@endif

							</div>

						</div>
					 </div>
					@endforeach
					<!-- for uncategory groups only -->
					@if($currentGroup != 'uncategorized')
						<div class="mb-2">
							<h4 id="accordion-collapse-heading-0" class="mb-2">
								<button type="button" class="leftListInstanceGroup bg-emerald-300 hover:bg-emerald-400 focus:bg-emerald-400" data-accordion-target="#accordion-collapse-body-0" aria-expanded="false" aria-controls="accordion-collapse-body-0">
									<span>Uncategorized ({{ $noncategorized->count() }})</span>
								</button>
							</h4>
							<!--  -->
							<div id="accordion-collapse-body-0" class="hidden" aria-labelledby="accordion-collapse-heading-0">
								<div class="p-1">
									@php
										$filterNotes = App\Models\Note::where('g_id', $item->id)->where('username', Auth::user()->username)->get();
									@endphp

									@if($noncategorized->isEmpty())
										<h5 class="text-gray-500 dark:text-whote">OPPS!! No notes have been created yet!</h5>
									@else
										@foreach ($noncategorized as $index => $item)
											<a href="/note/{{ $item->slug }}{{ substr(now()->timestamp, -4) }}" wire:navigate class="leftListInstanceNote {{ $activeNoteId == $item->id ? 'bg-gray-400' : 'bg-orange-300' }} hover:bg-gray-600 hover:text-white">{{ \Illuminate\Support\Str::limit($item->main_title, 20, '...') }}</a>
										@endforeach
									@endif
								</div>

							</div>
						</div>
					@endif
				</div>

			</div>

		 <!-- Form Area -->
			<form id="noteForm" wire:submit.prevent="updateNote" class="w-full">
				
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
</style>

</div>
