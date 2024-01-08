<?php


use App\Models\User;
use App\Models\Articulo;
use tests\Datasets\Emails;
use function Pest\Laravel\{actingAs, get, post};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    User::factory()->create();
});

it('page articulo api exists', function () {
    $response = $this->get('/api/articulos');

    $response->assertStatus(200);
});

it('has emails', function (string $emails) {
    expect($emails)->not->toBeEmpty();
})->with(['enunomaduro@gmail.com', 'other@example.com']);

it('has emails 2', function (string $name, string $email) {
    expect($name)->not->toBeEmpty();
    expect($email)->not->toBeEmpty();
})->with([
    ['nuno', 'enunomaduro@gmail.com'],
    ['Other', 'enunomaduro@gmail.com']
]);


it('has emails 3', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with('emails');

it('can generate the full name of a user', function (User $user) {
    expect($user->name)->toBe("{$user->name}");
})->with([
    fn () => User::factory()->create(['name' => 'Nuno', 'email' => 'Maduro', 'password' => 'example@example.com']),
    fn () => User::factory()->create(['name' => 'Luke', 'email' => 'Downing', 'password' => 'example@example.com']),
    fn () => User::factory()->create(['name' => 'Freek', 'email' => 'Van Der Herten', 'password' => 'example@example.com']),
]);



test('la suma de dos números es igual a su resultado', function () {
    expect(1 + 2)->toBe(3);
});

it('suma dos números', function () {
    expect(1 + 2)->toBe(3);
});

it('resta dos números', function () {
    expect(2 - 1)->toBe(1)
        ->and(1)->toBeInt();
});

it('Prueba con json', function () {
    expect('{"name":"Nuno","credit":1000.00}')
        ->json()
        ->toHaveCount(2)
        ->name->toBe('Nuno')
        ->credit->toBeFloat();
})->skip();

it('has home', function () {
    echo get_class($this); // \PHPUnit\Framework\TestCase

    $this->assertTrue(true);
});

function sum($valor, $valor2)
{
    return $valor + $valor2;
}

describe('sum', function () {
    it('may sum integers', function () {
        $result = sum(1, 2);

        expect($result)->toBe(3);
    });

    it('may sum floats', function () {
        $result = sum(1.5, 2.5);

        expect($result)->toBe(4.0);
    });
});

test('stability', function ($url) {
    $this->get($url)->assertOk();
})->with(['/']);

it('has a welcome page', function () {
    $this->get('/')->assertStatus(200);
});


test('la ruta /login autentica a un usuario', function () {
    $user = User::factory()->create();

    $response = post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect('/home');
    expect(auth()->user())->toBe($user);
})->skip();
