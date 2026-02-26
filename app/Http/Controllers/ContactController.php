<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User; // Import Model User
use Illuminate\Http\Request;
use Filament\Notifications\Notification; // Import Notifikasi Filament
use Filament\Actions\Action; // ✅ Action Filament v5
use Illuminate\Support\Facades\Http; // ✅ Tambahan untuk request ke Google API
use Closure; // ✅ Tambahan untuk custom rule validasi

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            // ✅ Tambahan validasi reCAPTCHA
            'g-recaptcha-response' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($request) {
                    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                        'secret'   => config('services.recaptcha.secret_key'),
                        'response' => $value,
                        'remoteip' => $request->ip()
                    ]);

                    if (! $response->json('success')) {
                        $fail('Verifikasi reCAPTCHA gagal. Pastikan Anda mencentang kotak "I\'m not a robot".');
                    }
                },
            ],
        ], [
            // ✅ Pesan error kustom jika reCAPTCHA tidak dicentang
            'g-recaptcha-response.required' => 'Silakan centang kotak "I\'m not a robot" terlebih dahulu.',
        ]);

        // ✅ Hapus 'g-recaptcha-response' dari array $validated agar tidak error saat create ke database
        unset($validated['g-recaptcha-response']);

        // 2. Simpan ke database
        $pesan = ContactMessage::create($validated);

        // 3. KIRIM NOTIFIKASI KE ADMIN FILAMENT (Bagian Baru)
        $recipients = User::all();

        foreach ($recipients as $recipient) {
            Notification::make()
                ->title('Pesan Baru: ' . $validated['subject'])
                ->body('Dari: ' . $validated['name'] . ' (' . $validated['email'] . ')')
                ->success()
                ->actions([
                    Action::make('Lihat')
                        ->button()
                        ->url(\App\Filament\Resources\ContactMessages\ContactMessageResource::getUrl('view', [
                            'record' => $pesan->getKey(),
                        ])),
                ])
                ->sendToDatabase($recipient);
        }

        // 4. Kembali ke halaman sebelumnya
        return back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}