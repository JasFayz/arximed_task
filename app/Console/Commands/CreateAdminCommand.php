<?php

namespace App\Console\Commands;

use App\Actions\User\CreateUserAction;
use App\Actions\User\SetUserAsAdmin;
use App\DTO\UserData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{

    public function __construct(private CreateUserAction $createUserAction, private SetUserAsAdmin $setUserAsAdmin)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data['name'] = $this->ask('Enter name');
        $data['email'] = $this->ask('Enter email');
        $data['password'] = Hash::make($this->secret('Enter password'));

        $user = $this->createUserAction->execute(UserData::from($data));

        if (!$user) {
            $this->info('Cant create admin');
            Command::FAILURE;
        }
        $this->setUserAsAdmin->execute($user);
        $this->info('Admin created');
        Command::SUCCESS;
    }
}
