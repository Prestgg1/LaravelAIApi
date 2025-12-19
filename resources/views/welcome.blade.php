<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-[#fafafa] text-[#1f2937] flex items-center justify-center px-4">

    <div class="w-full max-w-xl">

        <!-- Header -->
        <h1 class="text-xl font-semibold text-center mb-6">
            AI Chat
        </h1>


        <div class="mb-4">
            {{-- Validasiya xətaları (məsələn, boş göndərdikdə) --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- API və ya digər Catch xətaları --}}
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                    <strong>Xəta:</strong> {{ session('error') }}
                </div>
            @endif
        </div>


        <!-- Form -->
        <form action="{{ route('send.message') }}" method="POST" class="mb-8">
            @csrf

            <textarea name="user_content" rows="3"
                class="w-full resize-none rounded-xl border border-gray-200 p-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Mesajınızı yazın...">{{ old('user_content') }}</textarea>

            <div class="flex justify-end mt-3">
                <button type="submit"
                    class="px-5 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-500 transition">
                    Göndər
                </button>
            </div>
        </form>

        <!-- Messages -->
        <div class="space-y-4">
            @foreach ($messages as $msg)
                <!-- User -->
                <div class="flex justify-end">
                    <div class="max-w-[80%] rounded-xl bg-indigo-600 text-white px-4 py-2 text-sm">
                        {{ $msg->user_message }}
                    </div>
                </div>

                <!-- AI -->
                <div class="flex justify-start">
                    <div class="max-w-[80%] rounded-xl bg-white border border-gray-200 px-4 py-2 text-sm text-gray-700">
                        {{ $msg->ai_response }}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</body>

</html>
