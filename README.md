Pacote Laravel desenvolvido para aplicações multitenant.

# Instalação
1 -Execute o seguinte comando:

    composer require mateusevcarvalho/lara-tenant

# Confiruração
2 - Adicione o ServiceProvider aos `providers` em `config/app.php`:

    Modules\MultiTenant\Providers\MultiTenantServiceProvider::class,
    
3 - Adicione também em `config/app.php` no `aliases`:

    'MultiTenant' => Modules\MultiTenant\Tenant\TenantFacade::class,
    
4 - Acione o middleware em `app/Http/Kernel.php` dentro do array `$routeMiddleware`:

    'tenant' =>  \Modules\MultiTenant\Http\Middleware\TenantMiddleware::class
    
5 - Publique o model do Tenant: `Lembre-se de criar uma tabela Tenant para dar referencia ao model`:

    php artisan make:migration create_tenants_table
    php artisan vendor:publish --tag=tenantModel
    
# Exemplos de uso
Nas rotas com autenticação coloque o middleware `tenant` e coloque o: `bindings` para não ter problemas na aplicação e para setar o tenant logado:

    Route::group(['middleware' => ['auth:api', 'tenant', 'bindings']], function () {
      Route::apiResource('produtos', 'ProdutosController');
    });
    
Para setar um tenant use `\MultiTenant::set($tenant)`, e para recuperar: `\MultiTenant::get()`, como o exemplo abaixo:

    public function store(Request $request)
    {
        DB::beginTransaction();
        $formData = $request->all();
        $tenant = Tenant::create(['uuid' => Uuid::generate()->string]);
        \MultiTenant::set($tenant);
        $individuo = $tenant->individuo()->create($formData['individuos']);
        $user = $individuo->user()->create([
            'status' => $formData['users']['status'],
            'email' => $formData['users']['email'],
            'password' => Hash::make($formData['users']['password'])
        ]);
        if ($tenant && $user && $individuo) {
            DB::commit();
            (new CadastrosInicial())->cadastrar();
            return response()->json(compact('tenant', 'user', 'individuo'));
        }
        DB::rollBack();
        return response()->json('Falha interna', 500);
    }

Na model que terar multitenant use a trait `TenantModels` para automatizar todo e processo de query da model
