<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Website | Fadhlu Ibnu 'Abbd</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #041d8a 100%);
            font-family: 'Inter', sans-serif;
        }

        .clock {
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>

<body class="min-h-screen">
    <div class="max-w-md mx-auto px-4 py-12">
        <!-- Profile Section -->
        <div class="text-center mb-8">
            <div class="w-24 h-24 rounded-full bg-white shadow-lg mx-auto flex items-center justify-center">
                <svg class="w-16 h-16 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold mt-4 text-white">Welcome to My Website!</h1>
            <p class="text-blue-100 mt-2">Fadhlu Ibnu - Web Developer</p>
        </div>

        <!-- Date & Time Section -->
        <div class="bg-white/30 backdrop-blur-lg rounded-xl p-4 mb-6 text-center text-white shadow-lg">
            <div id="date" class="text-lg font-medium mb-2"></div>
            <div id="clock" class="clock text-3xl font-bold"></div>
        </div>

        <!-- Links Section -->
        <div class="space-y-3">
            <a href="{{ url('/products') }}"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <i class="fas fa-box-open text-blue-600 mr-3 text-xl"></i>
                    <span class="font-medium text-gray-800">Product Management</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400"></i>
            </a>

            <a href="{{ url('/chatbot') }}"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <i class="fas fa-solid fa-comments text-blue-600 mr-3 text-xl"></i>
                    <span class="font-medium text-gray-800">AI Chatbot</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400"></i>
            </a>

            <a href="{{ url('/react') }}"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <i class="fas fa-brands fa-react text-blue-600 mr-3 text-xl"></i>
                    <span class="font-medium text-gray-800">Demo Belajar React</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400"></i>
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-10 text-center text-white/70 text-sm">
            <p>© 2025 Your Laravel App. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Function to update the clock and date
        function updateDateTime() {
            const now = new Date();

            // Update clock
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;

            // Update date
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateString = now.toLocaleDateString('en-US', options);
            document.getElementById('date').textContent = dateString;
        }

        // Update the date and time immediately and then every second
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>

</html>
