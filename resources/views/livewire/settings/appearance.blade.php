<section class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">
        {{ __('Appearance settings') }}
    </flux:heading>

    <x-settings.layout
        :heading="__('Appearance')"
        :subheading="__('Update the appearance settings for your account')"
    >
        <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-6">
            <div class="mb-5">
                <h3 class="text-base font-semibold text-slate-950">
                    {{ __('Theme preference') }}
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    {{ __('Choose how MediCare should appear on this device.') }}
                </p>
            </div>

            <div
                class="
                    **:[[role='radiogroup']]:rounded-2xl!
                    **:[[role='radiogroup']]:border!
                    **:[[role='radiogroup']]:border-slate-200!
                    **:[[role='radiogroup']]:bg-white!
                    **:[[role='radiogroup']]:p-1!
                    **:[[role='radiogroup']]:shadow-sm!

                    [&_button]:rounded-xl!
                    [&_button]:text-sm!
                    [&_button]:font-semibold!
                    [&_button]:text-slate-600!

                    [&_button[data-checked]]:bg-blue-600!
                    [&_button[data-checked]]:text-white!
                    [&_button[data-checked]]:shadow-sm!
                "
            >
                <flux:radio.group
                    x-data
                    variant="segmented"
                    x-model="$flux.appearance"
                >
                    <flux:radio value="light" icon="sun">
                        {{ __('Light') }}
                    </flux:radio>

                    {{--<flux:radio value="dark" icon="moon">
                        {{ __('Dark') }}
                    </flux:radio>--}}

                    {{--<flux:radio value="system" icon="computer-desktop">
                        {{ __('System') }}
                    </flux:radio>--}}
                </flux:radio.group>
            </div>
        </div>
    </x-settings.layout>
</section>
