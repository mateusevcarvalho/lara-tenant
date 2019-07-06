<?php
declare(strict_types=1);

namespace Modules\MultiTenant\Tenant;

use Modules\MultiTenant\Models\Tenant;

class TenantManager
{
    private $tenant;

    /**
     * @return Company
     */
    public function get()
    {
        return $this->tenant;
    }

    /**
     * @param Company $tenant
     */
    public function set($tenant): void
    {
        $this->tenant = $tenant;
    }
}
