@include('admin.header')
@if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X </button>
             {{session()->get('message')}}
          </div>

        @endif
        <x-validation-errors class="mb-4" />

<form method="POST" action="{{route('dashboard.store')}}" id="data-submit">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="fname" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus autocomplete="name" />
                
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="femail" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autocomplete="username" />
                
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="fphone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')"  autocomplete="phone" />
                  
         </div>

            <div class="mt-4">
                <x-label for="department" value="{{ __('Department') }}" />
                <x-input id="fdepartment" class="block mt-1 w-full" type="text" name="department" :value="old('department')"  autocomplete="department" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="fpassword" class="block mt-1 w-full" type="password" name="password"  autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="fpassword_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"  autocomplete="new-password" />
            </div>
            
            <div class="mt-4">
                <input type="submit" class="btn btn-primary" id="save-form">
            </div>
        </form>

@include('admin.footer')