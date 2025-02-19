@component('mail::message')
# Reset Password

Klik tombol di bawah untuk mengatur ulang kata sandi Anda:

@component('mail::button', ['url' => $resetUrl])
Reset Password
@endcomponent

Jika Anda tidak meminta reset password, abaikan email ini.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
