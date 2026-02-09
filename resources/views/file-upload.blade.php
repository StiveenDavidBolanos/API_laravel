<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload to Google Drive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-8">

        <h1 class="text-2xl font-bold text-gray-800 text-center mb-8">
            Upload File to Google Drive
        </h1>

        <form action="{{ route('upload-file') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Choose a file
                </label>

                <div class="flex items-center justify-center w-full">
                    <label for="file-upload"
                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-gray-100 transition duration-200 ease-in-out">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <p class="mb-1 text-sm font-semibold text-gray-600">
                                Click to upload
                            </p>
                            <p class="text-xs text-gray-500">
                                Any file up to 10MB
                            </p>
                        </div>
                        <input id="file-upload" name="file" type="file" />
                    </label>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Upload File
            </button>

        </form>
    </div>

</body>

</html>
