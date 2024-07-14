<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset Password</title>
</head>

<body>
    <form method="POST" action="{{ route('password.email') }}" accept-charset="utf-8" style="margin: 100px auto;box-shadow: 0 0 15px -2px lightgray;width:100%;max-width:600px;padding:20px;box-sizing:border-box;">
        @csrf
        <h1 style="text-align: center;">Reset Password</h1>
        <center>
            @if (session('status'))
                <div style="color: green; margin-bottom: 10px;">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->has('email'))
                <div style="color: red; margin-bottom: 10px;">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <div style="display: flex;flex-direction:column;margin-bottom:10px;box-sizing:border-box;">
                <label for="email" style="text-align: left;margin-bottom:5px;"> Email</label>
                <input placeholder="Masukkan email" name="email" type="email" id="email" required style="padding:8px;border:2px solid lightgray;border-radius:5px;" value="{{ old('email') }}" />
            </div>
            <button type="submit" id="btn-reset" style="background-color: green;border:none;padding:8px 16px;color:white;cursor:pointer;">Kirim Link Reset Password</button>
        </center>
    </form>
</body>

</html>
