<div>
	<p>All Lists</p>

	<div class="flex flex-wrap gap-4">
		@foreach ($allNotes as $item)
			<div wire:key='{{ $item->id }}' class="w-62 p-4 bg-gray-200 hover:bg-gray-300 rounded-lg cursor-pointer" data-url="/note/{{ $item->id }}" onclick="window.location=this.getAttribute('data-url')">
				<p class="font-bold">{{ $item->id }}</p>
				<p class="font-bold text-xl">{{ $item->main_title }}</p>
				<p class="font-bold text-base">{{ $item->secondary_title }}</p>
				<p class="white-space-pre text-sm text-gray-500">{!! (e(Str::limit($item->notes, 40, '...'))) !!}</p>
			</div>
		@endforeach
	</div>

	<style>
		.white-space-pre {
			white-space: pre-wrap;
		}
	</style>
</div>
