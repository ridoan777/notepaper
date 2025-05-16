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
	<div id="mainBody" class="w-full mt-2 p-4">
		<h1 class="text-center dark:text-gray-200">Overview</h1>
		<!-- ----------------- -->
		<table class="w-full">
			@if($allGroups->isEmpty())
			<tr>
				<td>OPPS!! No groups have been created yet!</td>
			</tr>
			@else
			<!-- for all groups -->
			 	<tr class="w-full my-2 py-1 grid grid-cols-12 cursor-pointer bg-amber-200">
					<th class="col-span-1 hover:bg-gray-400">#</th>
					<th class="col-span-3 hover:bg-gray-400">Group Name</th>
					<th class="col-span-2 hover:bg-gray-400">Number of Notes</th>
					<th class="col-span-4 hover:bg-gray-400">Last Changed</th>
					<th class="col-span-2 hover:bg-gray-400">Action</th>
				</tr>
				@foreach($allGroups as $index => $item)
				<tr class="w-full my-2 py-1 grid grid-cols-12 text-center hover:bg-gray-300 dark:hover:bg-gray-600 cursor-pointer">
					<td class="col-span-1 text">{{ $index+1 }}</td>
					<td class="col-span-3 text">{{ $item->group_name }}</td>
					<td class="col-span-2 text">{{ \App\Models\Note::where('g_id', $item->id)->count() }}</td>
					<td class="col-span-4 text">{{ optional( \App\Models\Note::where('g_id', $item->id)->where('username', Auth::user()->username)->latest('updated_at')->first())->updated_at?->format('d-M-Y \a\t h:i A') ?? 'N/A' }}</td>
					<td class="col-span-2 flex items-center justify-center">
						<a data-gid="{{ $item->id }}"  data-modal-target="deleteGroupModal" data-modal-toggle="deleteGroupModal"  type="submit" class="button py-1 px-4 bg-red-500 hover:bg-red-600 rounded text-white text-sm" onclick="setDeleteLink(this)">Delete</a>
					</td>
				</tr>
				@endforeach
			@endif
			<!-- for uncategory -->
			<tr class="w-full my-2 py-2 grid grid-cols-12 text-center hover:bg-gray-300 dark:hover:bg-gray-600 cursor-pointer">
				<td class="col-span-1 text">*</td>
				<td class="col-span-3 text">Uncategorized</td>
				<td class="col-span-2 text">{{ \App\Models\Note::where('g_id', null)->where('username', Auth::user()->username)->count() }}</td>
				<td class="col-span-4 text">{{ optional( \App\Models\Note::where('g_id', null)->where('username', Auth::user()->username)->latest('updated_at')->first())->updated_at?->format('d-M-Y \a\t h:i A') ?? 'No recent update' }}</td>
				<td class="col-span-2">
					
				</td>
			</tr>
		</table>

	</div>
	<!-- Main Body -->

	<!-- delete modal -->
	 <div id="deleteGroupModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative p-4 w-full max-w-md max-h-full">
			<div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-600 dark:border dark:border-white">
				<button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteGroupModal">
					<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
					</svg>
					<span class="sr-only">Close modal</span>
				</button>
				<div class="p-4 md:p-5 text-center">
					<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
					</svg>
					<h3 class="text-lg font-normal text-gray-500 dark:text-gray-200">Are you sure you want to delete this Group?</h3>
					<span class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-200">Careful! All notes associated with this group will also be deleted permanently.</span>
					<br><br>
					<a id="confirmDeleteBtn" href="#" data-modal-hide="deleteGroupModal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
						Yes, I'm sure
					</a>
					<button data-modal-hide="deleteGroupModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
				</div>
			</div>
		</div>
	 </div>
	<!-- delete modal -->

<style>
	td{
		padding: 4px 8px;
		border-radius: 16px;
	}
</style>
<script>
	function setDeleteLink(element) {
		const gid = element.getAttribute('data-gid');
		console.log(gid);
		const confirmBtn = document.getElementById('confirmDeleteBtn');
		confirmBtn.href = `/group/delete/${gid}`;
	}
</script>


</div>