    <?php

    use App\User;
    use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            "name"              => "Admin",
            "email"             => "admin@admin.com",
            "password"          => Hash::make("password"),
            "api_token"         => \Illuminate\Support\Str::random(60)
        ));
    }
}
