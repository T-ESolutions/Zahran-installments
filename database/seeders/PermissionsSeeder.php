<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()


    {
//        $models = Storage::disk('app')->files('Models');
//
//        $index = array_search('Models/Setting.php',$models);
//        $index = array_search('Models/ServiceImages.php',$models);
//        if($index !== FALSE){
//            unset($models[$index]);
//        }
//
//        foreach ($models as $model) {
//            $model = str_replace('.php', null, $model);
//            $model=str_replace('/','\\',$model);
//            $model=str_replace('Models','',$model);
//            $model=str_replace('\\','',$model);
//
//
//            $models = Str::kebab($model);
//
//
//
//            $data = [
//
//                [
//                    'path' => $models,
//                    'name' => 'read-'.$models,
//                    'display_name' => 'read admins',
//
//                ],
//                [
//                    'path' => $models,
//                    'name' => 'update-'.$models,
//                    'display_name' => 'update admins',
//
//                ],
//                [
//                    'path' => $models,
//                    'name' => 'create-'.$models,
//                    'display_name' => 'create admins',
//
//                ],
//                [
//                    'path' => $models,
//                    'name' => 'delete-'.$models,
//                    'display_name' => 'delete admins',
//
//                ],
//
//            ];
//
//
//            foreach ($data as $get) {
//                Permission::updateOrCreate($get);
//            }
//
//
//        }

        $data = [


            // settings permissions
            [
                'path' => 'settings',
                'name' => 'read-settings',
                'display_name' => 'read settings',
            ],
            [
                'path' => 'settings',
                'name' => 'update-settings',
                'display_name' => 'update settings',
            ],

            // roles permissions
            [
                'path' => 'roles',
                'name' => 'read-roles',
                'display_name' => 'read roles',
            ],
            [
                'path' => 'roles',
                'name' => 'update-roles',
                'display_name' => 'update roles',
            ],
            [
                'path' => 'roles',
                'name' => 'create-roles',
                'display_name' => 'create roles',
            ],
            [
                'path' => 'roles',
                'name' => 'delete-roles',
                'display_name' => 'delete roles',
            ],

            // admins permissions

            [
                'path' => 'admins',
                'name' => 'read-admins',
                'display_name' => 'read admins',
            ],
            [
                'path' => 'admins',
                'name' => 'update-admins',
                'display_name' => 'update admins',
            ],
            [
                'path' => 'admins',
                'name' => 'create-admins',
                'display_name' => 'create admins',
            ],
            [
                'path' => 'admins',
                'name' => 'delete-admins',
                'display_name' => 'delete admins',
            ],
            [
                'path' => 'admins',
                'name' => 'change-activation-admins',
                'display_name' => 'delete admins',
            ],


            // customer permissions

            [
                'path' => 'customers',
                'name' => 'read-customer',
                'display_name' => 'read customer',
            ],
            [
                'path' => 'customers',
                'name' => 'update-customer',
                'display_name' => 'update customer',
            ],
            [
                'path' => 'customers',
                'name' => 'create-customer',
                'display_name' => 'create customer',
            ],
            [
                'path' => 'customers',
                'name' => 'delete-customer',
                'display_name' => 'delete customer',
            ],

            [
                'path' => 'customers',
                'name' => 'change-activation-customers',
                'display_name' => 'activate customer',
            ],

            // installment_request permissions

            [
                'path' => 'installment_requests',
                'name' => 'read-installment_request',
                'display_name' => 'read installment_request',
            ],
            [
                'path' => 'installment_requests',
                'name' => 'update-installment_request',
                'display_name' => 'update installment_request',
            ],
            [
                'path' => 'installment_requests',
                'name' => 'create-installment_request',
                'display_name' => 'create installment_request',
            ],
            [
                'path' => 'installment_requests',
                'name' => 'delete-installment_request',
                'display_name' => 'delete installment_request',
            ],

            [
                'path' => 'installment_requests',
                'name' => 'change-status-installment_requests',
                'display_name' => 'activate installment_request',
            ],
            [
                'path' => 'installment_requests',
                'name' => 'receive_id-installment_request',
                'display_name' => 'activate installment_request',
            ],


            // invoice permissions

            [
                'path' => 'invoices',
                'name' => 'read-invoice',
                'display_name' => 'read invoice',
            ],
            [
                'path' => 'invoices',
                'name' => 'create-invoice',
                'display_name' => 'create invoice',
            ],


            // lawsuit permissions

            [
                'path' => 'lawsuit',
                'name' => 'read-lawsuit',
                'display_name' => 'read lawsuit',
            ],
      /*      [
                'path' => 'lawsuit',
                'name' => 'update-lawsuit',
                'display_name' => 'update lawsuit',
            ],*/
            [
                'path' => 'lawsuit',
                'name' => 'create-lawsuit',
                'display_name' => 'create lawsuit',
            ],
            [
                'path' => 'lawsuit',
                'name' => 'delete-lawsuit',
                'display_name' => 'delete lawsuit',
            ],


        ];
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($data as $get) {
            Permission::updateOrCreate($get);
        }
    }
}
