<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <span class="text-xl font-bold">{{ config('app.name') }}</span>
        </div>
    </nav>
    <div class="container mx-auto mt-10 text-center">
        <h1 class="text-3xl font-semibold">Centralized API</h1>
        <p class="text-gray-600 mt-2">to call multiple registered APIs from various tools.</p>
    </div>
</body>
</html>
