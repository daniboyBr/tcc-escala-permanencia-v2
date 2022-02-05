<?php

namespace App\Audit\Drivers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Audit;
use Illuminate\Support\Facades\Config;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\AuditDriver;

class AuditLogDriver implements AuditDriver
{
	public function audit(Auditable $model): Audit
	{
		$implementation = Config::get('audit.implementation', \OwenIt\Auditing\Models\Audit::class);

		Log::channel('gelf')->debug(
			Auth::user()->name . ' ' . $model->getAuditEvent() . ' ' . $model->toAudit()['auditable_type'] ?? get_class($model),
			$model->toAudit()
		);

		return new $implementation();
	}

	public function prune(Auditable $model): bool
	{
		// TODO: Implement the pruning logic
		return false;
	}
}
