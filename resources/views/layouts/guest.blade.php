<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>

<script>
    function hiddenSwitch(what, arr) {
        for (let i = 0; i < arr.length; i++) {
            let svgButton = document.getElementById(arr[i]).classList
            what == "add" ? svgButton.add("hidden") : svgButton.remove("hidden")
        }
    }

    const toggleDark = () => {
        hiddenSwitch("remove", ["lightButton", "mobileLightButton"])
        hiddenSwitch("add", ["darkButton", "mobileDarkButton"])
    }

    const toggleLight = () => {
        hiddenSwitch("remove", ["darkButton", "mobileDarkButton"])
        hiddenSwitch("add", ["lightButton", "mobileLightButton"])
    }

    const userTheme = localStorage.getItem("theme")
    const systemTheme = window.matchMedia("(prefers-colors-scheme: dark)").matches

    const themeCheck = () => {
        if (userTheme == "dark" || (!userTheme && systemTheme)) {
            document.documentElement.classList.add("dark")
            toggleDark()
            return
        }
        toggleLight()
    }

    const themeSwitch = () => {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark")
            localStorage.setItem("theme", "light")
            toggleLight()
            return
        }
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme", "dark")
        toggleDark()
    }

    themeCheck()
</script>

</html>
