<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:create-admin {first_name} {last_name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'first_name'        =>  $this->argument('first_name'),
            'last_name'         =>  $this->argument('last_name'),
            'email'             =>  $this->argument('email'),
            'role'              =>  User::ROLE_ADMIN,
            'password'          =>  bcrypt($this->argument('password'))
        ];

        $rules = [
            'first_name'    =>  'required|max:255',
            'last_name'     =>  'required|max:255',
            'email'         =>  'required|unique:users,email,NULL,NULL,role,' . User::ROLE_ADMIN,
            'password'      =>  'required|max:255'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $this->info('Some error with fields');
        } else {
            User::create($data);

            $this->info('Admin was created successful');
        }
    }
}