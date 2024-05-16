<!-- The Modal -->
<section id="loginModal" class="loginModal {{ $errors->any() ? '' : 'hidden' }}">
    <!-- Modal content -->
    <div class="loginModal-content">
        
        <div class="controls">
            <div>
                <h4>Login as administrator</h4>
                <p>This is a administrator account.</p>
            </div>
            <span class="close">&times;</span>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <button type="submit">Authenticate</button>
            </div>
        </form>
    </div>
</section>