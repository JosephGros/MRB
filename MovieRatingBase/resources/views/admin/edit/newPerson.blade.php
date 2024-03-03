<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h1 class="text-4xl font-bold text-sky-50">New {{$person = ucfirst(substr($type, 0, -1))}}</h1>
        </div>
    </x-slot>

@section('content')
    <div class="py-8 w-full">
        <x-admin-edit-btn>
            <a href="{{ route('admin.index', ['type' => $type]) }}">Back</a>
        </x-admin-edit-btn>
        <div class="w-4/5 mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center content-center bg-sky-700 sm:rounded-lg overflow-hidden shadow-sm">
                <div class="w-4/5">
                <form method="post" action="{{ route($type . '.store') }}" enctype="multipart/form-data" class="space-y-4 px-6 py-4">
                            @csrf 
                        <div>
                            <label for="name" class="block text-sky-50 font-semibold text-base ">Name</label>
                            <input type="text" name="name" id="name" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="profile_picture" class="block text-sky-50 font-semibold text-base ">Profile picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="birth_date" class="block text-sky-50 font-semibold text-base ">Birthday</label>
                            <input type="text" name="birth_date" id="birth_date" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="death_date" class="block text-sky-50 font-semibold text-base ">Dead?</label>
                            <input type="text" name="death_date" id="death_date" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        
                            <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
</x-admin-layout>