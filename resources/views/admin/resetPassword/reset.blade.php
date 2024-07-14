<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset Password</title>
</head>

<body>
    <form method="POST" action="{{ route('password.update') }}" accept-charset="utf-8" style="margin: 100px auto;box-shadow: 0 0 15px -2px lightgray;width:100%;max-width:600px;padding:20px;box-sizing:border-box;">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <h1 style="text-align: center;">Reset Password</h1>
        <center>
            @if ($errors->any())
                <div style="color: red; margin-bottom: 10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="display: flex;flex-direction:column;margin-bottom:10px;box-sizing:border-box;">
                <label for="password" style="text-align: left;margin-bottom:5px;">Password Baru</label>
                <input placeholder="Password baru" name="password" type="password" id="password" required style="padding:8px;border:2px solid lightgray;border-radius:5px;" />
            </div>
            <div style="display: flex;flex-direction:column;margin-bottom:10px;box-sizing:border-box;">
                <label for="password_confirmation" style="text-align: left;margin-bottom:5px;">Konfirmasi Password Baru</label>
                <input placeholder="Konfirmasi password baru" name="password_confirmation" type="password" id="password_confirmation" required style="padding:8px;border:2px solid lightgray;border-radius:5px;" />
            </div>
            <button type="submit" id="btn-reset" style="background-color: green;border:none;padding:8px 16px;color:white;cursor:pointer;">Reset Password</button>
        </center>
    </form>
</body>

</html>
