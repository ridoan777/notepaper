<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notepaper</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">
    
    <div>
        Blank Notes: <livewire:note-paper/>
        {{ $slot }}
    </div>


</body>
</html>


<!-- <style>
    .notepad-textarea {
        width: 100%;
        height: 150px;
        background: repeating-linear-gradient(
            transparent, transparent 28px, #f0f0f0 28px, #f0f0f0 30px
        );
        /* padding: 10px; */
        border: 1px solid #ccc;
        box-sizing: border-box;
		  font-size: 14px;
        line-height: 28px;
    }
</style>

<textarea class="notepad-textarea" wire:model="notes"></textarea> -->