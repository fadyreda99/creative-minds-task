<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Driver') }}
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
            <form action="{{ route('admin.driver.update') }}" method="POST" class="row g-3 needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">driver name</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        id="validationCustom01" value="{{ $driver->username }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="validationCustom02" value="{{ $driver->email }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        id="validationCustom03" value="{{ $driver->phone }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>









                <div class="col-12">
                    <button class="btn btn-primary" type="submit">update</button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
