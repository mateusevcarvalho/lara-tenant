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
    public function get(): ?Tenant
    {
        return $this->tenant;
    }

    /**
     * @param Company $tenant
     */
    public function set(?Tenant $tenant): void
    {
        $this->tenant = $tenant;
    }
}
