<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h1 class="text-4xl font-bold text-sky-50">{{ __('Manage ' . ucfirst($type))}}</h1>
        </div>
    </x-slot>

@section('content')
    <div class="py-8 w-full">
        <div class="w-4/5 mx-auto sm:px-6 lg:px-8">
            <div class="bg-sky-700 sm:rounded-lg overflow-hidden shadow-sm">
                <div class="p-6 bg-sky-600 border-b border-sky-900">
                    <ul>
                        <li class="flex items-center py-2 border-b border-sky-900">
                            <div class="flex justify-evenly w-1/2">
                                <span class="text-sky-50 text-2xl h-8">{{ $item->name }}</span>
                                <span class="text-sky-50 text-xl h-8 p-1">Created at: {{ $item->created_at->format('Y-m-d') }}</span>
                            </div>
                            <div class="flex justify-end w-1/2">
                                <x-admin-edit-btn>
                                    <a href="{{ route('movies.create') }}">{{ __('Create new ' . ucfirst($type)) }}</a>
                                </x-admin-edit-btn>
                            </div>
                        </li>
                        @foreach($items as $item)
                            <li class="flex items-center py-2 border-b border-sky-900">
                                <div class="flex justify-evenly w-1/2">
                                    <span class="text-sky-50 text-2xl h-8">{{ $item->name }}</span>
                                    <span class="text-sky-50 text-xl h-8 p-1">Created at: {{ $item->created_at->format('Y-m-d') }}</span>
                                </div>
                                <div class="flex justify-end w-1/2">
                                    <x-admin-edit-btn>
                                        <a href="{{ route('movies.edit', ['id' => $item->id]) }}">Edit</a>
                                    </x-admin-edit-btn>
                                    <form method="post" action="{{ route('admin.' . $type . '.delete', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-admin-edit-btn>
                                            Delete
                                        </x-admin-edit-btn>
                                    </form>
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
