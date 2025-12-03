<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Board</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto">
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Available Jobs</h1>

    @can('manage-jobs')
        <div class="space-x-2">
            <!-- NEW LINK -->
            <a href="/admin/users" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Manage Users</a>
            
            <a href="/jobs/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Job</a>
        </div>
    @endcan
</div>
       <div class="grid gap-4">
            @foreach ($jobs as $job)
                <div class="bg-white p-6 rounded-lg shadow border border-gray-200 flex justify-between items-center">
                    
                    <div>
                        <h2 class="text-xl font-bold text-blue-600">{{ $job->title }}</h2>
                        <p class="text-gray-700 font-semibold">{{ $job->salary }}</p>
                    </div>

                    <div class="flex space-x-2">
    
    @can('manage-jobs')
        <a href="/jobs/{{ $job->id }}/edit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded">Edit</a>

        <form action="/jobs/{{ $job->id }}" method="POST" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
        </form>
    @endcan

</div>

                </div>
            @endforeach
        </div>

        @if($jobs->isEmpty())
            <p class="text-gray-500">No jobs available yet.</p>
        @endif
    </div>
</body>
</html>