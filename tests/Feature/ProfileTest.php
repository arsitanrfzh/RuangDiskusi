<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        // 1. SIAPKAN DATA (Arrange)
        $user = User::factory()->create();

        $updateData = [
            'name' => 'Nama Baru Arsita',
            'email' => 'test@example.com',
            'biodata' => 'Ini adalah biodata saya.',
            'umur' => 25,
            'alamat' => 'Jalan Tes No. 123'
        ];

        // 2. LAKUKAN AKSI (Act)
        $response = $this
            ->actingAs($user)
            ->patch('/profile', $updateData);

        // 3. BUKTIKAN HASILNYA (Assert)
        $response->assertSessionHasNoErrors(); // Memastikan tidak ada error validasi
        $response->assertRedirect('/profile');
      
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nama Baru Arsita',
            'email' => 'test@example.com',
            'biodata' => 'Ini adalah biodata saya.',
            'umur' => 25,
            'alamat' => 'Jalan Tes No. 123'
        ]);

        // cek email-nya
        $user->refresh();
        $this->assertSame('Nama Baru Arsita', $user->name);
        $this->assertSame('test@example.com', $user->email);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
