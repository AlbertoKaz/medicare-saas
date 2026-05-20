<!--suppress HtmlUnknownAttribute -->
<div>
    <h1>Create patient</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form wire:submit="save">
        <input type="text" wire:model="first_name" placeholder="First name">
        @error('first_name') <p>{{ $message }}</p> @enderror

        <input type="text" wire:model="last_name" placeholder="Last name">
        @error('last_name') <p>{{ $message }}</p> @enderror

        <input type="email" wire:model="email" placeholder="Email">
        @error('email') <p>{{ $message }}</p> @enderror

        <input type="text" wire:model="phone" placeholder="Phone">
        @error('phone') <p>{{ $message }}</p> @enderror

        <input type="date" wire:model="birth_date">
        @error('birth_date') <p>{{ $message }}</p> @enderror

        <textarea wire:model="notes" placeholder="Notes"></textarea>
        @error('notes') <p>{{ $message }}</p> @enderror

        <button type="submit">
            Create patient
        </button>
    </form>
</div>
