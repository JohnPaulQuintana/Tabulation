<!-- The Modal -->
<section class="loginModal {{ $errors->any() ? '' : '' }}">
    <!-- Modal content -->
    <div class="loginModal-content">
        
        <div class="controls">
            <div style="width:100%;">
                <h4 class="text-center fw-bolder text-uppercase text-info">{{ $online->name }}</h4>
                <p class="text-center text-secondary">{{ $online->details }}</p>
                <p class="text-center text-info">{{ $online->created_at->format('F j, Y') }}</p>
            </div>
           
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form action="#" method="post">
            @csrf
            
            <div class="input-group">
                <label for="code">Authentication Code</label>
                <input type="text" name="code" id="code" value="{{ old('code') }}">
                @error('code')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <button type="submit">Authenticate</button>
            </div>
        </form>
    </div>
</section>