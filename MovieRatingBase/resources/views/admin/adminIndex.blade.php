<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h1 class="text-4xl font-bold text-sky-50">{{ __('Manage ' . ucfirst($type))}}</h1>
        </div>
    </x-slot>


@section('content')
<div class="py-8 w-full">
    <div class="w-full px-2">
        <x-admin-edit-btn>
            <a href="{{ route('movies.create') }}">Create New Movie</a>
        </x-admin-edit-btn>
        <div class="bg-sky-700 rounded-lg overflow-hidden shadow-sm">
            <div class="p-4 bg-sky-600 border-b border-sky-900">
                <ul>
                    @foreach($items as $item)
                        <li class="flex flex-col sm:flex-row items-center py-2 border-b border-sky-900">
                            <div class="flex flex-col sm:flex-row items-center justify-between w-full">
                                <div class="flex flex-col sm:flex-row items-center justify-between w-full sm:w-3/4">
                                    <span class="text-sky-50 text-lg sm:text-xl lg:text-2xl h-8">{{ $item->name }}</span>
                                    <br class="sm:hidden">
                                    <span class="text-sky-50 text-base sm:text-lg h-8 p-1 sm:ml-4">Created at: {{ optional($item->created_at)->format('Y-m-d') }}</span>
                                </div>
                                <div class="flex justify-between sm:justify-end w-full sm:w-1/4 mt-2 sm:mt-0">
                                    <x-admin-edit-btn>
                                        <a href="{{ route('movies.edit', ['id' => $item->id]) }}">Edit</a>
                                    </x-admin-edit-btn>
                                    <form method="post" action="{{ route('movies.delete', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-admin-edit-btn>
                                            Delete
                                        </x-admin-edit-btn>
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
