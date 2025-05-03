<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	   <script src="{{ asset('js/jquery-3.7.1-min.js') }}"></script>
		<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

		@vite(['resources/css/app.css', 'resources/js/flowbite_3.1.2.js', 'resources/js/ui-initializer.js', 'resources/js/app.js'])

		<title>{{ $title ?? 'NotePaper' }}</title>

		<style scoped>
			.navigation{
				margin: 0px 16px;
				padding: 4px 16px;
				color: white;
				background-color: #364153;
				cursor: pointer;
			}
			.navigation:hover{
				background-color: #101828;
			}
		</style>
	</head>

	<body class="p-0 bg-gray-100 dark:bg-gray-900">

		<x-partials.navbar/>
		<div class="mb-4 pt-16 p-2">
			{{ $slot }}
		</div>
		
	@vite(['resources/js/update-note-style.js'])
	</body>

</html>