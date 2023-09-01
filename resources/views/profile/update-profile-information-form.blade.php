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