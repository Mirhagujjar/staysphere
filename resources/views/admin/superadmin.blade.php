@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('admin.superadmin') }}">
    @csrf
    <input type="text" name="name" placeholder="Admin Name" required>
    <input type="email" name="email" placeholder="Admin Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <button type="submit">Create Admin</button>
</form>
