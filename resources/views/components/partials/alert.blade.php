<div class="mb-4" id="messageArea">
	@if(session('success'))
	<div class="border text-center bg-green-400 border-green-400 text-white px-4 py-3 rounded relative" role="alert">
		<strong class="font-bold">Success!</strong>
		<span class="block sm:inline">{{ session('success') }}</span>
	</div>
	@endif
	@if($errors->any())
	<ul class="py-1 px-4 bg-red-400">
		<li class="text-white text-center text-xl"><b>{{ $message }}</b></li>
		<!-- @foreach ($errors->all() as $error)
		<li class="text-white">{{-- $error --}}</li>
		@endforeach -->
	</ul>
	@endif
</div>


<script>
	setTimeout(function(){
		const msg = document.getElementById('messageArea');
		if (msg) {
			msg.classList.add('transition-opacity', 'duration-1000', 'opacity-0');
			setTimeout(() => {
				msg.style.display = 'none';
			}, 1000); // Wait for the fade-out to finish
		}
	}, 10000);
</script>