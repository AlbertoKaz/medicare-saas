<flux:dropdown position="bottom" align="start">

    <flux:sidebar.profile
        :name="auth()->user()->name"
        :initials="auth()->user()->initials()"
        icon:trailing="chevrons-up-down"
        data-test="sidebar-menu-button"

        class="
        **:data-flux-avatar:bg-blue-50!
        **:data-flux-avatar:text-blue-700!
        **:data-flux-avatar:border!
        **:data-flux-avatar:border-blue-100!

        **:data-flux-heading:text-slate-900!
        **:data-flux-text:text-slate-500!
    "
    />

    <flux:menu
        class="
            w-72!
            rounded-2xl!
            border!
            border-slate-200!
            bg-white!
            p-2!
            text-slate-700!
            shadow-xl!
            shadow-slate-200/70!

            **:text-slate-700!

            **:data-flux-heading:text-slate-950!
            **:data-flux-text:text-slate-500!

            **:data-flux-avatar:bg-blue-50!
            **:data-flux-avatar:text-blue-700!

            **:data-flux-menu-item:rounded-xl!
            **:data-flux-menu-item:px-3!
            **:data-flux-menu-item:py-2!
            **:data-flux-menu-item:text-slate-700!

            [&_[data-flux-menu-item]:hover]:bg-blue-50!
            [&_[data-flux-menu-item]:hover]:text-blue-600!

            **:data-flux-menu-separator:my-2!
            **:data-flux-menu-separator:bg-slate-200!
        "
    >
        <div class="flex items-center gap-3 rounded-xl px-2 py-2 text-start text-sm">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-semibold text-blue-700">
                {{ auth()->user()->initials() }}
            </div>

            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-semibold text-slate-950">
                    {{ auth()->user()->name }}
                </p>

                <p class="truncate text-sm text-slate-500">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <div class="my-2 h-px bg-slate-200"></div>

        <flux:menu.radio.group>
            <flux:menu.item
                :href="route('profile.edit')"
                icon="cog"
                wire:navigate
                class="text-slate-700! hover:bg-blue-50! hover:text-blue-600!"
            >
                Settings
            </flux:menu.item>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf

                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer text-slate-700! hover:bg-blue-50! hover:text-blue-600!"
                    data-test="logout-button"
                >
                    Log out
                </flux:menu.item>
            </form>
        </flux:menu.radio.group>
    </flux:menu>

</flux:dropdown>
