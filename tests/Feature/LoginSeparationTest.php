<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class LoginSeparationTest extends TestCase
{
    use DatabaseTransactions;

    protected User $admin;
    protected User $staff;

    protected function setUp(): void
    {
        parent::setUp();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::findOrCreate('super-admin', 'web');
        Role::findOrCreate('sales-person', 'web');

        $this->admin = User::create([
            'name' => 'Login Sep Admin',
            'email' => 'login-sep-admin@example.test',
            'password' => Hash::make('password'),
        ]);
        $this->admin->assignRole('super-admin');

        $this->staff = User::create([
            'name' => 'Login Sep Staff',
            'email' => 'login-sep-staff@example.test',
            'password' => Hash::make('password'),
        ]);
        $this->staff->assignRole('sales-person');
    }

    public function test_user_and_admin_login_pages_are_available()
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('User Login')
            ->assertSee('Access your PharmaFlow workspace')
            ->assertDontSee('Are you an administrator?')
            ->assertDontSee('Are you a staff member?');

        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Admin Login')
            ->assertSee('Sign in to the PharmaFlow Administration Panel')
            ->assertDontSee('Are you an administrator?')
            ->assertDontSee('Are you a staff member?');
    }

    public function test_admin_can_sign_in_through_admin_login()
    {
        $this->post('/admin/login', [
            'email' => $this->admin->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_staff_can_sign_in_through_user_login()
    {
        $this->post('/login', [
            'email' => $this->staff->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($this->staff);
    }

    public function test_staff_cannot_sign_in_through_admin_login()
    {
        $this->from('/admin/login')->post('/admin/login', [
            'email' => $this->staff->email,
            'password' => 'password',
        ])
            ->assertRedirect('/admin/login')
            ->assertSessionHas('login_error');

        $this->assertGuest();
    }

    public function test_admin_cannot_sign_in_through_user_login()
    {
        $this->from('/login')->post('/login', [
            'email' => $this->admin->email,
            'password' => 'password',
        ])
            ->assertRedirect('/login')
            ->assertSessionHas('login_error');

        $this->assertGuest();
    }

    public function test_invalid_credentials_are_rejected_on_both_pages()
    {
        $this->from('/login')->post('/login', [
            'email' => $this->staff->email,
            'password' => 'wrong-password',
        ])
            ->assertRedirect('/login')
            ->assertSessionHas('login_error', 'Invalid email or password.');

        $this->from('/admin/login')->post('/admin/login', [
            'email' => $this->admin->email,
            'password' => 'wrong-password',
        ])
            ->assertRedirect('/admin/login')
            ->assertSessionHas('login_error', 'Invalid email or password.');

        $this->assertGuest();
    }
}
