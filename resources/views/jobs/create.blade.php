<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Post a New Job</h1>

        <form action="/jobs" method="POST">
            @csrf <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Job Title</label>
                <input type="text" name="title" placeholder="e.g. Senior PHP Dev" 
                       class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Salary</label>
                <input type="text" name="salary" placeholder="e.g. $90,000" 
                       class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                Save Job
            </button>
        </form>
    </div>
</body>
</html>