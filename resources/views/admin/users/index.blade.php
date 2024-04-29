<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Create</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">phone</th>
                        <th scope="col">Controllers</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="User Actions">
                                    <a href="{{ route('admin.user.edit', ['user_id' => $user->id]) }}"
                                        class="btn btn-success mr-2">Edit</a>
                                    <form method="POST"
                                        action="{{ route('admin.user.destroy', ['user_id' => $user->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
