<div class="px-4">
	
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

	<div class="flex justify-between">
		<h2 class="dark:text-white">All Notes</h2>
		<!--  -->

		<!-- Modal toggle -->
		<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="saveButton" type="button">
			{!! \App\Helpers\Fontawesome::plus(['class' => 'w-5 h-5 text-gray-200']) !!}
		</button>

		<!-- Main modal -->
		<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
			<div class="relative p-4 w-full max-w-md max-h-full">
				<!-- Modal content -->
				<div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
						<!-- Modal header -->
						<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
								Create a note group
							</h3>
							<button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer" data-modal-hide="authentication-modal">
								{!! \App\Helpers\Fontawesome::close(['class' => 'w-5 h-5 text-gray-200']) !!} &nbsp
								<span class="sr-only">Close modal</span>
							</button>
						</div>
						<!-- Modal body -->
						<div class="p-4 md:p-5">
							<form class="space-y-4" wire:submit.prevent="createGroup">
								<div>
									<input type="text" wire:model="group_name" id="group_name" class="loginInput" placeholder="Group Name" required />
									<input type="text" wire:model="user" id="user" class="loginInput hidden" readonly/>
								</div>
								<!--  -->
								<button type="submit" class="saveButton">Create</button>
							</form>
						</div>
				</div>
			</div>
		</div> 

	</div>
	<!-- ----------------- -->
	<div class="p-4 overflow-hidden">
		@if($allGroups->isEmpty())
		<h5 class="text-gray-500 dark:text-whote">OPPS!! No groups have been created yet!</h5>
		@else
		<div class="mb-10 flex flex-wrap gap-4">
			@foreach ($allGroups as $index => $item)
				<div wire:key='{{ $item->id }}' class="w-62 p-4 bg-gray-200 hover:bg-gray-300 rounded-lg cursor-pointer flex" data-url="/note/{{ $item->id }}" onclick="window.location=this.getAttribute('data-url')">
					<p class="font-bold text-xl">{{ $index+1 }} &nbsp; </p>
					<p class="font-bold text-xl">{{ $item->group_name }}</p>
				</div>
			@endforeach
		</div>
		@endif
		<!-- ----------------- -->
		@if($allGroups->isEmpty() && $allNotes->isEmpty())
			<h5 class="text-gray-500 dark:text-whote">OPPS!! No groups have been created yet!</h5>
		@endif
		
		@if($allGroups->isNotEmpty() && $allNotes->isNotEmpty())
			<div id="accordion-collapse" data-accordion="open">
				@foreach ($allGroups as $index => $item)
				<div class="mb-10">
					<h3 id="accordion-collapse-heading-{{ $index+1 }}">
						<button type="button" class="accordionButton" data-accordion-target="#accordion-collapse-body-{{ $index+1 }}" aria-expanded="false" aria-controls="accordion-collapse-body-{{ $index+1 }}">
							<span class="capitalize {{ $index%2==0 ? 'dark:text-red-500' : 'dark:text-blue-500' }}">{{ $item->group_name }} ({{ $allNotes->where('g_id', $item->id)->count() }})</span>
							
							<i data-accordion-icon>
								{!! \App\Helpers\Fontawesome::arrowUp(['class' => 'w-3 h-3 rotate-180 shrink-0 text-gray-500 dark:text-gray-50']) !!}
							</i>

						</button>
					</h3>
					<!--  -->
					<div id="accordion-collapse-body-{{ $index+1 }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $index+1}}">
						<div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
							@php
								$filterNotes = App\Models\Note::where('g_id', $item->id)->where('username', Auth::user()->username)->get();
							@endphp

							@if($allNotes->isEmpty())
								<h5 class="text-gray-500 dark:text-whote">OPPS!! No notes have been created yet!</h5>
							@else
							<div class="flex flex-wrap gap-4">
								@php $counter = 0; @endphp

								@foreach ($allNotes as $i => $note)
									@if($note->g_id == $item->id)
										@php $counter++; @endphp
									<div wire:key='{{ $note->id }}' class="w-62 p-4 bg-gray-200 hover:bg-gray-300 rounded-lg cursor-pointer" data-url="/note/{{ $note->slug }}{{ substr(now()->timestamp, -4) }}" onclick="window.location=this.getAttribute('data-url')">
										<p class="font-bold">{{ $i }}</p>
										<p class="font-bold text-xl">{{ $note->main_title }}</p>
										<p class="font-bold text-base">{{ $note->secondary_title }}</p>
										<p class="white-space-pre text-sm text-gray-500">{!! (e(Str::limit($note->notes, 40, '...'))) !!}</p>
									</div>
									@endif
								@endforeach

								@if($counter == 0)
									<h5 class="text-gray-500 dark:text-whote">Empty Group!</h5>
								@endif
							</div>
							@endif
						</div>

					</div>
				</div>
				@endforeach
			</div>
		@endif

		<!-- Accordion For NonCategorized -->
		<div id="nonCat-accordion-collapse" data-accordion="open">
			<h3 id="nonCat-accordion-collapse-heading-0">
				<button type="button" class="accordionButton" data-accordion-target="#nonCat-accordion-collapse-body-0" aria-expanded="false" aria-controls="nonCat-accordion-collapse-body-0">
					<span class="capitalize">Uncategorized ({{ $checkNonCategory->count() }})</span>
					
					<i data-accordion-icon>
						{!! \App\Helpers\Fontawesome::arrowUp(['class' => 'w-3 h-3 rotate-180 shrink-0 text-gray-500 dark:text-gray-50']) !!}
					</i>

				</button>
			</h3>
			<!--  -->
			<div id="nonCat-accordion-collapse-body-0" class="hidden" aria-labelledby="nonCat-accordion-collapse-heading-0">
				<div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
					@if($allNotes->isEmpty())
						<h5 class="text-gray-500 dark:text-whote">OPPS!! No notes have been created yet!</h5>
					@else
					<div class="flex flex-wrap gap-4">

						@if($checkNonCategory->isNotEmpty())
						@foreach ($checkNonCategory as $i => $note)
							<div wire:key='{{ $note->id }}' class="w-62 p-4 bg-gray-200 hover:bg-gray-300 rounded-lg cursor-pointer" data-url="/note/{{ $note->slug }}{{ substr(now()->timestamp, -4) }}" onclick="window.location=this.getAttribute('data-url')">
								<p class="font-bold">{{ $i }}</p>
								<p class="font-bold text-xl">{{ $note->main_title }}</p>
								<p class="font-bold text-base">{{ $note->secondary_title }}</p>
								<p class="white-space-pre text-sm text-gray-500">{!! (e(Str::limit($note->notes, 40, '...'))) !!}</p>
							</div>
						@endforeach
						@endif
					</div>
					@endif
				</div>

			</div>
		</div>
		<!-- Accordion For NonCategorized -->

	</div>

	<!-- ----------------- -->

	<style>
		.white-space-pre {
			white-space: pre-wrap;
		}
	</style>

	<script>
		// document.querySelector('.accordionButton');
	</script>

</div>
