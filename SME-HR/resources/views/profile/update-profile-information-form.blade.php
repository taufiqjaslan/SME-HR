<x-jet-form-section submit="updateProfileInformation">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="card-header">
                        <h1 class="card-title"><i class="fas fa-hospital">&nbsp;&nbsp;&nbsp;</i>Leave Entitlement Information</h1>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <x-slot name="title">
                                {{ __('Profile Information') }}
                            </x-slot>

                            <x-slot name="description">
                                {{ __('Update your account\'s profile information and email address.') }}
                            </x-slot>

                            <x-slot name="form">
                                <!-- Profile Photo -->
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                                    <!-- Profile Photo File Input -->
                                    <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreview = e.target.result;
                    };
                    reader.readAsDataURL($refs.photo.files[0]);
                " />

                                    <x-jet-label for="photo" value="{{ __('Photo') }}" />

                                    <!-- Current Profile Photo -->
                                    <div class="mt-2" x-show="!photoPreview">
                                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                                    </div>

                                    <!-- New Profile Photo Preview -->
                                    <div class="mt-2" x-show="photoPreview">
                                        <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                        </span>
                                    </div>

                                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                        {{ __('Select A New Photo') }}
                                    </x-jet-secondary-button>

                                    @if ($this->user->profile_photo_path)
                                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                        {{ __('Remove Photo') }}
                                    </x-jet-secondary-button>
                                    @endif

                                    <x-jet-input-error for="photo" class="mt-2" />
                                </div>
                                @endif

                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="name" value="{{ __('Name') }}" />
                                    <x-jet-input id="name" type="text" class="form-control border-primary" wire:model.defer="state.name" autocomplete="name" />
                                    <x-jet-input-error for="name" class="mt-2" />
                                </div>

                                <!-- Email -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" type="email" class="form-control border-primary" wire:model.defer="state.email" />
                                    <x-jet-input-error for="email" class="mt-2" />
                                </div>
                            </x-slot>

                            <x-slot name="actions">
                                <x-jet-action-message class="mr-3" on="saved">
                                    {{ __('Saved.') }}
                                </x-jet-action-message>

                                <div class="form-actions text-center">
                                    <button class="btn btn-primary float-md-right" ion="saved" id="addbutton">{{ __('Save') }}</button>
                                </div>
                            </x-slot>
                        </div>
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div> <!--end col-->

</x-jet-form-section>