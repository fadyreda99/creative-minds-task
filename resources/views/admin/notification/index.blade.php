<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Push Notification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

            <form action="{{ route('admin.notify.push') }}" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-md-12">
                    <label for="validationCustom01" class="form-label">Message</label>
                    <input type="text" name="message" class="form-control" id="validationCustom01"
                        value="{{ old('message') }}" required>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Push</button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
