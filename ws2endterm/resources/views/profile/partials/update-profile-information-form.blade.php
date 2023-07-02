<section>
    <div>
        <div class="flex items-center justify-left">
            <div class="w-25 h-25 rounded-full overflow-hidden">
                @if( $user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="object-cover w-full h-full">
                    @else
                    <i class="fas fa-user-circle" style="font-size:100px"></i>
                    @endif 
            </div>
        </div>
    </div>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $user->role)" required />
            <x-input-error class="mt-2" :messages="$errors->get('role')" />
        </div>

        <div>
            <x-input-label for="ins_org" :value="__('Institution/Organization')" />
            <x-text-input id="ins_org" name="ins_org" type="text" class="mt-1 block w-full" :value="old('ins_org', $user->ins_org)" required />
            <x-input-error class="mt-2" :messages="$errors->get('ins_org')" />
        </div>

        <div>
            <x-input-label for="quali_educ" :value="__('Qualification/Education')" />
            <x-text-input id="quali_educ" name="quali_educ" type="text" class="mt-1 block w-full" :value="old('quali_educ', $user->quali_educ)" required />
            <x-input-error class="mt-2" :messages="$errors->get('quali_educ')" />
        </div>

        <div>
            <x-input-label for="skills" :value="__('Skills')" />
            <x-text-input id="skills" name="skills" type="text" class="mt-1 block w-full" :value="old('skills', $user->skills)" required />
            <x-input-error class="mt-2" :messages="$errors->get('skills')" />
        </div>

        <div>
            <x-input-label for="experience" :value="__('Experience')" />
            <x-text-input id="experience" name="experience" type="text" class="mt-1 block w-full" :value="old('experience', $user->experience)" required />
            <x-input-error class="mt-2" :messages="$errors->get('experience')" />
        </div>

        <div>
            <x-input-label for="contact_no" :value="__('Contact Number')" />
            <x-text-input id="contact_no" name="contact_no" type="text" class="mt-1 block w-full" :value="old('contact_no', $user->contact_no)" required />
            <x-input-error class="mt-2" :messages="$errors->get('contact_no')" />
        </div>

        <!-- Rest of the form -->

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    <br>

    <form method="post" action="{{ route('profile.updatePicture') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-text-input class="mt-1 block w-full" id="profile_picture" name="image" type="file" class="mt-1 block w-full" accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div><br>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update Profile') }}</x-primary-button>
        </div>
    </form>
</section>
