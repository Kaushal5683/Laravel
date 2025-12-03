<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Job</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Edit Job</h1>

        <form action="/jobs/{{ $job->id }}" method="POST">
            @csrf
            @method('PATCH') <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Job Title</label>
                <input type="text" name="title" 
                       value="{{ $job->title }}" 
                       class="w-full border p-2 rounded">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Salary</label>
                <input type="text" name="salary" 
                       value="{{ $job->salary }}" 
                       class="w-full border p-2 rounded">
            </div>

            <div class="flex justify-between">
                <a href="/jobs" class="text-gray-600 px-4 py-2">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                    Update Job
                </button>
            </div>
        </form>
    </div>
</body>
</html>