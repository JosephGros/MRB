<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h1 class="text-4xl font-bold text-sky-50">{{ __('Manage ' . ucfirst($type))}}</h1>
        </div>
    </x-slot>


@section('content')
<div class="py-2 w-full">
    <div class="w-full px-2">
        <div class="flex justify-center content-center w-400 h-100 mb-8">
            @if(session('error'))
                <div class="alert alert-danger bg-red-500 rounded-lg overflow-hidden shadow-sm p-2">
                    <h2>{{ session('error') }}</h2>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success bg-emerald-500 rounded-lg overflow-hidden shadow-sm p-2">
                    <h2>{{ session('success') }}</h2>
                </div>
            @endif
        </div>
        <div class="bg-sky-700 rounded-lg overflow-hidden shadow-sm">
            <div class="p-4 bg-sky-600 border-b border-sky-900">
                <ul>
                <li class="flex flex-col sm:flex-row items-center py-2 border-b-4 border-sky-900">
                            <div class="flex flex-col sm:flex-row items-center justify-between w-full">
                                <div class="flex flex-col sm:flex-row items-center justify-between w-full sm:w-3/4">
                                    <span class="text-sky-50 text-lg sm:text-2xl lg:text-2xl h-8">Name</span>
                                    <br class="sm:hidden">
                                    @if($type === 'genres') 
                                    <span class="text-sky-50 text-base sm:text-lg h-8 p-1 sm:ml-4">Content Amount</span>
                                    @else
                                    <span class="text-sky-50 text-lg sm:text-2xl lg:text-2xl h-8">Created</span>
                                    @endif
                                </div>
                                <x-admin-edit-btn>
                                    <a href="{{ route('admin.dashboard') }}">Back</a>
                                </x-admin-edit-btn>
                                <x-admin-edit-btn>
                                    <a href="{{ route($type . '.create') }}">New!</a>
                                </x-admin-edit-btn>
                            </div>
                        </li>
                    @foreach($items as $item)
                        <li class="flex flex-col sm:flex-row items-center py-2 border-b border-sky-900">
                            <div class="flex flex-col sm:flex-row items-center justify-around w-full">
                                @if(!$item instanceof App\Models\Genre)
                                <div class="mx-1.5">
                                    <img src="{{ asset($item->poster ?? $item->profile_picture) }}" alt="{{ $item->name }}" class="rounded-full h-16 w-16 object-cover">
                                </div>
                                <br>
                                @endif
                                <div class="flex flex-col sm:flex-row items-center justify-between w-full sm:w-3/4">
                                    <span class="text-sky-50 text-lg sm:text-xl lg:text-xl h-8">{{ $item->name }}</span>
                                    <br class="sm:hidden">
                                    @if($item instanceof App\Models\Genre) 
                                    <span class="text-sky-50 text-base sm:text-lg h-8 p-1 sm:ml-4">{{ $item->totalCount }}</span>
                                    @else
                                    <span class="text-sky-50 text-base sm:text-lg h-8 p-1 sm:ml-4">Created at: {{ optional($item->created_at)->format('Y-m-d') }}</span>
                                    @endif
                                </div>
                                <div class="flex justify-between sm:justify-end w-full sm:w-1/4 mt-2 sm:mt-0">
                                    <x-admin-edit-btn>
                                        <a href="{{ route($type . '.store', ['id' => $item->id]) }}">Edit</a>
                                    </x-admin-edit-btn>
                                    <form method="post" action="{{ route($type . '.delete', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-admin-delete-btn>
                                            Delete
                                        </x-admin-delete-btn>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    

@endsection
</x-admin-layout>
