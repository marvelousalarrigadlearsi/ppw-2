<?php

namespace Tests\Feature;

use App\Jobs\KirimEmailSelamatDatang;
use App\Jobs\SendLoginNotificationMailJob;
use App\Models\User;
use App\Notifications\UserBaruNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Tests\TestCase;

class GoogleLoginTest extends TestCase
{
    use RefreshDatabase;

    private function fakeGoogle(string $email): void
    {
        Socialite::fake('google', (new SocialiteUser)->map([
            'id' => '1234567890',
            'name' => 'Mahasiswa Uji',
            'email' => $email,
            'avatar' => 'https://example.com/a.png',
        ]));
    }

    public function test_user_baru_bisa_login_dengan_google(): void
    {
        Queue::fake();
        Notification::fake();

        $admin = User::factory()->create(['level' => 'admin']);
        $this->fakeGoogle('mahasiswa@mail.ugm.ac.id');

        $this->get('/auth/google/callback')->assertRedirect('/dashboard');

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'mahasiswa@mail.ugm.ac.id',
            'google_id' => '1234567890',
            'level' => 'user',
        ]);

        Queue::assertPushed(KirimEmailSelamatDatang::class);
        Queue::assertPushed(SendLoginNotificationMailJob::class); // Tugas 3
        Notification::assertSentTo($admin, UserBaruNotification::class);
    }

    public function test_email_di_luar_domain_kampus_ditolak(): void
    {
        Queue::fake();
        Notification::fake();

        $this->fakeGoogle('orang@gmail.com'); // Tugas 2

        $this->get('/auth/google/callback')
            ->assertRedirect('/login')
            ->assertSessionHas('error');

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => 'orang@gmail.com']);
        Queue::assertNothingPushed();
    }

    public function test_user_lama_yang_login_lagi_tidak_dianggap_user_baru(): void
    {
        Queue::fake();
        Notification::fake();

        User::factory()->create(['level' => 'admin']);
        User::factory()->create(['email' => 'mahasiswa@mail.ugm.ac.id']);
        $this->fakeGoogle('mahasiswa@mail.ugm.ac.id');

        $this->get('/auth/google/callback')->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', ['email' => 'mahasiswa@mail.ugm.ac.id', 'google_id' => '1234567890']);
        Queue::assertNotPushed(KirimEmailSelamatDatang::class);
        Queue::assertPushed(SendLoginNotificationMailJob::class);
        Notification::assertNothingSent();
    }

    public function test_admin_bisa_menandai_semua_notifikasi_dibaca(): void
    {
        $admin = User::factory()->create(['level' => 'admin']);
        $userBaru = User::factory()->create();
        $admin->notify(new UserBaruNotification($userBaru));

        $this->assertSame(1, $admin->unreadNotifications()->count());

        $this->actingAs($admin)
            ->post('/notifikasi/baca-semua')
            ->assertRedirect();

        $this->assertSame(0, $admin->fresh()->unreadNotifications()->count());
    }

    public function test_dashboard_wajib_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }
}
