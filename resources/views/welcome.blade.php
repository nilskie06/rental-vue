<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find your next home · EMY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] } } } }</script>
</head>
<body class="antialiased bg-slate-50 text-slate-900 min-h-screen flex flex-col">
    <div id="app"></div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
