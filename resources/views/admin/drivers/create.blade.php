<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Driver') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route('admin.driver.store')}}" method="POST" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">driver name</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="validationCustom01" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="validationCustom02" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Phone</label>
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="validationCustom03" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="validationCustom04" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              
                
                
                
               
                <div class="col-12">
                  <button class="btn btn-primary" type="submit">create</button>
                </div>
              </form>
        </div>
        
    </div>
</x-app-layout>