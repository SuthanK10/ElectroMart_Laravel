<x-app-layout>
    <div class="pt-28 pb-24 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-12 flex items-center gap-4">
                <div class="w-1.5 h-10 bg-blue-600 rounded-full"></div>
                <h1 class="text-4xl font-['Outfit'] font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">Profile Settings</h1>
            </div>

            <div class="space-y-12">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 sm:p-12 border border-slate-100 dark:border-white/5 shadow-xl animate-blur-in">
                        @livewire('profile.update-profile-information-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 sm:p-12 border border-slate-100 dark:border-white/5 shadow-xl animate-blur-in" style="animation-delay: 0.1s">
                        @livewire('profile.update-password-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 sm:p-12 border border-slate-100 dark:border-white/5 shadow-xl animate-blur-in" style="animation-delay: 0.2s">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                @endif

                <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 sm:p-12 border border-slate-100 dark:border-white/5 shadow-xl animate-blur-in" style="animation-delay: 0.3s">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 sm:p-12 border border-slate-100 dark:border-white/5 shadow-xl animate-blur-in" style="animation-delay: 0.4s">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
